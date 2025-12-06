<?php

namespace App\Http\Controllers;

use App\Models\VirtualAccount;
use App\Models\Transaction;
use App\Models\StoreBalance;
use App\Models\StoreBalanceHistory;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // ============================================
    // 1. Halaman Pencarian VA
    // ============================================
    public function index(Request $request)
    {
        $va = null;

        // kalau user mengetik kode VA
        if ($request->va_code) {
            $va = VirtualAccount::where('va_code', $request->va_code)->first();
        }

        return view('pages.payment-page', compact('va'));
    }


    // ============================================
    // 2. Konfirmasi Pembayaran VA
    // ============================================
    public function confirm(Request $request)
    {
        $request->validate([
            'va_code' => 'required',
            'amount'  => 'required|numeric'
        ]);

        // Ambil VA
        $va = VirtualAccount::where('va_code', $request->va_code)->first();

        if (!$va) {
            return back()->with('error', 'Kode VA tidak ditemukan.');
        }

        // Jangan proses kalau sudah paid
        if ($va->status !== 'pending') {
            return back()->with('error', 'Pembayaran sudah diproses.');
        }

        // Nominal harus tepat
        if ($va->amount != $request->amount) {
            return back()->with('error', 'Nominal tidak sesuai dengan tagihan.');
        }

        // Update status VA
        $va->status = 'paid';
        $va->save();


        // Jika VA untuk pembelian
        if ($va->type === 'purchase' && $va->transaction_id) {

            $transaction = Transaction::find($va->transaction_id);

            if ($transaction) {

                // Update transaksi → paid
                $transaction->payment_status = 'paid';
                $transaction->paid_at = now();
                $transaction->save();

                // Tambahkan saldo ke toko
                $balance = StoreBalance::firstOrCreate(
                    ['store_id' => $transaction->store_id],
                    ['balance' => 0]
                );

                $balance->balance += $va->amount;
                $balance->save();

                // Catat riwayat saldo toko
                StoreBalanceHistory::create([
                    'store_balance_id' => $balance->id,
                    'type' => 'income',
                    'reference_id' => $transaction->id,
                    'reference_type' => 'transaction',
                    'amount' => $va->amount,
                    'remarks' => 'Pembayaran transaksi #' . $transaction->id,
                ]);
            }
        }

        return redirect()
            ->route('customer.orders')
            ->with('success', 'Pembayaran berhasil! Pesanan sedang diproses.');
    }
}
