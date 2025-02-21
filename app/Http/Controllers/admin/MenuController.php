<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Menu;
use Illuminate\Support\Facades\Log;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 

        if ($request->ajax()) {
            $data = Menu::select(['id','nama', 'url'])
            ->skip(5)
            ->take(5)
            ->get();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-info btn-edit" data-id="' . $row->id . '" data-name="' . $row->nama . '">Edit</button>
                    <button class="btn btn-danger btn-delete" data-id="' . $row->id . '">Delete</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
            return view('admin.menu.index');
        
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
                'itemId' => 'nullable|integer|exists:menus,id',
                'nama' => 'required|string|max:255',
                'url' => 'required|string|max:255',

            ]);

            // Check if the itemId is one of the first 5 items in the database
            if ($request->itemId) {
                $firstFiveItems = Menu::orderBy('id')->take(5)->pluck('id')->toArray();

                if (in_array($request->itemId, $firstFiveItems)) {
                    return response()->json(['error' => 'The first 5 items cannot be updated.'], 403);
                }
            }
            

            // Update or create the item in the database
            $item = Menu::updateOrCreate(
                ['id' => $request->itemId],
                [
                    'nama' => $request->nama,
                    'url' => $request->url,
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
            $dosen = Menu::findOrFail($id);

            // Periksa apakah item termasuk dalam 5 data pertama
            $firstFiveIds = Menu::orderBy('id', 'asc')->take(5)->pluck('id')->toArray();

            if (in_array($id, $firstFiveIds)) {
                return response()->json(['error' => 'Item ini tidak dapat dihapus.'], 403);
            }
            $dosen->delete();

            // Return success response
            return response()->json(['message' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            // Return error response if something goes wrong
            return response()->json(['error' => 'Failed to delete the data'], 500);
        }
    }
}
