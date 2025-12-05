<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // Seller
        User::create([
            'name' => 'Penjual Satu',
            'email' => 'seller1@example.com',
            'role' => 'member',
            'password' => Hash::make('password'),
        ]);

        // Member
        User::create([
            'name' => 'Member Dua',
            'email' => 'member2@example.com',
            'role' => 'member',
            'password' => Hash::make('password'),
        ]);
    }
}
