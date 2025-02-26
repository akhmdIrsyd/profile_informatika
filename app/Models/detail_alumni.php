<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detail_alumni extends Model
{
    //
    protected $fillable = [
        'nama',
        'nim',
        'angkatan',
        'lulus',
        'ipk',
        'email',
        'telpon',
        'foto',
        'judul_skripsi',
        'testimoni',

    ];
}