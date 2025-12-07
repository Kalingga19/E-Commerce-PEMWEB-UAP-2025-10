<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StoreBalance;
use App\Models\StoreBalanceHistory;

class StoreBalanceHistorySeeder extends Seeder
{
    public function run(): void
    {
        $balance = StoreBalance::first();

        // Income dari transaksi
        StoreBalanceHistory::create([
            'store_balance_id' => $balance->id,
            'type' => 'income',
            'reference_id' => 'TRX001',
            'reference_type' => 'transaction',
            'amount' => 120000,
            'remarks' => 'Pendapatan dari transaksi #TRX001',
        ]);

        // Withdrawal dari toko
        StoreBalanceHistory::create([
            'store_balance_id' => $balance->id,
            'type' => 'withdraw',
            'reference_id' => 'WD001',
            'reference_type' => 'withdrawal',
            'amount' => 50000,
            'remarks' => 'Penarikan dana',
        ]);
    }
}
