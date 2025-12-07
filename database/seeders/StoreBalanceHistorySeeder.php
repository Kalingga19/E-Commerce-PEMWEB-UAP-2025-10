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

        $histories = [
            [
                'store_balance_id' => $balance->id,
                'type' => 'income',
                'reference_id' => 'TRX001',
                'amount' => 120000,
                'remarks' => 'Pendapatan dari transaksi #TRX001',
            ],
            [
                'store_balance_id' => $balance->id,
                'type' => 'withdraw',
                'reference_id' => 'WD001',
                'amount' => 50000,
                'remarks' => 'Penarikan dana',
            ],
        ];

        foreach ($histories as $item) {
            StoreBalanceHistory::create($item);
        }
    }
}
