<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ketetatan extends Model
{
    // 
    protected $fillable = [
        'tahun',
        'jml_snmptn',
        'kuota_snmptn',
        'jml_sbnptn',
        'kuota_sbnptn',
        'jml_mandiri',
        'kuota_mandiri',

    ];
}
