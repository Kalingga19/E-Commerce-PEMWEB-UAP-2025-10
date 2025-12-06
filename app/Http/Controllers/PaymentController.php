<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VirtualAccount;
use App\Models\UserBalance;
use App\Models\StoreBalance;
use App\Models\StoreBalanceHistory;
use App\Models\Transaction;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        // Jika user memasukkan kode VA
        $va = null;

        if ($request->va_code) {
            $va = VirtualAccount::where('va_code', $request->va_code)
                ->first();
        }

        return view('pages.payment.payment-page', compact('va'));
    }


    public function confirm(Request $request)
    {
        $request->validate([
            'va_code' => 'required|string',
            'amount'  => 'required|numeric|min:1',
        ]);

        $va = VirtualAccount::where('va_code', $request->va_code)
            ->where('status', 'pending')
            ->first();

        if (!$va) {
            return back()->with('error', 'Kode VA tidak ditemukan atau sudah diproses.');
        }

        if ((int)$va->amount !== (int)$request->amount) {
            return back()->with('error', 'Nominal tidak sesuai dengan tagihan.');
        }

        DB::beginTransaction();

        try {
            // ---------------------------
            // 1. TOPUP SALDO USER
            // ---------------------------
            if ($va->type === 'topup') {

                $balance = UserBalance::firstOrCreate(
                    ['user_id' => $va->user_id],
                    ['balance' => 0]
                );

                $balance->balance += $va->amount;
                $balance->save();

                $va->status = 'paid';
                $va->save();

                DB::commit();
                return redirect()->route('history')
                    ->with('success', 'Topup saldo berhasil!');
            }


            // ---------------------------
            // 2. PEMBAYARAN TRANSAKSI
            // ---------------------------

            $transaction = Transaction::find($va->transaction_id);

            if (!$transaction) {
                DB::rollBack();
                return back()->with('error', 'Transaksi tidak ditemukan.');
            }

            // tandai transaksi sebagai PAID
            $transaction->payment_status = 'paid';
            $transaction->save();

            // tambah saldo toko
            $storeBalance = StoreBalance::firstOrCreate(
                ['store_id' => $transaction->store_id],
                ['balance' => 0]
            );

            $storeBalance->balance += $va->amount;
            $storeBalance->save();

            // histori
            StoreBalanceHistory::create([
                'store_id'    => $transaction->store_id,
                'amount'      => $va->amount,
                'type'        => 'credit',
                'description' => 'Pembayaran VA ' . $va->va_code . ' untuk transaksi #' . $transaction->id,
            ]);

            // update status VA
            $va->status = 'paid';
            $va->save();

            DB::commit();
            return redirect()->route('history')
                ->with('success', 'Pembayaran transaksi berhasil diproses.');

        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
