<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        $owner = config('seed.owner_id');

        Store::create([
            'user_id' => $owner,
            'name' => 'ZyloMart',
            'logo' => 'logo.png',
            'about' => 'Toko lengkap dan terpercaya.',
            'phone' => '081288061921',
            'address_id' => 'ADDR001',
            'city' => 'Malang',
            'address' => 'Jl. Soekarno Hatta No.123',
            'postal_code' => '12345',
            'is_verified' => 1,
            'bank_name' => 'BCA',
            'bank_account_name' => 'Member Satu',
            'bank_account_number' => '1234567890',
        ]);
    }
}