<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipeInfo extends Model
{
    //
    protected $fillable = [
        'nama',
    ];
    public function Informasi()
    {
        return $this->hasMany(Informasi::class, 'tipeinfo_id');
    }
}
