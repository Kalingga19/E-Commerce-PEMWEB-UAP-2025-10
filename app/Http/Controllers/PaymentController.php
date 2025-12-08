<?php

namespace App\Http\Controllers;

use App\Models\VirtualAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        // jika VA code dikirim dari checkout
        if ($request->va) {
            $va = VirtualAccount::where('va_code', $request->va)
                    ->where('user_id', auth()->id())
                    ->first();
        } else {
            // fallback: VA terbaru yg belum dibayar
            $va = VirtualAccount::where('user_id', auth()->id())
                    ->where('is_paid', false)
                    ->latest()
                    ->first();
        }

        return view('customer.payment.index', compact('va'));
    }


    public function process(Request $request)
    {
        $request->validate([
            'va_code' => 'required'
        ]);

        $va = VirtualAccount::where('va_code', $request->va_code)->first();

        // VA tidak ditemukan
        if (!$va) {
            return redirect()->route('payment')
                ->with('error', 'Kode VA tidak ditemukan.');
        }

        // Sudah dibayar
        if ($va->is_paid) {
            return redirect()->route('history')
                ->with('error', 'VA ini sudah dibayar sebelumnya.');
        }

        // === HANDLE TOPUP ===
        if ($va->type === 'topup') {
            $balance = $va->user->balance;
            $balance->balance += $va->amount;
            $balance->save();

            $va->is_paid = true;
            $va->save();

            return redirect()->route('wallet.topup')
                ->with('success', 'Topup berhasil! Saldo anda bertambah.');
        }

        // === HANDLE TRANSACTION PAYMENT ===
        if ($va->type === 'transaction') {
            $transaction = $va->transaction;

            // update transaksi jadi paid
            $transaction->payment_status = 'paid';
            $transaction->save();

            // tambah saldo toko
            $storeBalance = $transaction->store->storeBalance;
            $storeBalance->balance += $va->amount;
            $storeBalance->save();

            // tandai VA sudah dibayar
            $va->is_paid = true;
            $va->save();

            // REDIRECT KE HALAMAN DETAIL HISTORY
            return redirect()->route('history.show', $transaction->id)
                ->with('success', 'Pembayaran berhasil! Pesanan Anda diproses.');
        }

        return redirect()->route('payment')->with('error', 'Jenis pembayaran tidak dikenali.');
    }

    public function qris(Request $request)
    {
        $transaction = \App\Models\Transaction::findOrFail($request->trx);
        $qris_code = $request->code;

        return view('customer.payment.qris', compact('transaction', 'qris_code'));
    }

}
