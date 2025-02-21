<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipeInfo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class TipeInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = TipeInfo::select(['id', 'nama']);
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-info btn-edit" data-id="' . $row->id . '" data-name="' . $row->nama . '">Edit</button>
                    <button class="btn btn-danger btn-delete" data-id="'. $row->id .'">Delete</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
            return view('admin.TipeInfo.index');
       
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
        //\
        try {
            // Validate input fields
            $request->validate([
                'itemId' => 'nullable|integer|exists:tipe_infos,id',
                'nama' => 'required|string|max:255',
                
            ]);


            // Update or create the item in the database
            $item = TipeInfo::updateOrCreate(
                ['id' => $request->itemId],
                [
                    'nama' => $request->nama,
                ]
            );

            // Return the updated  item as JSON response
            return response()->json($item);
        } catch (\Exception $e) {
            Log::error('Failed to create or update item: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        //
        try {
            $dosen = TipeInfo::findOrFail($id);
            $dosen->delete();

            // Return success response
            return response()->json(['message' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            // Return error response if something goes wrong
            return response()->json(['error' => 'Failed to delete the data'], 500);
        }
    }
}
