<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $categories = Category::all();

        $query = DB::table('stocks')
            ->join('products', 'stocks.products_id', '=', 'products.id')
            ->leftJoin('categories', 'products.categories_id', '=', 'categories.id')
            ->whereNull('stocks.deleted_at') 
            ->select(
                'stocks.id as stock_id',
                'stocks.users_id',
                'stocks.quantity',
                'stocks.created_at as stock_created_at',
                'products.id as product_id',
                'products.name as product_name',
                'products.categories_id',
                'products.barcode',
                'products.image',
                'categories.name as category_name',
                'products.cons_price',
                'products.selling_price',
                'products.status',
                'products.expired'

            );

        if ($startDate) {
            $query->whereDate('stocks.created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('stocks.created_at', '<=', $endDate);
        }
        if ($queryText) {
            $query->where(function ($q) use ($queryText) {
                $q->where('products.name', 'like', '%' . $queryText . '%')
                    ->orWhere('products.barcode', 'like', '%' . $queryText . '%');
            });
        }

        // Sorting
        if ($sort === 'no') {
            $query->orderBy('stocks.id', $direction);
        } elseif ($sort === 'created_at') {
            $query->orderBy('stocks.created_at', $direction);
        } elseif ($sort === 'updated_at') {
            $query->orderBy('stocks.updated_at', $direction);
        } elseif ($sort === 'name') {
            $query->orderBy('products.name', $direction)->orderBy('products.barcode', $direction);
        } else {
            $query->orderBy('stocks.created_at', 'desc');
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
                $imageName = $request->file('image')->store('', 'public');
            }
            $product = Product::create([
                'name' => $request->name,
                'barcode' => $request->barcode,
                'image' => $imageName,
                'categories_id' => $request->categories_id,
                'cons_price' => $request->cons_price,
                'selling_price' => $request->selling_price,
                'status' => 'active',
                'expired' => $request->expired,
            ]);

            if($product && filled('quantity') && request('quantity') > 0) {
                Stock::create([
                    'users_id' => Auth::check() ? Auth::id() : null,
                    'products_id' => $product->id,
                    'quantity' => $request->quantity,
                    'cons_price' => $request->cons_price,
                    'selling_price' => $request->selling_price,
                ]);
            }

            

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
        try{
            $stock = Stock::with('product')->findOrFail($id);

        
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('products', 'public');
        } else {
            $imageName = $request->old_image;
        }

        
        $stock->product->update([
            'name' => $request->name,
            'barcode' => $request->barcode,
            'image' => $imageName,
            'categories_id' => $request->categories_id,
            'cons_price' => $request->cons_price,
            'selling_price' => $request->selling_price,
            'expired' => $request->expired,
        ]);

        // Update ke tabel stocks
        $stock->update([
            'users_id' => Auth::check() ? Auth::id() : null,
            'products_id' => $stock->product->id,
            'quantity' => $request->quantity,
            'cons_price' => $request->cons_price,
            'selling_price' => $request->selling_price,
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
            $product = Stock::findOrFail($id);
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
