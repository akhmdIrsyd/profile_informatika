<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    //
    protected $fillable = [
        'judul',
        'url',
        'isi',
        'menu_id',

    ];
    public function menus()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
