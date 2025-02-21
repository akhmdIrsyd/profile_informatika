<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;
use App\Models\alumni;
use Illuminate\Support\Facades\Log;
class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = alumni::select([
                'id',
                'jml_peminat',
                'juml_masuk',
                'juml_lulus',
                'tahun',
            ]);
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-info btn-edit" data-id="' . $row->id . '" data-name="' . $row->nama . '">Edit</button>
                    <button class="btn btn-danger btn-delete" data-id="' . $row->id . '">Delete</button>';
                })
                ->rawColumns(['file', 'action'])
                ->make(true);
        }
            return view('admin.alumni.index');
       
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
            // Validate input fields
            $request->validate([
                'itemId' => 'nullable|integer|exists:alumnis,id',
                'tahun' => 'required|integer',
                'jml_peminat' => 'required|integer',
                'juml_masuk' => 'required|integer',
                'juml_lulus' => 'required|integer',

            ]);


            // Update or create the item in the database
            $item = alumni::updateOrCreate(
                    ['id' => $request->itemId],
                    [
                    'tahun' => $request->tahun,
                    'jml_peminat' => $request->jml_peminat,
                    'juml_masuk' => $request->juml_masuk,
                    'juml_lulus' => $request->juml_lulus,
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
        try {
            $alumni = alumni::findOrFail($id);
            $alumni->delete();

            // Return success response
            return response()->json(['message' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            // Return error response if something goes wrong
            return response()->json(['error' => 'Failed to delete the data'], 500);
        }
    }
}
