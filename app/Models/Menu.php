<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $fillable = [
        'nama',
        'url',
    ];
    public function konten()
    {
        return $this->hasMany(Konten::class, 'menu_id');
    }
}
