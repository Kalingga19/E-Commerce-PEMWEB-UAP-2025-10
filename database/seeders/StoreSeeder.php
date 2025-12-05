<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        Store::create([
            'user_id' => 2,
            'name' => 'Toko Sumber Rejeki',
            'slug' => 'toko-sumber-rejeki',
            'logo' => 'https://images.unsplash.com/photo-1503602642458-232111445657',
            'about' => 'Toko kebutuhan harian dan elektronik terpercaya.',
            'phone' => '081234567890',
            'address_id' => 'ADDR-001',
            'address' => 'Jl. Merdeka No. 123, Jakarta',
            'city' => 'Jakarta',
            'postal_code' => '10110',
            'bank_name' => 'BCA',
            'bank_account_name' => 'Penjual Satu',
            'bank_account_number' => '1234567890',
            'is_verified' => true,
        ]);
    }
}
