<?php

namespace App\Http\Controllers\admin;

use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\Kurikulum;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = MataKuliah::with('kurikulum:id,nama')->select([
                'id',
                'kodemk',
                'nama',
                'semester',
                'rps',
                'kurikulum_id'
            ]);

            return DataTables::of($data)
                ->addColumn('kurikulum_nama', function ($row) {
                    return $row->kurikulum ? $row->kurikulum->nama : '-'; // Handle null case
                })
                ->addColumn('rps', function ($row) {
                    if (!empty($row->rps)) {
                        return '
                <a href="' . asset('file_rps/' . $row->rps) . '" target="_blank" rel="noopener noreferrer" class="btn btn-warning btn-circle">
                    <i class="fas fa-eye"></i>
                </a>
            ';
                    } else {
                        return '<span class="text-muted">No RPS Available</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('matakuliah.edit', $row->id) . '" class="btn btn-warning btn-warning">Edit</a>
                                <button class="btn btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>
                    ';
                })
                ->addColumn('semester', function ($row) {
                    if ($row->semester == 9) {
                        return 'Pilihan Ganjil';
                    } elseif ($row->semester == 10) {
                        return 'Pilihan Genap';
                    } else {
                        return $row->semester;
                    }
                })
                ->rawColumns(['kurikulum_nama','rps', 'semester', 'action'])
                ->make(true);
        }
            return view('admin.matakuliah.index');
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        try {
            $kurikulums = Kurikulum::all();
            return view('admin.matakuliah.tambah', compact('kurikulums'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuka form tambah kegiatan: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            // Validasi input
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'kodemk' => 'required|string|max:255',
                'rps' => 'required|file|mimes:pdf|max:2048',
                'sks' => 'required|integer',
                'deskripsi' => 'required|string',
                'semester' => 'required|integer',
                'kurikulum_id' => 'required|string|max:255',
            ]);
           
            // Handle upload gambar
            if ($request->hasFile('rps')) {
                $file = $request->file('rps');
                $destinationPath = 'file_rps';
                $imageName = date('YmdHis') . "." . $file->getClientOriginalExtension();
                $file->move(public_path($destinationPath), $imageName);

                $validatedData['rps'] = $imageName;
            } else {
                // If no image is uploaded, set a default image
                $validatedData['rps'] = 'default-image.pdf'; // Replace with your actual default image
            }

            // Simpan data ke database
            MataKuliah::create($validatedData);

            return redirect()->route('matakuliah.index')->with('success', 'Kegiatan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan Matakuliah: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            $kurikulums = Kurikulum::all();
            $matakuliahs = MataKuliah::findOrFail($id);
            return view('admin.matakuliah.tambah', compact('matakuliahs', 'kurikulums'));
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
            $kurikulums = Kurikulum::all();
            $matakuliahs = MataKuliah::findOrFail($id);
            return view('admin.matakuliah.tambah', compact('matakuliahs', 'kurikulums'));
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
        try {
            $validatedData = $request->validate([
                'itemId' => 'nullable|integer|exists:kurikulums,id',
                'kodemk' => 'required|string|max:255',
                'nama' => 'required|string|max:255',
                'rps' => 'nullable|file|mimes:pdf|max:2048',
                'sks' => 'required|integer',
                'semester' => 'required|integer',
                'deskripsi' => 'required|string',
                'kurikulum_id' => 'required|string|max:255',
            ]);

            $matakuliahs = MataKuliah::findOrFail($id);
            // Check if the itemId is one of the first 5 items in the database

            if ($request->hasFile('rps')) {
                if ($matakuliahs->file_berkas && file_exists(public_path('file_rps/' . $matakuliahs->rps))) {
                    unlink(public_path('file_rps/' . $matakuliahs->rps));
                }
                $file = $request->file('rps');
                $destinationPath = 'file_rps';
                $filename = date('YmdHis') . "." . $file->getClientOriginalExtension();
                $file->move(public_path($destinationPath), $filename);
                $validatedData['rps'] = $filename;
            
            }

            $matakuliahs->update($validatedData);
            return redirect()->route('matakuliah.index')->with('success', 'Kurikulum berhasil diperbarui.');
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
        try {
            $matakuliahs = MataKuliah::findOrFail($id);

            if ($matakuliahs->file_berkas && file_exists(public_path('file_rps/' . $matakuliahs->rps))) {
                unlink(public_path('file_rps/' . $matakuliahs->rps));
            }

            $matakuliahs->delete();
            return response()->json(['message' => 'Matakuliah berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus informasi: ' . $e->getMessage()], 500);
        }
    }
}
