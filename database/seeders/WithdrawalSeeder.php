<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\Withdrawal;

class WithdrawalSeeder extends Seeder
{
    public function run(): void
    {
        $store = Store::first();

        Withdrawal::create([
            'store_id' => $store->id,
            'amount' => 50000,
            'bank_name' => 'BCA',
            'bank_account_name' => 'Member Satu',
            'bank_account_number' => '1234567890',
            'status' => 'approved',
        ]);
    }
}
