<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::create(['name' => 'staff', 'guard_name' => 'staff']);
        Role::create(['name' =>'mhs', 'guard_name' => 'mhs']);
        Role::create(['name' => 'dsn', 'guard_name' => 'dsn']);
        Role::create(['name' =>'mitra', 'guard_name' => 'mitra']);
        // Menambahkan role dan permission ke user
        $User->assignRole('staff');
    }
}
