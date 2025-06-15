<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::all();
        return response()->json([
            'status' => true,
            'message' => 'get data successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = Product::create([
                'name' => $request->name,
                'barcode' => $request->barcode,
                'image' => $request->image,
                'categories_id' => $request->categories_id,
                'cons_price' => $request->cons_price,
                'selling_price' => $request->selling_price,
                'status' => $request->status,
                'expired' => $request->expired,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'product created successfully',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Product::find($id);

        return response()->json([
            'status' => (bool) $data,
            'message' => $data ? 'get data successfully' : 'data not found',
            'data' => $data
        ], $data ? 200 : 404);
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

            $data = Product::find($id);

            if (!$data) {
                return response()->json([
                    'status' => false,
                    'message' => 'get data unsuccessfully',
                ], 404);
            }

            $data->update([
                'name' => $request->name,
                'barcode' => $request->barcode,
                'image' => $request->image,
                'categories_id' => $request->categories_id,
                'cons_price' => $request->cons_price,
                'selling_price' => $request->selling_price,
                'status' => $request->status,
                'expired' => $request->expired,
            ]);

            $data->refresh();

            return response()->json([
                'status' => true,
                'message' => 'product update successfully',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $data = Product::find($id);

            if (!$data) {
                return response()->json([
                    'status' => false,
                    'message' => 'get data unsuccessfully',
                ], 404);
            }

            $data->delete();

            return response()->json([
                'status' => true,
                'message' => 'Product delete successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
