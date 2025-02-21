<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Berkas;
use App\Models\Tipe_berkas;

class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Berkas::with('tipeberkas:id,nama')->select([
                'id',
                'judul',
                'file_berkas',
                'tipeberkas_id',
                'tanggal',
            ]);

            return DataTables::of($data)
                ->addColumn('tipeberkas_nama', function ($row) {
                    return $row->tipeberkas ? $row->tipeberkas->nama : '-'; // Handle null case
                })
                ->addColumn('file_berkas', function ($row) {
                    if (!empty($row->file_berkas)) {
                        return '
                <a href="' . asset('file_berkas/' . $row->file_berkas) . '" target="_blank" rel="noopener noreferrer" class="btn btn-warning btn-circle">
                    <i class="fas fa-eye"></i>
                </a>
            ';
                    } else {
                        return '<span class="text-muted">No File Available</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('berkas.edit', $row->id) . '" class="btn btn-warning btn-warning">Edit</a>
                                <button class="btn btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>
                    ';
                })
                ->rawColumns(['file_berkas', 'tipeberkas_nama', 'action'])
                ->make(true);
        }
            return view('admin.berkas.index');
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        try {
            $tipeberkases = Tipe_berkas::all();
            return view('admin.berkas.tambah', compact('tipeberkases'));
        } catch (\Exception $e) {
            return redirect()->route('berkas.index')->with('error', 'Terjadi kesalahan.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'file_berkas' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
                'tipeberkas_id' => 'required|exists:tipe_berkas,id',
                'tanggal' => 'date|required',
            ]);

            if ($request->hasFile('file_berkas')) {
                $file = $request->file('file_berkas');
                $destinationPath = 'file_berkas';
                $imageName = date('YmdHis') . "." . $file->getClientOriginalExtension();
                $file->move(public_path($destinationPath), $imageName);
                $validatedData['file_berkas'] = $imageName;
            } else {
                // If no image is uploaded, set a default image
                $validatedData['file_berkas'] = 'default-image.jpg'; // Replace with your actual default image
            }

            Berkas::create($validatedData);
            return redirect()->route('berkas.index')->with('success', 'Berkas berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            $tipeberkases = Tipe_berkas::all();
            $berkases = Berkas::findOrFail($id);
            return view('admin.berkas.tambah', compact('berkases', 'tipeberkases'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan atau terjadi kesalahan.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try {
            $tipeberkases = Tipe_berkas::all();
            $berkas = Berkas::findOrFail($id);
            return view('admin.berkas.tambah', compact('berkas', 'tipeberkases'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan atau terjadi kesalahan.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        //
        try {
            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'file_berkas' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
                'tipeberkas_id' => 'required|exists:tipe_berkas,id',
                'tanggal' => 'date|required',
            ]);

            $berkases = Berkas::findOrFail($id);

            if ($request->hasFile('file_berkas')) {
                if ($berkases->file_berkas && file_exists(public_path('file_berkas/' . $berkases->file_berkas))) {
                    unlink(public_path('file_berkas/' . $berkases->file_berkas));
                }

                $file = $request->file('file_berkas');
                $filename = date('YmdHis') . "." . $file->getClientOriginalExtension();
                $file->move(public_path('file_berkas/'), $filename);
                $validatedData['file_berkas'] = $filename;
            } else {
                // If no image is uploaded, set a default image
                $validatedData['file_berkas'] = 'default-image.jpg'; // Replace with your actual default image
            }

            $berkases->update($validatedData);
            return redirect()->route('berkas.index')->with('success', 'Informasi berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        //
        try {
            $berkases = Berkas::findOrFail($id);

            if ($berkases->file_berkas && file_exists(public_path('file_berkas/' . $berkases->file_berkas))) {
                unlink(public_path('file_berkas/' . $berkases->file_berkas));
            }

            $berkases->delete();
            return response()->json(['message' => 'Informasi berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus informasi: ' . $e->getMessage()], 500);
        }
    }
}
