<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WebGambar;
use App\Models\WebText;

class WebGambarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['nama' => 'Gambar Selamat Datang', 'file' => 'default.png'],
            ['nama' => 'Logo Website', 'file' => 'default.png'],
            ['nama' =>'Logo Kementerian', 'file' => 'default.png'],
            ['nama' =>'Logo Universitas', 'file' => 'default.png'],
        ];

        WebGambar::insert($data);

        $data1 = [
            ['nama' =>'Nama Prodi', 'isi' => 'Program Studi Informatika'],
            ['nama' =>'Nama Fakultas', 'isi' => 'Fakultas Teknik'],
            ['nama' =>'Nama Kementerian', 'isi' => 'Kementerian Pendidikan Tinggi, Riset dan Sains'],
            ['nama' => 'Alamat', 'isi' => 'Jalan Sambaliung, Fakultas Teknik, Kampus Gunung Kelua, Samarinda, Kalimantan Timur'],
            ['nama' => 'Telpon', 'isi' => '0823-607080-96'],
            ['nama' => 'email', 'isi' => 'informatika@ft.unmul.ac.id'],
            ['nama' => 'Instagram', 'isi' => 'Instagram'],
            ['nama' => 'Youtube', 'isi' => 'Youtube'],
            ['nama' => 'Facebook', 'isi' => 'Facebook'],
            ['nama' => 'Video Profil', 'isi' => 'Link Youtube'],
            ['nama' => 'text welcome', 'isi' => 'Menjadi program studi yang unggul di tingkat Nasional melalui Tri Darma Perguruan Tinggi khususnya terkait hutan tropis lembab (tropical rain forest) dan lingkungannya di bidang Informatika serta menghasilkan sumber daya manusia yang kompetitif.'],
        ];

        WebText::insert($data1);
    }
}
