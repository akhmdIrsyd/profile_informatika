<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    //
    protected $fillable = [
        'nama',

    ];
    public function MataKuliah()
    {
        return $this->hasMany(MataKuliah::class, 'matakuliah_id');
    }
}
