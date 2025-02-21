<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipe_berkas extends Model
{
    //
    protected $fillable = [
        'nama',
    ];
    public function Berkas()
    {
        return $this->hasMany(Berkas::class, 'tipeberkas_id');
    }
}
