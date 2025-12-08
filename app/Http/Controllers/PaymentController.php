<?php

namespace App\Http\Controllers;

use App\Models\VirtualAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        // Ambil VA terbaru milik user yang belum dibayar
        $va = \App\Models\VirtualAccount::where('user_id', auth()->id())
                    ->where('is_paid', false)
                    ->latest()
                    ->first();

        return view('customer.payment.index', compact('va'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'va_code' => 'required'
        ]);

        $va = VirtualAccount::where('va_code', $request->va_code)->first();

        if (!$va) {
            return back()->with('error', 'Kode Virtual Account tidak ditemukan!');
        }

        if ($va->user_id !== auth()->id()) {
            return back()->with('error', 'VA ini bukan milik Anda.');
        }

        // TOPUP HANDLING
        if ($va->type === 'topup') {
            $balance = $va->user->balance;
            $balance->balance += $va->amount;
            $balance->save();

            $va->is_paid = true;
            $va->save();

            return back()->with('success', 'Topup berhasil! Saldo bertambah.');
        }

        // TRANSACTION HANDLING
        if ($va->type === 'transaction') {
            $transaction = $va->transaction;

            $transaction->payment_status = 'paid';
            $transaction->save();

            // Tambahkan saldo toko
            $storeBalance = $transaction->store->storeBalance;
            $storeBalance->balance += $va->amount;
            $storeBalance->save();

            $va->is_paid = true;
            $va->save();

            return back()->with('success', 'Pembayaran transaksi berhasil!');
        }
    }
}
