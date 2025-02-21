<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\WebText;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;
class WebTextController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
            if ($request->ajax()) {
                $data = WebText::select(['id', 'nama', 'isi']);
                return DataTables::of($data)
                    ->addColumn('action', function ($row) {
                        return '<button class="btn btn-info btn-edit" data-id="' . $row->id . '" data-name="' . $row->nama . '">Edit</button>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('admin.webtext.index');
        
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
        //
        try {
            // Validate input fields
            $request->validate([
                'itemId' => 'nullable|integer|exists:web_texts,id',
                'nama' => 'nullable|string|max:255',
                'isi' => 'required|string|max:255',

            ]);


            // Update or create the item in the database
            $item = WebText::updateOrCreate(
                    ['id' => $request->itemId],
                    [
                        'nama' => $request->nama,
                        'isi' => $request->isi,
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
    }
}
