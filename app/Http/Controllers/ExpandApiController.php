<?php

namespace App\Http\Controllers;

use App\Models\Expand;
use Illuminate\Http\Request;

class ExpandApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $data = Expand::all();
        return response()->json([
            'status' => true,
            'message' => 'get data successfully',
            'data' => $data
        ], 200);
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
            $data = Expand::create([
                'desc' => $request->desc,
                'nominal' => $request->nominal
            ]);

            return response()->json([
                'status' => true,
                'message' => 'expand created successfully',
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
        $data = Expand::find($id);

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

            $data = Expand::find($id);
            if (!$data) {
                return response()->json([
                    'status' => false,
                    'message' => 'get data unsuccessfully',
                ], 404);
            }

            $data->update([
                'name' => $request->name
            ]);

            $data->refresh();

            return response()->json([
                'status' => true,
                'message' => 'expand updated successfully',
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
            $data = Expand::find($id);

            if (!$data) {
                return response()->json([
                    'status' => false,
                    'message' => 'get data unsuccessfully',
                ], 404);
            }

            $data->delete();

            return response()->json([
                'status' => true,
                'message' => 'expand deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
