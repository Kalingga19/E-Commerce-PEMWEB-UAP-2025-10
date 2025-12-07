<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $transactions = Auth::user()
            ->transactions()
            ->with('transactionDetails.product')
            ->latest()
            ->get();

        return view('customer.history.index', compact('transactions'));
    }
}
