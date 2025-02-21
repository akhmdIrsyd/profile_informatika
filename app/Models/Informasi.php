<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    //
    protected $fillable = [
        'judul',
        'gambar',
        'isi',
        'user_id',
        'tipeinfo_id',

    ];
    public function User()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function TipeInfo()
    {
        return $this->belongsTo(TipeInfo::class, 'tipeinfo_id');
    }
}
