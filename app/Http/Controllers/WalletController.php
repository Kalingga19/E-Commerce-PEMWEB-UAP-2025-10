<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function topup()
    {
        return view('components.topup');
    }

    public function processTopup(Request $request)
    {
        // validasi jumlah
        $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        // logic topup di sini...
        // misal update user_balance table

        return redirect()->back()->with('success', 'Top up berhasil!');
    }
}
