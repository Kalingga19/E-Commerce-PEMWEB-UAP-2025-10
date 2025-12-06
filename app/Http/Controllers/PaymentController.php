<?php

namespace App\Http\Controllers;

use App\Models\VirtualAccount;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * HALAMAN PENCARIAN VA
     */
    public function index(Request $request)
    {
        $va = null;

        // Jika user memasukkan kode VA
        if ($request->has('va_code')) {
            $va = VirtualAccount::where('va_code', $request->va_code)->first();

            if (!$va) {
                return back()->with('error', 'Virtual Account tidak ditemukan.');
            }
        }

        return view('payment.payment-page', compact('va'));
    }


    /**
     * KONFIRMASI PEMBAYARAN VA
     */
    public function confirm(Request $request)
    {
        $request->validate([
            'va_code' => 'required',
            'amount'  => 'required|numeric'
        ]);

        $va = VirtualAccount::where('va_code', $request->va_code)->first();

        if (!$va) {
            return back()->with('error', 'VA tidak ditemukan.');
        }

        // Cek nominal harus sama
        if ($va->amount != $request->amount) {
            return back()->with('error', 'Nominal transfer tidak sesuai.');
        }

        // Kalau sudah dibayar
        if ($va->status === 'paid') {
            return back()->with('error', 'VA ini sudah dibayar sebelumnya.');
        }

        // Update status VA
        $va->update([
            'status' => 'paid'
        ]);

        /**
         * Jika VA adalah pembayaran pembelian
         * Maka update status transaksi user
         */
        if ($va->type === 'purchase' && $va->transaction_id) {
            $transaction = Transaction::find($va->transaction_id);

            if ($transaction) {
                $transaction->payment_status = 'paid';
                $transaction->status = 'processing'; // atau pending, terserah flowmu
                $transaction->save();
            }
        }

        return redirect()
            ->route('payment.index', ['va_code' => $va->va_code])
            ->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }
}
