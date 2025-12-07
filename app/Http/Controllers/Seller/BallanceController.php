<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    public function index()
    {
        $store = Auth::user()->store;

        return view('seller.balance.index', [
            'balance' => $store->storeBalance->balance,
            'histories' => $store->storeBalance->storeBalanceHistories()->latest()->get(),
        ]);
    }
}
