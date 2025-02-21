<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;
use App\Models\WebGambar;
use Illuminate\Support\Facades\Log;

class WebGambarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = WebGambar::select(['id', 'nama', 'file']);
            return DataTables::of($data)
                ->addColumn('file', function ($row) {
                    return $row->file ? '<img src="gambar_website/' . $row->file . '" width="50">' : '';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-info btn-edit" data-id="' . $row->id . '" data-name="' . $row->nama . '">Edit</button>';
                })
                ->rawColumns(['file', 'action'])
                ->make(true);
        }

        return view('admin.webgambar.index');
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
        //
        try {
            // Validate input fields
            $request->validate([
                'itemId' => 'nullable|integer|exists:web_gambars,id',
                'nama' => 'nullable|string|max:255',
                'gambar' => 'required|file|mimes:jpg,jpeg,png|max:2048',

            ]);

            

            // Handle upload gambar
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $destinationPath = public_path('gambar_website');
                $imageName = date('YmdHis') . "." . $file->getClientOriginalExtension();
                $file->move($destinationPath, $imageName);
                
            } else {
                // If no image is uploaded, set a default image
                $imageName = 'default.png'; // Default image
            }

            // Update or create the item in the database
            $item = WebGambar::updateOrCreate(
                ['id' => $request->itemId],
                [
                    'nama' => $request->nama,
                    'file' => $imageName,
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
            $datas = WebGambar::findOrFail($id);
            
            // Hapus gambar jika ada
            if ($datas->file && file_exists(public_path('gambar_website/' . $datas->file))) {
                unlink(public_path('gambar_website/' . $datas->file));
            }

            $datas->delete();

            // Return success response
            return response()->json(['message' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            // Return error response if something goes wrong
            return response()->json(['error' => 'Failed to delete the data'], 500);
        }
    }
}
