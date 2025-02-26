<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\DosenController;
use App\Http\Controllers\admin\TipeInfoController;
use App\Http\Controllers\admin\InformasiController;
use App\Http\Controllers\admin\KegiatanController;
use App\Http\Controllers\admin\KurikulumController;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\admin\Tipe_berkasController;
use App\Http\Controllers\admin\BerkasController;
use App\Http\Controllers\admin\AlumniController;
use App\Http\Controllers\admin\KontenController;
use App\Http\Controllers\admin\MataKuliahController;
use App\Http\Controllers\admin\WebGambarController;

use App\Http\Controllers\admin\KetetatanController;
use App\Http\Controllers\admin\ProfilController;
use App\Http\Controllers\admin\WebTextController;
use App\Http\Controllers\admin\DetailAlumniController;
use App\Http\Controllers\LandingPage\HomeController;


//Route::get('notfound', [HomeController::class, 'notfound'])->name('landingpage.notfound');
Route::fallback(function () {
    return response()->view('Landing.notfound', [], 404);
});

Route::get('informasi/list_berita', [HomeController::class, 'berita'])->name('landingpage.berita');
Route::get('informasi/list_beasiswa', [HomeController::class, 'beasiswa'])->name('landingpage.beasiswa');
Route::get('informasi/list_pengumuman', [HomeController::class, 'pengumuman'])->name('landingpage.pengumuman');
Route::get('kemahasiswaan/list_prestasi', [HomeController::class, 'prestasi'])->name('landingpage.prestasi');
Route::get('kemahasiswaan/list_alumni', [HomeController::class, 'alumni'])->name('landingpage.alumni');
Route::get('kemahasiswaan/list_statistik', [HomeController::class, 'statistik'])->name('landingpage.statistik');

Route::get('informasi/detailinformasi/{id}', [HomeController::class, 'detailinformasi'])->name('landingpage.detailinformasi');
Route::get('informasi/list_kegiatan', [HomeController::class, 'kegiatan'])->name('landingpage.kegiatan');
Route::get('informasi/detailkegiatan/{id}', [HomeController::class, 'detailkegiatan'])->name('landingpage.detailkegiatan');


//Route::get('akademik/cpl', [HomeController::class, 'listcpl'])->name('landingpage.listcpl');
Route::get('akademik/matakuliah', [HomeController::class, 'list_MK'])->name('landingpage.matakuliah');

Route::get('profil/list_dosen', [HomeController::class, 'dosen'])->name('landingpage.dosen');
Route::get('profil/detaildosen/{id}', [HomeController::class, 'detaildosen'])->name('landingpage.detaildosen');
Route::get('profil/list_tendik', [HomeController::class, 'tendik'])->name('landingpage.tendik');
Route::get('profil/detailtendik/{id}', [HomeController::class, 'detailtendik'])->name('landingpage.detailtendik');

Route::get('penelitian-dan-pengabdian/buku', [HomeController::class, 'scrapeBooks'])->name('landingpage.buku');
Route::get('penelitian-dan-pengabdian/pengmas', [HomeController::class, 'scrapeServices'])->name('landingpage.pengmas');
Route::get('penelitian-dan-pengabdian/penelitian', [HomeController::class, 'scrapeResearchs'])->name('landingpage.penelitian');
Route::get('penelitian-dan-pengabdian/publikasi', [HomeController::class, 'scrapePublications'])->name('landingpage.publikasi');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('actionlogin', [AuthController::class, 'actionlogin'])->name('actionlogin');
Route::get('actionlogout', [AuthController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/change-password', [AuthController::class, 'password'])->name('password.change');
    Route::post('/change-password', [AuthController::class, 'passwordaction'])->name('password.update');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    #dosen
    Route::get('dosen', [DosenController::class, 'index'])->name('dosen.index');
    Route::get('tambah_dosen', [DosenController::class, 'create'])->name('dosen.create');
    Route::post('dosen', [DosenController::class, 'store'])->name('dosen.store');
    Route::get('/dosen/{id}', [DosenController::class, 'edit'])->name('dosen.edit');
    Route::post('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
    Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');

    #tendik
    Route::get('tendik', [ProfilController::class, 'index'])->name('tendik.index');
    Route::get('tambah_tendik', [ProfilController::class, 'create'])->name('tendik.create');
    Route::post('tendik', [ProfilController::class, 'store'])->name('tendik.store');
    Route::get('/tendik/{id}', [ProfilController::class, 'edit'])->name('tendik.edit');
    Route::post('/tendik/{id}', [ProfilController::class, 'update'])->name('tendik.update');
    Route::delete('/tendik/{id}', [ProfilController::class, 'destroy'])->name('tendik.destroy');

    #informasi
    Route::get('informasi', [InformasiController::class, 'index'])->name('informasi.index');
    Route::get('tambah_informasi', [InformasiController::class, 'create'])->name('informasi.create');
    Route::post('informasi', [InformasiController::class, 'store'])->name('informasi.store');
    Route::get('/informasi/{id}', [InformasiController::class, 'edit'])->name('informasi.edit');
    Route::post('/informasi/{id}', [InformasiController::class, 'update'])->name('informasi.update');
    Route::delete('/informasi/{id}', [InformasiController::class, 'destroy'])->name('informasi.destroy');

    #kegiatan
    Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
    Route::get('tambah_kegiatan', [KegiatanController::class, 'create'])->name('kegiatan.create');
    Route::post('kegiatan', [KegiatanController::class, 'store'])->name('kegiatan.store');
    Route::get('/kegiatan/{id}', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
    Route::post('/kegiatan/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
    Route::delete('/kegiatan/{id}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');

    #tipeinfo
    Route::get('TipeInfo', [TipeInfoController::class, 'index']);
    #Route::get('/TipeInfo/create', [TipeInfoController::class, 'create'])->name('TipeInfo.create');
    Route::post('/TipeInfo', [TipeInfoController::class, 'store'])->name('TipeInfo.store');
    #Route::get('/TipeInfo/{id}/edit', [TipeInfoController::class, 'store'])->name('TipeInfo.edit');
    #Route::put('/TipeInfo/{id}', [TipeInfoController::class, 'store'])->name('TipeInfo.update');
    Route::delete('/TipeInfo/{id}', [TipeInfoController::class, 'destroy'])->name('TipeInfo.destroy');

    #kurikulum
    Route::get('KurikulumInfo', [KurikulumController::class, 'index']);
    #Route::get('/kurikulum/create', [KurikulumController::class, 'create'])->name('kurikulum.create');
    Route::post('/KurikulumInfo', [KurikulumController::class, 'store'])->name('kurikulum.store');
    Route::delete('/KurikulumInfo/{id}', [KurikulumController::class, 'destroy'])->name('kurikulum.destroy');

    #menu
    Route::get('menu', [MenuController::class, 'index']);
    Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
    Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');

    #tipe_berkas
    Route::get('tipe_berkas', [Tipe_berkasController::class, 'index']);
    Route::post('/tipe_berkas', [Tipe_berkasController::class, 'store'])->name('tipe_berkas.store');
    Route::delete('/tipe_berkas/{id}', [Tipe_berkasController::class, 'destroy'])->name('tipe_berkas.destroy');

    #berkas
    Route::get('berkas', [BerkasController::class, 'index'])->name('berkas.index');
    Route::get('tambah_berkas', [BerkasController::class, 'create'])->name('berkas.create');
    Route::post('berkas', [BerkasController::class, 'store'])->name('berkas.store');
    Route::get('/berkas/{id}', [BerkasController::class, 'edit'])->name('berkas.edit');
    Route::post('/berkas/{id}', [BerkasController::class, 'update'])->name('berkas.update');
    Route::delete('/berkas/{id}', [BerkasController::class, 'destroy'])->name('berkas.destroy');


    #data Ketetatan
    Route::get('ketetatan', [KetetatanController::class, 'index']);
    Route::post('/ketetatan', [KetetatanController::class, 'store'])->name('ketetatan.store');
    Route::delete('/ketetatan/{id}', [KetetatanController::class, 'destroy'])->name('ketetatan.destroy');

    #data statistik
    Route::get('alumni', [AlumniController::class, 'index']);
    Route::post('/alumni', [AlumniController::class, 'store'])->name('alumni.store');
    Route::delete('/alumni/{id}', [AlumniController::class, 'destroy'])->name('alumni.destroy');

    #Detail alumni
    Route::get('detailalumni', [DetailAlumniController::class, 'index'])->name('detailalumni.index');
    Route::get('tambah_detailalumni', [DetailAlumniController::class, 'create'])->name('detailalumni.create');
    Route::post('detailalumni', [DetailAlumniController::class, 'store'])->name('detailalumni.store');
    Route::get('/detailalumni/{id}', [DetailAlumniController::class, 'edit'])->name('detailalumni.edit');
    Route::post('/detailalumni/{id}', [DetailAlumniController::class, 'update'])->name('detailalumni.update');
    Route::delete('/detailalumni/{id}', [DetailAlumniController::class, 'destroy'])->name('detailalumni.destroy');

    #konten
    Route::get('konten', [KontenController::class, 'index'])->name('konten.index');
    Route::get('tambah_konten', [KontenController::class, 'create'])->name('konten.create');
    Route::post('konten', [KontenController::class, 'store'])->name('konten.store');
    Route::get('/konten/{id}', [KontenController::class, 'edit'])->name('konten.edit');
    Route::post('/konten/{id}', [KontenController::class, 'update'])->name('konten.update');
    Route::delete('/konten/{id}', [KontenController::class, 'destroy'])->name('konten.destroy');

    #mata kuliah
    Route::get('matakuliah', [MataKuliahController::class, 'index'])->name('matakuliah.index');
    Route::get('tambah_matakuliah', [MataKuliahController::class, 'create'])->name('matakuliah.create');
    Route::post('matakuliah', [MataKuliahController::class, 'store'])->name('matakuliah.store');
    Route::get('/matakuliah/{id}', [MataKuliahController::class, 'edit'])->name('matakuliah.edit');
    Route::post('/matakuliah/{id}', [MataKuliahController::class, 'update'])->name('matakuliah.update');
    Route::delete('/matakuliah/{id}', [MataKuliahController::class, 'destroy'])->name('matakuliah.destroy');

    #dinamis menu
    Route::get('/admin/{menu}/{submenu?}', [KontenController::class, 'show'])->name('konten.show');
    Route::post('/konten_update_detail/{id}', [KontenController::class, 'update_detail'])->name('konten.update_detail');

    #website gambar
    Route::get('webgambar', [WebGambarController::class, 'index']);
    Route::post('/webgambar', [WebGambarController::class, 'store'])->name('webgambar.store');

    #website text
    Route::get('webtext', [WebTextController::class, 'index']);
    Route::post('/webtext', [WebTextController::class, 'store'])->name('webtext.store');
});

Route::get('/', [HomeController::class, 'index'])->name('landingpage.home');


#dinamis menu
Route::get('/{menu}/{submenu?}', [HomeController::class, 'konten'])->name('landingpage.konten');
//Route::post('/konten_update_detail/{id}', [KontenController::class, 'update_detail'])->name('konten.update_detail');

//Route::middleware('auth')->group(function () {
//    Route::get('dashboard', [DashboardController::class, 'index']);
//
//});




