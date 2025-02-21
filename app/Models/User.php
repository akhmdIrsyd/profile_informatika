<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    //protected $keyType = 'string'; // Specify the key type as string
    //public $incrementing = false; // Disable auto-incrementing for the id column
    protected $fillable = [
        //'id',
        'username',
        'name',
        'email',
        'password',
        'usertype',
    ];

    // Add this method to override the default email check
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isMHS()
    {
        return $this->role === 'MHS';
    }
    public function isDSN()
    {
        return $this->role === 'DSN';
    }
    public function Informasi()
    {
        return $this->hasMany(Informasi::class, 'id_user');
    }
}
