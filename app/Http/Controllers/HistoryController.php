<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('details.product')
            ->where('buyer_id', auth()->id())
            ->latest()
            ->get();

        return view('history.index', compact('transactions'));
    }
}
