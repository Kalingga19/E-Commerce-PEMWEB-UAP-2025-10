<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Auth::user()->store
            ->withdrawals()
            ->latest()
            ->paginate(10) // jumlah per halaman
            ->withQueryString(); // supaya filter status tetap kebawa

        return view('seller.withdrawals.index', compact('withdrawals'));
    }

    public function create()
    {
        $store = Auth::user()->store;

        $balance = $store->storeBalance->balance ?? 0;

        $withdrawals = $store->withdrawals()
            ->latest()
            ->take(3)
            ->get();

        return view('seller.withdrawals.create', compact('balance', 'withdrawals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        $store = Auth::user()->store;

        if ($store->storeBalance->balance < $request->amount) {
            return back()->with('error', 'Saldo tidak mencukupi.');
        }

        Withdrawal::create([
            'store_id' => $store->id,
            'amount' => $request->amount,
            'bank_name' => $store->bank_name,
            'bank_account_name' => $store->bank_account_name,
            'bank_account_number' => $store->bank_account_number,
            'status' => 'pending',
        ]);

        return redirect()->route('seller.withdrawals.index')->with('success', 'Withdraw berhasil diajukan.');
    }
}
