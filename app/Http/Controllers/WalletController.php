<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VirtualAccount;

class WalletController extends Controller
{
    public function topup()
    {
        // halaman isian topup
        return view('pages.wallet.topup');
    }

    public function processTopup(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        $user = Auth::user();

        // Generate kode VA unik
        $vaCode = "TOPUP-" . $user->id . "-" . time();

        VirtualAccount::create([
            'va_code'        => $vaCode,
            'type'           => 'topup',         // penting
            'user_id'        => $user->id,
            'transaction_id' => null,
            'amount'         => $request->amount,
            'status'         => 'pending',
        ]);

        // Redirect ke halaman payment sambil membawa kode VA
        return redirect()->route('payment.index', ['va_code' => $vaCode])
            ->with('success', 'Virtual Account berhasil dibuat. Silakan lakukan pembayaran.');
    }
}
