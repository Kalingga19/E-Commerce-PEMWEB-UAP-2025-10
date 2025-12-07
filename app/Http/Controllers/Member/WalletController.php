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
        $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        $user = Auth::user();

        $va_code = "TOPUP-" . rand(100000, 999999);

        VirtualAccount::create([
            'user_id' => $user->id,
            'transaction_id' => null,
            'va_code' => $va_code,
            'amount' => $request->amount,
            'type' => 'topup',
            'is_paid' => false,
        ]);

        return redirect()->route('payment')->with('success', 'VA Topup berhasil dibuat: ' . $va_code);
    }
}
