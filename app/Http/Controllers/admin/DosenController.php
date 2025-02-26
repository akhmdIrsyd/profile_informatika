<?php

namespace App\Http\Controllers\admin;

use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfileDosen;
use Illuminate\Support\Facades\File;
class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = ProfileDosen::select([
                'id',
                'nip',
                'nama',
                'foto',
            ]);

            return DataTables::of($data)
                ->addColumn('foto', function ($row) {
                return'<img src="'. asset('foto_dosen/' . $row->foto) .'" alt="Foto Profil" style="max-width: 100px;">';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('dosen.edit', $row->id) . '" class="btn btn-warning btn-warning">Edit</a>
                                <button class="btn btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>
                    ';
                })
                ->rawColumns(['foto', 'action'])
                ->make(true);
        }
        return view('admin.Dosen.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.dosen.tambah');
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
                'nip' => 'nullable|string|max:255',
                'nama' => 'nullable|string|max:255',
                'jabatan' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'telpon' => 'nullable|string|max:20',
                'gscholar' => 'nullable|string',
                'scopus' => 'nullable|string',
                'sinta' => 'nullable|string',
                's1' => 'nullable|string|max:255',
                's2' => 'nullable|string|max:255',
                's3' => 'nullable|string|max:255',
                'minat' => 'nullable|string|max:255',
                'foto' => 'image|mimes:jpg,jpeg,png|max:2048|nullable',
            ]);

            // Handle upload foto
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $destinationPath = 'foto_dosen';
                $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
                
                $file->move(public_path($destinationPath), $profileImage);


                $validatedData['foto'] = $profileImage; // Save the relative path to the database
            }
            // Simpan data ke database
            ProfileDosen::create($validatedData);

            // Redirect ke halaman daftar dengan pesan sukses
            return redirect()->route('dosen.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika terjadi kesalahan
            
            echo"$e";
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // Cari data berdasarkan ID
        $profile = ProfileDosen::findOrFail($id);

        // Tampilkan ke view dengan data yang diambil
        return view('admin.Dosen.ubah', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        // Cari data berdasarkan ID
        $profile = ProfileDosen::findOrFail($id);

        // Tampilkan ke view dengan data yang diambil
        return view('admin.Dosen.ubah', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            //
            $validatedData = $request->validate([
            'nip' => 'nullable|string|max:20',
            'nama' => 'required|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'telpon' => 'nullable|string|max:15',
            'gscholar' => 'nullable|string',
            'scopus' => 'nullable|string',
            'sinta' => 'nullable|string',
            's1' => 'nullable|string|max:255',
            's2' => 'nullable|string|max:255',
            's3' => 'nullable|string|max:255',
            'minat' => 'nullable|string|max:500',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $profile = ProfileDosen::findOrFail($id);
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($profile->foto && file_exists(public_path('foto_dosen/' . $profile->foto))) {
                unlink(public_path('foto_dosen/' . $profile->foto));
            }

            // Upload foto baru
            $file = $request->file('foto');
            $filename = date('YmdHis') . "." . $file->getClientOriginalExtension();
               

            $file->move(public_path('foto_dosen/'), $filename);

                $validatedData['foto'] = $filename;
        }
        $profile->update($validatedData);
        return redirect()->route('dosen.index')->with('success', 'Profil Dosen Berhasil di Ubah!');
        
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
            $dosen = ProfileDosen::findOrFail($id);
            $dosen->delete();

            // Return success response
            return response()->json(['message' => 'Dosen deleted successfully']);
        } catch (\Exception $e) {
            // Return error response if something goes wrong
            return response()->json(['error' => 'Failed to delete the dosen'], 500);
        }
    }
}
