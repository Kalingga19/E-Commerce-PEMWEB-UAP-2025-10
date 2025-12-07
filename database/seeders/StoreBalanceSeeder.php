<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\StoreBalance;

class StoreBalanceSeeder extends Seeder
{
    public function run(): void
    {
        $store = Store::first();

        StoreBalance::create([
            'store_id' => $store->id,
            'balance' => 0,
        ]);
    }
}
