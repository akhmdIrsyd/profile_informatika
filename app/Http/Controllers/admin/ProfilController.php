<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Profil;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Profil::select([
                'id',
                'nama',
                'nip'
            ]);
            return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '
                   <a href="' . route('tendik.edit', $row->id) . '" class="btn btn-warning btn-warning">Edit</a>
                                <button class="btn btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>
                    ';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.tendik.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.tendik.tambah');
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
                'instansi' => 'nullable|string|max:255|',
                'email' => 'nullable|email|max:255',
                'telpon' => 'nullable|string|max:20',
                'foto' => 'image|mimes:jpg,jpeg,png|max:2048|nullable',
            ]);

            // Handle upload foto
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $destinationPath = 'foto_profil';
                $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
                $file->move(public_path($destinationPath), $profileImage);

                $validatedData['foto'] = $profileImage;
            }

            // Simpan data ke database
            Profil::create($validatedData);

            return redirect()->route('tendik.index')->with('success', 'Data berhasil ditambahkan.');
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
        $profil = Profil::findOrFail($id);
        return view('admin.tendik.ubah', compact('profil'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $profil = Profil::findOrFail($id);
        return view('admin.tendik.ubah', compact('profil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $validatedData = $request->validate([
                'nip' => 'nullable|string|max:255',
                'nama' => 'nullable|string|max:255',
                'instansi' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'telpon' => 'nullable|string|max:20',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $profil = Profil::findOrFail($id);

            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($profil->foto && file_exists(public_path('foto_profil/' . $profil->foto))) {
                    unlink(public_path('foto_profil/' . $profil->foto));
                }

                // Upload foto baru
                $file = $request->file('foto');
                $filename = date('YmdHis') . "." . $file->getClientOriginalExtension();
                $file->move(public_path('foto_profil/'), $filename);

                $validatedData['foto'] = $filename;
            }

            $profil->update($validatedData);

            return redirect()->route('tendik.index')->with('success', 'Data berhasil diubah.');
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
            $profil = Profil::findOrFail($id);

            // Hapus foto jika ada
            if ($profil->foto && file_exists(public_path('foto_profil/' . $profil->foto))) {
                unlink(public_path('foto_profil/' . $profil->foto));
            }

            $profil->delete();

            return response()->json(['message' => 'Data berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data'], 500);
        }
    }
}
