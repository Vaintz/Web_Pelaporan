<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Pelapor',
            'email' => 'pelapor@unimal.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'pelapor',
        ]);

        User::create([
            'name' => 'Admin Fakultas',
            'email' => 'admin.fakultas@unimal.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'admin_fakultas',
        ]);

        User::create([
            'name' => 'Admin Biro',
            'email' => 'admin.biro@unimal.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'admin_biro',
        ]);
    }
}