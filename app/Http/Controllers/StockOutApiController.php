<?php

namespace App\Http\Controllers;

use App\Models\StockOut;
use Illuminate\Http\Request;

class StockOutApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = StockOut::all();
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
            $data = StockOut::create([
                'products_id' => $request->products_id,
                'quantity' => $request->quantity,
                'selling_price' => $request->selling_price,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'stock in created successfully',
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
        $data = StockOut::find($id);

        return response()->json([
            'status' => (bool) $data,
            'message' => $data ? 'get data successfully' : 'data not found',
            'data' => $data
        ], $data ? 200 : 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $data = StockOut::find($id);
            if (!$data) {
                return response()->json([
                    'status' => false,
                    'message' => 'get data unsuccessfully',
                ], 404);
            }

            $data->update([
                'products_id' => $request->products_id,
                'quantity' => $request->quantity,
                'selling_price' => $request->selling_price,
            ]);

            $data->refresh();

            return response()->json([
                'status' => true,
                'message' => 'stock in updated successfully',
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = StockOut::find($id);

            if (!$data) {
                return response()->json([
                    'status' => false,
                    'message' => 'get data unsuccessfully',
                ], 404);
            }

            $data->delete();

            return response()->json([
                'status' => true,
                'message' => 'stock in deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
