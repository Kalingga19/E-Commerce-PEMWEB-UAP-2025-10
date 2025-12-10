<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Withdrawal;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [

            // Count basic data
            'totalUsers'         => User::count(),
            'totalProducts'      => Product::count(),
            'totalStores'        => Store::count(),

            // Store verification stats
            'pendingStores'      => Store::where('is_verified', 0)->count(),
            'approvedStores'     => Store::where('is_verified', 1)->count(),

            // Transactions
            'pendingTransactions'  => Transaction::where('payment_status', 'pending')->count(),
            'completedTransactions' => Transaction::where('payment_status', 'paid')->count(),
            'failedTransactions'    => Transaction::where('payment_status', 'failed')->count(),

            // Withdrawals
            'pendingWithdrawals' => Withdrawal::where('status', 'pending')->count(),
            'approvedWithdrawals'=> Withdrawal::where('status', 'approved')->count(),

            // Latest activities
            'recentTransactions' => Transaction::latest()->take(5)->get(),
            'recentWithdrawals'  => Withdrawal::latest()->take(5)->get(),

        ]);
    }
}
