<?php

namespace Database\Seeders;

use App\Models\StoreBalance;
use Illuminate\Database\Seeder;

class StoreBalanceSeeder extends Seeder
{
    public function run(): void
    {
        StoreBalance::create([
            'store_id' => 1,
            'balance' => 0,
        ]);
    }
}
