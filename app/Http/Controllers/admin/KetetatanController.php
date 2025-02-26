<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;
use App\Models\ketetatan;
use Illuminate\Support\Facades\Log;

class KetetatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    //
    if ($request->ajax()) {
        $data = ketetatan::select([
                'id',
                'jml_snmptn',
            'kuota_snmptn',
            'jml_sbnptn',
            'kuota_sbnptn',
            'jml_mandiri',
            'kuota_mandiri',
                'tahun',
            ]);
        return DataTables::of($data)
        ->addColumn('action', function ($row) {
            return '<button class="btn btn-info btn-edit" data-id="' . $row->id . '" data-name="' . $row->tahun . '">Edit</button>
                    <button class="btn btn-danger btn-delete" data-id="' . $row->id . '">Delete</button>';
        })
            ->rawColumns(['action'])
            ->make(true);
    }
    return view('admin.ketetatan.index');
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
                'itemId' => 'nullable|integer|exists:alumnis,id',
                'tahun' => 'required|integer',
                'jml_snmptn' => 'required|integer',
                'kuota_snmptn' => 'required|integer',
                'jml_sbnptn' => 'required|integer',
                'kuota_sbnptn' => 'required|integer',
                'jml_mandiri' => 'required|integer',
                'kuota_mandiri' => 'required|integer',

            ]);


            // Update or create the item in the database
            $item = ketetatan::updateOrCreate(
                    ['id' => $request->itemId],
                    [
                    'tahun' => $request->tahun,
                    'jml_snmptn' => $request->jml_snmptn,
                    'kuota_snmptn' => $request->kuota_snmptn,
                    'jml_sbnptn' => $request->jml_sbnptn,
                    'kuota_sbnptn' => $request->kuota_sbnptn,
                    'jml_mandiri' => $request->jml_mandiri,
                    'kuota_mandiri' => $request->kuota_mandiri,
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
            $ketetatan = ketetatan::findOrFail($id);
            $ketetatan->delete();

            // Return success response
            return response()->json(['message' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            // Return error response if something goes wrong
            return response()->json(['error' => 'Failed to delete the data'], 500);
        }
    }
}
