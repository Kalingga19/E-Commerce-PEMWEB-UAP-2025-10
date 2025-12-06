<?php

namespace App\Http\Controllers;

use App\Models\StoreBalance;
use App\Models\StoreBalanceHistory;
use App\Models\Withdrawal;

class SellerBalanceController extends Controller
{
    public function index()
    {
        $store = auth()->user()->store;

        if (!$store) {
            abort(404, 'Store not found');
        }

        // Saldo toko
        $balance = StoreBalance::firstOrCreate(
            ['store_id' => $store->id],
            ['balance' => 0]
        );

        // Riwayat saldo (paginate)
        $histories = StoreBalanceHistory::where('store_balance_id', $balance->id)
            ->latest()
            ->paginate(10);

        // Total pendapatan (income)
        $totalRevenue = StoreBalanceHistory::where('store_balance_id', $balance->id)
            ->where('type', 'income')
            ->sum('amount');

        // Penarikan dalam status pending
        $pendingWithdrawals = Withdrawal::where('store_balance_id', $balance->id)
            ->where('status', 'pending')
            ->sum('amount');

        return view('seller.balance', compact(
            'store',
            'balance',
            'histories',
            'totalRevenue',
            'pendingWithdrawals'
        ));
    }
}
