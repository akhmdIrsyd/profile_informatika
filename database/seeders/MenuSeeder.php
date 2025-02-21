<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Konten;
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  //

        $menus = [
            ['nama' => 'Informasi', 'url' => 'informasi'],
            ['nama' => 'Profil',
                'url' => 'profil'
            ],
            ['nama' => 'Akademik', 'url' => 'akademik'],
            ['nama' => 'Kemahasiswaan', 'url' => 'kemahasiswaan'],
            ['nama' => 'Penelitian dan Pengabdian', 'url' => 'penelitian-dan-pengabdian'],
        ];

        foreach ($menus as $menuData) {
            $menu = Menu::create($menuData);

            // Inisialisasi variabel untuk menghindari Undefined Variable
            $subMenus = [];

            // Menambahkan SubMenu ke setiap Menu jika ada
            if ($menu->url == 'profil') {
                $subMenus = [
                    ['judul' => 'Sejarah', 'url' => 'sejarah', 'isi' => 'Sejarah'],
                    ['judul' => 'Visi dan Misi', 'url' => 'visimisi', 'isi' => 'Visi dan Misi'],
                    ['judul' => 'Struktur Organisasi', 'url' => 'OrganisasiProdi', 'isi' => 'Struktur Organisasi'],
                    ['judul' => 'Renop Prodi', 'url' => 'RenopProdi', 'isi' => 'Renop Prodi'],
                ];
            } elseif ($menu->url == 'akademik'
            ) {
                $subMenus = [
                    ['judul' => 'Kalender akademik', 'url' => 'KalenderAkademik', 'isi' => 'Kalender akademik'],
                    ['judul' => 'Biaya Kuliah', 'url' => 'BiayaKuliah', 'isi' => 'Biaya Kuliah'],
                    ['judul' => 'Syarat pendaftaran', 'url' => 'SyaratPendaftaran', 'isi' => 'Syarat pendaftaran'],
                    ['judul' => 'KKN', 'url' => 'kkn', 'isi' => 'KKN'],
                    ['judul' => 'PKL', 'url' => 'pkl', 'isi' => 'PKL'],
                    ['judul' => 'MBKM', 'url' => 'mbkm', 'isi' => 'MBKM'],
                    ['judul' => 'Jadwal Kuliah', 'url' => 'JadwalKuliah', 'isi' => 'Jadwal Kuliah'],
                    ['judul' => 'Syarat kelulusan', 'url' => 'Kelulusan', 'isi' => 'Syarat kelulusan'],
                    ['judul' => 'CPL', 'url' => 'cpl', 'isi' => 'CPL'],
                ];
            } elseif ($menu->url == 'kemahasiswaan'
            ) {
                $subMenus = [
                    ['judul' => 'Organisasi mahasiswa', 'url' => 'OrganisasiMHS', 'isi' => 'Organisasi mahasiswa'],
                    ['judul' => 'PKM', 'url' => 'PKM', 'isi' => 'PKM'],
                ];
            } elseif (
                $menu->url == 'penelitian-dan-pengabdian'
            ) {
                $subMenus = [
                    ['judul' => 'Jurnal', 'url' => 'jurnal', 'isi' => 'Data Jurnal'],
                ];
            }

            // Menyimpan SubMenu hanya jika ada isinya
            if (!empty($subMenus)) {
                foreach ($subMenus as $subMenuData) {
                    $menu->Konten()->create($subMenuData);
                }
            }
        }

        
        
    }
}
