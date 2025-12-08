<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('buyer_id', auth()->id())
                        ->with('details.product')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('customer.history.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transaction::with('details.product')->findOrFail($id);

        return view('customer.history.show', compact('transaction'));
    }

}
