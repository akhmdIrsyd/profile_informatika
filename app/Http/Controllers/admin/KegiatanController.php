<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Yajra\DataTables\Facades\DataTables;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Kegiatan::select([
                'id',
                'judul',
                'tanggal',
                'waktu',
                'tempat',
            ]);

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('kegiatan.edit', $row->id) . '" class="btn btn-warning btn-warning">Edit</a>
                                <button class="btn btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>
                    ';
                })
                ->addColumn('tanggalwaktu', function ($row) {

                    return $row->tanggal . ',</br>' . $row->waktu;
                })
                ->rawColumns(['tanggalwaktu','action'])
                ->make(true);
        }
            return view('admin.kegiatan.index');
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        try {
            return view('admin.kegiatan.tambah');
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
                'judul' => 'required|string|max:255',
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'tanggal' => 'required|date',
                'tanggal_selesai' => 'nullable|date',
                'waktu' => 'required|date_format:H:i',
                'tempat' => 'required|string|max:255',
                'isi' => 'nullable|string',
            ]);

            // Handle upload gambar
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $destinationPath = 'gambar_kegiatan';
                $imageName = date('YmdHis') . "." . $file->getClientOriginalExtension();
                $file->move(public_path($destinationPath), $imageName);

                $validatedData['gambar'] = $imageName;
            } else {
                // If no image is uploaded, set a default image
                $validatedData['gambar'] = 'default-image.jpg'; // Replace with your actual default image
            }

            // Simpan data ke database
            Kegiatan::create($validatedData);

            return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan kegiatan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            $kegiatan = Kegiatan::findOrFail($id);
            return view('admin.kegiatan.tambah', compact('kegiatan'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengambil data kegiatan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try {
            $kegiatan = Kegiatan::findOrFail($id);
            return view('admin.kegiatan.tambah', compact('kegiatan'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuka form edit kegiatan: ' . $e->getMessage());
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
                'tanggal' => 'required|date',
                'tanggal_selesai' => 'nullable|date',
                'waktu' => 'required',
                'tempat' => 'required|string|max:255',
                'isi' => 'nullable|string',
            ]);

            $kegiatan = Kegiatan::findOrFail($id);

            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($kegiatan->gambar && file_exists(public_path('gambar_kegiatan/' . $kegiatan->gambar))) {
                    unlink(public_path('gambar_kegiatan/' . $kegiatan->gambar));
                }

                // Upload gambar baru
                $file = $request->file('gambar');
                $imageName = date('YmdHis') . "." . $file->getClientOriginalExtension();
                $file->move(public_path('gambar_kegiatan/'), $imageName);

                $validatedData['gambar'] = $imageName;
            } else {
                // If no image is uploaded, set a default image
                $validatedData['gambar'] = 'default-image.jpg'; // Replace with your actual default image
            }

            $kegiatan->update($validatedData);

            return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diubah.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui kegiatan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $kegiatan = Kegiatan::findOrFail($id);

            // Hapus gambar jika ada
            if ($kegiatan->gambar && file_exists(public_path('gambar_kegiatan/' . $kegiatan->gambar))) {
                unlink(public_path('gambar_kegiatan/' . $kegiatan->gambar));
            }

            $kegiatan->delete();

            return response()->json(['message' => 'Kegiatan berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus kegiatan: ' . $e->getMessage()], 500);
        }
    }
}
