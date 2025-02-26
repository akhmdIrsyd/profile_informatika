<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Konten;
use App\Models\Menu;

class KontenController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Menu::select(['id','nama', 'url'])
            
        if ($request->ajax()) {
        $data = Konten::with('menus:id,nama')->select([
            'id',
            'judul',
            'url',
            'menu_id',
        ])->skip(16)
                ->take(16)
                ->get();;

        return DataTables::of($data)
            ->addColumn('menu_nama', function ($row) {
                return $row->menus ? $row->menus->nama : '-'; // Handle null case
            })
            
            ->addColumn('action', function ($row) {
                return '<a href="' . route('konten.edit', $row->id) . '" class="btn btn-warning btn-warning">Edit</a>
                                <button class="btn btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>
                    ';
            })
            ->rawColumns(['menu_nama', 'action'])
            ->make(true);
        }
            return view('admin.konten.index');
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $menus = Menu::all();
            return view('admin.konten.tambah', compact('menus'));
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
        //
        try {
            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'url' => 'required|string|max:255',
                'menu_id' => 'required|exists:menus,id',
                'isi' => 'required',
                
            ]);


            Konten::create($validatedData);
            return redirect()->route('konten.index')->with('success', 'Informasi berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($menu, $submenu = null)
    {
        //
        // Cek apakah menu ada
        $menu = Menu::where('url', $menu)->firstOrFail();

        if ($submenu) {
            // Jika submenu ada, cari kontennya
            $konten = Konten::where('url', $submenu)->where('menu_id', $menu->id)->firstOrFail();
        } else {
            $konten = null; // Tidak ada submenu, tampilkan halaman utama menu
        }

        return view('admin.konten.detail', compact('menu', 'konten'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try {
            $menus = Menu::all();
            $konten = Konten::findOrFail($id);
            return view('admin.konten.tambah', compact('konten', 'menus'));
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
                'url' => 'required|string|max:255',
                'menu_id' => 'required|exists:menus,id',
                'isi' => 'required',
            ]);

            $konten = Konten::findOrFail($id);

            $konten->update($validatedData);
            return redirect()->route('konten.index')->with('success', 'Informasi berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update_detail(Request $request, string $id)
    {
        //
        //
        try {
            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'url' => 'required|string|max:255',
                'menu_id' => 'required|exists:menus,id',
                'isi' => 'required',
            ]);

            $konten = Konten::findOrFail($id);

            $konten->update($validatedData);
            return redirect()->route('konten.show', ['menu' => $konten->menus->url, 'submenu' => $konten->url])
                ->with('success', 'Konten berhasil diperbarui!');
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
            $konten = Konten::findOrFail($id);
            $konten->delete();
            return response()->json(['message' => 'Informasi berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus informasi: ' . $e->getMessage()], 500);
        }
    }
}
