<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Store;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $buyer = User::where('role', 'member')->first();
        $store = Store::first();

        Transaction::create([
            'code' => 'TRX001',
            'buyer_id' => $buyer->id,
            'store_id' => $store->id,
            'address' => 'Jl. Merdeka No. 10',
            'address_id' => 'ADDR001',
            'city' => 'Jakarta',
            'postal_code' => '12345',
            'shipping' => 'JNE',
            'shipping_type' => 'REG',
            'shipping_cost' => 15000,
            'tracking_number' => 'JNE123456',
            'tax' => 0,
            'grand_total' => 120000,
            'payment_status' => 'paid',
        ]);
    }
}
