<?php

namespace App\Http\Controllers;

use App\Models\VirtualAccount;
use App\Models\Transaction;
use App\Models\StoreBalance;
use App\Models\StoreBalanceHistory;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // ===========================================================
    // HALAMAN PENCARIAN VA
    // ===========================================================
    public function index(Request $request)
    {
        $va = null;

        if ($request->va_code) {
            $va = VirtualAccount::where('va_code', $request->va_code)->first();

            if (!$va) {
                return back()->with('error', 'Kode Virtual Account tidak ditemukan.');
            }
        }

        return view('payment.payment-page', compact('va'));
    }


    // ===========================================================
    // KONFIRMASI PEMBAYARAN VA
    // ===========================================================
    public function confirm(Request $request)
    {
        $request->validate([
            'va_code' => 'required',
            'amount'  => 'required|numeric'
        ]);

        $va = VirtualAccount::where('va_code', $request->va_code)->first();

        if (!$va) {
            return back()->with('error', 'VA tidak ditemukan!');
        }

        if ($va->status === 'paid') {
            return back()->with('error', 'VA ini sudah dibayar.');
        }

        // Cek nominal harus sama
        if ($request->amount != $va->amount) {
            return back()->with('error', 'Nominal pembayaran tidak sesuai.');
        }


        // ===========================================================
        // UPDATE STATUS VA
        // ===========================================================
        $va->status = 'paid';
        $va->save();


        // ===========================================================
        // UPDATE STATUS TRANSAKSI
        // ===========================================================
        if ($va->transaction_id) {

            $trx = Transaction::find($va->transaction_id);

            if ($trx) {
                $trx->payment_status = 'paid';
                $trx->paid_at = now();
                $trx->status = 'processing'; // Setelah bayar → langsung diproses
                $trx->save();


                // ===========================================================
                // MASUKKAN PENDAPATAN KE SALDO TOKO
                // ===========================================================
                $balance = StoreBalance::firstOrCreate(
                    ['store_id' => $trx->store_id],
                    ['balance' => 0]
                );

                $balance->increment('balance', $trx->grand_total);

                // Catat history pendapatan
                StoreBalanceHistory::create([
                    'store_balance_id' => $balance->id,
                    'type'             => 'income',
                    'reference_id'     => $trx->id,
                    'reference_type'   => 'transaction',
                    'amount'           => $trx->grand_total,
                    'remarks'          => 'Pembayaran transaksi #' . $trx->code,
                ]);
            }
        }


        return back()->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }
}
