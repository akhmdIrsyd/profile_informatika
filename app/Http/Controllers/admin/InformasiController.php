<?php

namespace App\Http\Controllers\admin;

use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi;
use App\Models\TipeInfo;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Informasi::with('TipeInfo:id,nama')->select([
                'id',
                'judul',
                'gambar',
                'isi',
                'user_id',
                'tipeinfo_id',
                'created_at'
            ]);

            return DataTables::of($data)
                ->editColumn('created_at', function ($row) {
                    return \Carbon\Carbon::parse($row->created_at)->format('Y-m-d H:i:s');
                })
            ->addColumn('tipeinfo_nama', function ($row) {
                return $row->TipeInfo ? $row->TipeInfo->nama : '-'; // Handle null case
            })

                ->addColumn('action', function ($row) {
                    return '<a href="' . route('informasi.edit', $row->id) . '" class="btn btn-warning btn-warning">Edit</a>
                                <button class="btn btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>
                    ';
                })
                ->rawColumns(['tipeinfo_nama', 'action'])
                ->make(true);
        }
            return view('admin.informasi.index');
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        try {
            $tipeinfos = TipeInfo::all();
            return view('admin.informasi.tambah', compact('tipeinfos'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'isi' => 'required|string',
                'user_id' => 'required|exists:users,id',
                'tipeinfo_id' => 'required|exists:tipe_infos,id',
            ]);

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $destinationPath = 'gambar_informasi';
                $imageName = date('YmdHis') . "." . $file->getClientOriginalExtension();
                $file->move(public_path($destinationPath), $imageName);
                
                $validatedData['gambar'] = $imageName;
            } else {
                // If no image is uploaded, set a default image
                $validatedData['gambar'] = 'default-image.jpg'; // Replace with your actual default image
            }

            Informasi::create($validatedData);
            return redirect()->route('informasi.index')->with('success', 'Informasi berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            $tipeinfos = TipeInfo::all();
            $informasi = Informasi::findOrFail($id);
            return view('admin.informasi.tambah', compact('informasi', 'tipeinfos'));
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
            $informasi = Informasi::findOrFail($id);
            $tipeinfos = TipeInfo::all();
            return view('admin.informasi.tambah', compact('informasi', 'tipeinfos'));
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
                'judul' => 'required|string|max:255',
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'isi' => 'required|string',
                'user_id' => 'required|exists:users,id',
                'tipeinfo_id' => 'required|exists:tipe_infos,id',
            ]);

            $informasi = Informasi::findOrFail($id);

            if ($request->hasFile('gambar')) {
                if ($informasi->gambar && file_exists(public_path('gambar_informasi/' . $informasi->gambar))) {
                    unlink(public_path('gambar_informasi/' . $informasi->gambar));
                }

                $file = $request->file('gambar');
                $filename = date('YmdHis') . "." . $file->getClientOriginalExtension();
                $file->move(public_path('gambar_informasi/'), $filename);
                $validatedData['gambar'] = $filename;
            } else {
                // If no image is uploaded, set a default image
                $validatedData['gambar'] = 'default-image.jpg'; // Replace with your actual default image
            }

            $informasi->update($validatedData);
            return redirect()->route('informasi.index')->with('success', 'Informasi berhasil diperbarui.');
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
            $informasi = Informasi::findOrFail($id);

            if ($informasi->gambar && file_exists(public_path('gambar_informasi/' . $informasi->gambar))) {
                unlink(public_path('gambar_informasi/' . $informasi->gambar));
            }

            $informasi->delete();
            return response()->json(['message' => 'Informasi berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus informasi: ' . $e->getMessage()], 500);
        }
    }
}
