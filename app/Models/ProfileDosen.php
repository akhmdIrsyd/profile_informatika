<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileDosen extends Model
{
    //
    protected $fillable = [
        'nip',
        'nama',
        'jabatan',
        'email',
        'telpon',
        'gscholar',
        'scopus',
        'sinta',
        's1',
        's2',
        's3',
        'minat',
        'foto',
        
    ];
}
