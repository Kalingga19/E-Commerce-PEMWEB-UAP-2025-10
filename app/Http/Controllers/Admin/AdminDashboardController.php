<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\Transaction;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalStores = Store::count();
        $totalProducts = Product::count();
        $totalTransactions = Transaction::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalStores',
            'totalProducts',
            'totalTransactions'
        ));
    }
}
