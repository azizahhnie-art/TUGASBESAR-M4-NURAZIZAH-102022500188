<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Venue',
            'email' => 'admin@venue.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Pelanggan Biasa',
            'email' => 'user@venue.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}