<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $sort = $request->input('sort', 'created_at');
        $direction = $request->input('direction', 'desc');
        $queryText = $request->input('query');

        $query = Product::query();

        $categories = Category::all();

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }
        if ($queryText) {
            $query->where(function ($q) use ($queryText) {
                $q->where('name', 'like', '%' . $queryText . '%')
                    ->orWhere('barcode', 'like', '%' . $queryText . '%');
            });
        }
        if ($sort === 'no') {
            $query->orderBy('id', $direction);
        } elseif ($sort === 'created_at') {
            $query->orderBy('created_at', $direction);
        } elseif ($sort === 'updated_at') {
            $query->orderBy('updated_at', $direction);
        } elseif ($sort === 'name') {
            $query->orderBy('name', $direction)->orderBy('barcode', $direction);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(5)->appends($request->all());

        return view('products', compact('products', 'startDate', 'endDate', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $imageName = null;
            if ($request->hasFile('image')) {
                $imageName = $request->file('image')->store('' ,'public');
            }
            Product::create([
                'name' => $request->name,
                'barcode' => $request->barcode,
                'image' => $imageName,
                'categories_id' => $request->categories_id,
                'cons_price' => $request->cons_price,
                'selling_price' => $request->selling_price,
                'status' => 'active',
                'expired' => $request->expired,
            ]);

            return redirect()->route('products')->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $product = Product::findOrFail($id);
            if (!$product) {
                return redirect()->back()->withErrors(['error' => 'Product not found.']);
            }

            $product->update([
                'name' => $request->name,
                'barcode' => $request->barcode,
                'image' => $request->file('image') ? $request->file('image')->store('products', 'public') : null,
                'categories_id' => $request->categories_id,
                'cons_price' => $request->cons_price,
                'selling_price' => $request->selling_price,
                'status' => 'active',
                'expired' => $request->expired ? date('Y-m-d', strtotime($request->expired)) : null,
            ]);

            return redirect()->route('products')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            if (!$product) {
                return redirect()->back()->withErrors(['error' => 'Product not found.']);
            }

            $product->delete();

            return redirect()->route('products')->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }
}
