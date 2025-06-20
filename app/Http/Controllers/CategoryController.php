<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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


        $query = Category::query();

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }
        if ($sort === 'no') {
            $query->orderBy('id', $direction);
        } elseif ($sort === 'created_at') {
            $query->orderBy('created_at', $direction);
        } elseif ($sort === 'updated_at') {
            $query->orderBy('updated_at', $direction);
        } elseif ($sort === 'name') {
            $query->orderBy('name', $direction);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $categories = $query->paginate(5);

        return view('categories', compact('categories', 'startDate', 'endDate'));
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
            Category::create([
                'name' => $request->name,
            ]);

            return redirect()->route('categories')->with('success', 'Category created successfully');
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
            $category = Category::findOrFail($id);
            if (!$category) {
                return redirect()->back()->withErrors(['error' => 'Category not found.']);
            }

            $category->update([
                'name' => $request->name
            ]);

            return redirect()->route('categories')->with('success', 'Category updated successfully');
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
            $category = Category::findOrFail($id);
            if (!$category) {
                return redirect()->back()->withErrors(['error' => 'Category not found.']);
            }

            $category->delete();

            return redirect()->route('categories')->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }
}
