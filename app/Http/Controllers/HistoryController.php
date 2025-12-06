<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    // List transaksi user
    public function index()
    {
        $transactions = Transaction::with('details.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('history.index', compact('transactions'));
    }

    // Detail transaksi (opsional)
    public function show($id)
    {
        $transaction = Transaction::with('details.product')
            ->where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        return view('history.show', compact('transaction'));
    }
}
