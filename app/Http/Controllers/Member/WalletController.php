<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\VirtualAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function create()
    {
        return view('customer.wallet.topup');
    }

    public function store(Request $request)
    {
        // BERSIHKAN FORMAT RUPIAH (100.000 → 100000)
        $rawAmount = preg_replace('/\D/', '', $request->amount);

        // VALIDASI MINIMAL TOPUP
        if ($rawAmount < 10000) {
            return redirect()->back()->with('error', 'Minimal topup adalah Rp 10.000');
        }

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // GENERATE KODE VA UNIK
        $va_code = "TOPUP-" . time() . rand(100, 999);

        // SIMPAN VA TOPUP
        VirtualAccount::create([
            'user_id'        => $user->id,
            'transaction_id' => null,
            'va_code'        => $va_code,
            'amount'         => $rawAmount,   // SIMPAN ANGKA BERSIH
            'type'           => 'topup',
            'is_paid'        => false,
        ]);

        return redirect()
            ->route('payment')
            ->with('success', 'Virtual Account Topup berhasil dibuat: ' . $va_code);
    }
}
