<?php

namespace App\Http\Controllers;

use App\Models\StoreBalance;
use App\Models\StoreBalanceHistory;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class SellerWithdrawController extends Controller
{
    public function index()
    {
        $store = auth()->user()->store;

        $balance = StoreBalance::firstOrCreate(
            ['store_id' => $store->id],
            ['balance' => 0]
        );

        // List pengajuan withdraw
        $withdrawals = Withdrawal::where('store_balance_id', $balance->id)
            ->latest()
            ->paginate(10);

        // Pending withdraw total
        $pendingWithdrawals = Withdrawal::where('store_balance_id', $balance->id)
            ->where('status', 'pending')
            ->sum('amount');

        return view('seller.withdrawals', compact(
            'store',
            'balance',
            'withdrawals',
            'pendingWithdrawals'
        ));
    }


    public function store(Request $request)
    {
        $store = auth()->user()->store;

        $balance = StoreBalance::firstOrCreate(
            ['store_id' => $store->id],
            ['balance' => 0]
        );

        $request->validate([
            'amount' => 'required|numeric|min:50000',
            'notes' => 'nullable|string|max:255',
        ]);

        if ($balance->balance < $request->amount) {
            return back()->with('error', 'Saldo tidak mencukupi untuk withdraw.');
        }

        // Buat pengajuan penarikan
        $withdraw = Withdrawal::create([
            'store_balance_id' => $balance->id,
            'amount' => $request->amount,
            'bank_name' => $store->bank_name,
            'bank_account_name' => $store->account_holder_name,
            'bank_account_number' => $store->account_number,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        // Kurangi saldo toko
        $balance->balance -= $request->amount;
        $balance->save();

        // Catat histori saldo
        StoreBalanceHistory::create([
            'store_balance_id' => $balance->id,
            'type' => 'withdraw',
            'reference_id' => $withdraw->id,
            'reference_type' => 'withdraw',
            'amount' => $request->amount,
            'remarks' => 'Withdraw saldo #' . $withdraw->id,
            'ending_balance' => $balance->balance
        ]);

        return back()->with('success', 'Pengajuan penarikan berhasil dibuat.');
    }
}
