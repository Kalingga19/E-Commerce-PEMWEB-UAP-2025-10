<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $store = Auth::user()->store;

        $products = $store->products()->count();
        $orders = $store->transactions()->count();
        $revenue = $store->storeBalance->balance ?? 0;

        return view('seller.dashboard', compact('products', 'orders', 'revenue'));
    }
}
