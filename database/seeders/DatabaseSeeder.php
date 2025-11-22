<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin (HR)
        User::create([
            'name' => 'HR Admin',
            'email' => 'admin@hr.com',
            'password' => Hash::make('password'), // passwordnya: password
            'role' => 'admin',
        ]);

        // Akun Employee (Pegawai)
        User::create([
            'name' => 'Budi Pegawai',
            'email' => 'budi@pegawai.com',
            'password' => Hash::make('password'), // passwordnya: password
            'role' => 'employee',
        ]);
    }
}