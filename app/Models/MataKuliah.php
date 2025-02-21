<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    //
    protected $fillable = [
        'nama',
        'sks',
        'rps',
        'deskripsi',
        'semester',
        'kurikulum_id',
        'kodemk',
        

    ];
    public function Kurikulum()
    {
        return $this->belongsTo(Kurikulum::class, 'kurikulum_id');
    }
}
