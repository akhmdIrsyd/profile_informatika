<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    //
    protected $fillable = [
        'judul',
        'gambar',
        'tanggal',
        'tanggal_selesai',
        'waktu',
        'tempat',
        'isi',

    ];
}
