<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\detail_alumni;

class DetailAlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = detail_alumni::select([
                    'id',
                    'nim',
                    'nama',
                    'foto',
                ]);

            return DataTables::of($data)
                ->addColumn('foto', function ($row) {
                    return '<img src="' . asset('foto_alumni/' . $row->foto) . '" alt="Foto Profil" style="max-width: 100px;">';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('detailalumni.edit', $row->id) . '" class="btn btn-warning btn-warning">Edit</a>
                                <button class="btn btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>
                    ';
                })
                ->rawColumns(['foto', 'action'])
                ->make(true);
        }
        return view('admin.detailalumni.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.detailalumni.tambah');
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
                'nim' => 'nullable|string|max:255',
                'nama' => 'nullable|string|max:255',
                'angkatan' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'telpon' => 'nullable|string|max:20',
                'lulus' => 'nullable|string',
                'ipk' => 'nullable|string',
                'judul_skripsi' => 'nullable|string',
                'testimoni' => 'nullable|string|max:255',
                'foto' => 'image|mimes:jpg,jpeg,png|max:2048|nullable',
            ]);

            // Handle upload foto
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $destinationPath = 'foto_alumni';
                $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();

                $file->move(public_path($destinationPath), $profileImage);


                $validatedData['foto'] = $profileImage; // Save the relative path to the database
            }
            // Simpan data ke database
            detail_alumni::create($validatedData);

            // Redirect ke halaman daftar dengan pesan sukses
            return redirect()->route('detailalumni.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika terjadi kesalahan

            echo "$e";
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $profile = detail_alumni::findOrFail($id);

        // Tampilkan ke view dengan data yang diambil
        return view('admin.detailalumni.ubah', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $profile = detail_alumni::findOrFail($id);

        // Tampilkan ke view dengan data yang diambil
        return view('admin.detailalumni.ubah', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            //
            $validatedData = $request->validate([
                'nim' => 'nullable|string|max:255',
                'nama' => 'nullable|string|max:255',
                'angkatan' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'telpon' => 'nullable|string|max:20',
                'lulus' => 'nullable|string',
                'ipk' => 'nullable|string',
                'judul_skripsi' => 'nullable|string',
                'testimoni' => 'nullable|string|max:255',
                'foto' => 'image|mimes:jpg,jpeg,png|max:2048|nullable',
            ]);

            $profile = detail_alumni::findOrFail($id);
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($profile->foto && file_exists(public_path('foto_alumni/' . $profile->foto))) {
                    unlink(public_path('foto_alumni/' . $profile->foto));
                }

                // Upload foto baru
                $file = $request->file('foto');
                $filename = date('YmdHis') . "." . $file->getClientOriginalExtension();


                $file->move(public_path('foto_alumni/'), $filename);

                $validatedData['foto'] = $filename;
            }
            $profile->update($validatedData);
            return redirect()->route('detailalumni.index')->with('success', 'Profil Dosen Berhasil di Ubah!');
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
            $dosen = detail_alumni::findOrFail($id);
            $dosen->delete();

            // Return success response
            return response()->json(['message' => 'Dosen deleted successfully']);
        } catch (\Exception $e) {
            // Return error response if something goes wrong
            return response()->json(['error' => 'Failed to delete the dosen'], 500);
        }
    }
}
