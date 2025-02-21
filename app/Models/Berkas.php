<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    //
    protected $fillable = [
        'judul',
        'file_berkas',
        'tipeberkas_id',
        'tanggal',

    ];
    public function TipeBerkas()
    {
        return $this->belongsTo(Tipe_berkas::class, 'tipeberkas_id');
    }
}
