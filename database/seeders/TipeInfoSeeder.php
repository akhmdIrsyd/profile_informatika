<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipeInfo;
class TipeInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['nama' => 'Pengumuman'],
            ['nama' => 'Beasiswa'],
            ['nama' => 'Berita'],
        ];

        TipeInfo::insert($data);
    }
}
