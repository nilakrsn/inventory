<?php

namespace App\Http\Controllers;

use App\Models\Expand;
use App\Models\User;
use Illuminate\Http\Request;

class ExpandController extends Controller
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

        $query = Expand::query()->with('user'); 

        $users = User::all();

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }
        if ($queryText) {
            $query->where(function($q) use ($queryText) {
            $q->where('desc', 'like', '%' . $queryText . '%')
              ->orWhere('nominal', 'like', '%' . $queryText . '%')
              ->orWhereHas('user', function($uq) use ($queryText) {
                  $uq->where('name', 'like', '%' . $queryText . '%');
              });
            });
        }
        if ($sort === 'no') {
            $query->orderBy('id', $direction);
        } elseif ($sort === 'created_at') {
            $query->orderBy('created_at', $direction);
        } elseif ($sort === 'updated_at') {
            $query->orderBy('updated_at', $direction);
        } elseif ($sort === 'desc') {
            $query->orderBy('desc', $direction);
        } elseif ($sort === 'nominal') {
            $query->orderBy('nominal', $direction);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $expands = $query->paginate(5)->appends($request->all());

        return view('expands', compact('expands', 'startDate', 'endDate','users'));
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
            Expand::create([
                'users_id' => $request->users_id,
                'desc' => $request->desc,
                'nominal' => $request->nominal,
            ]);

            return redirect()->route('expands')->with('success', 'Expand created successfully');
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
            $expand = Expand::findOrFail($id);
            if (!$expand) {
                return redirect()->back()->withErrors(['error' => 'Expand not found.']);
            }

            $expand->update([
                'users_id' => $request->users_id,
                'desc' => $request->desc,
                'nominal' => $request->nominal
            ]);

            return redirect()->route('expands')->with('success', 'Expand updated successfully');
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
            $expand = Expand::findOrFail($id);
            if (!$expand) {
                return redirect()->back()->withErrors(['error' => 'Expand not found.']);
            }

            $expand->delete();

            return redirect()->route('expands')->with('success', 'Expand deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }
}
