<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Admin user
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'OBESIFIT',
            'email' => 'admin@obesifit.com',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);

        // Sample doctor
        User::create([
            'first_name' => 'Dr. Sarah',
            'last_name' => 'Medika',
            'email' => 'dokter@obesifit.com',
            'password' => Hash::make('password123'),
            'role' => 'doctor',
            'specialization' => 'Ahli Gizi',
            'license_number' => 'STR123456'
        ]);
    }
}