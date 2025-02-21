<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Insert user with 'admin' id and password
        $User = User::create([
            'username' => 'admin',
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('adminadmin'), // Hash the password
            'usertype' => 'admin', // Optional, set the usertype
        ]);
       
    }
}
