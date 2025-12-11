<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminTransactionController extends Controller
{
    // List Transaksi
    public function index()
    {
        $transactions = Transaction::latest()->paginate(20);
        return view('admin.transactions.index', compact('transactions'));
    }

    // Detail Transaksi
    public function show($id)
    {
        $transaction = Transaction::with([
            'buyer',
            'store',
            'store.user',
            'transactionDetails',
            'transactionDetails.product',
            'transactionDetails.product.productImages'
        ])->findOrFail($id);
        return view('admin.transactions.show', compact('transaction'));
    }

    // Approve transaksi
    public function approve($id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->payment_status !== 'pending') {
            return back()->with('error', 'Transaksi tidak dalam status pending.');
        }

        $transaction->update([
            'payment_status' => 'paid'
        ]);

        return back()->with('success', 'Transaksi berhasil di-approve.');
    }

    public function reject(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $request->validate([
            'reason' => 'required|string'
        ]);

        $transaction->update([
            'payment_status' => 'failed',
            'reject_reason' => $request->reason
        ]);

        return back()->with('success', 'Transaksi berhasil ditolak.');
    }

    // Update status lain: processing, completed
    public function updateStatus(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $request->validate([
            'status' => 'required|in:processing,completed,cancelled'
        ]);

        $transaction->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status transaksi berhasil diperbarui.');
    }
}
