<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\Models\Store;
use Illuminate\Http\Request;

class AdminWithdrawalController extends Controller
{
    // List Withdrawals
    public function index()
    {
        $withdrawals = Withdrawal::latest()->paginate(20);
        return view('admin.withdrawals.index', compact('withdrawals'));
    }

    // Detail Withdrawal
    public function show($id)
    {
        $withdrawal = Withdrawal::with('store')->findOrFail($id);
        return view('admin.withdrawals.show', compact('withdrawal'));
    }

    // Approve Withdrawal
    public function approve($id)
    {
        $withdrawal = Withdrawal::with('store')->findOrFail($id);

        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Pengajuan tidak dalam status pending.');
        }

        $store = $withdrawal->store;

        // Cek saldo cukup
        if ($store->balance < $withdrawal->amount) {
            return back()->with('error', 'Saldo toko tidak cukup.');
        }

        // Kurangi saldo
        $store->update([
            'balance' => $store->balance - $withdrawal->amount
        ]);

        // Update withdrawal
        $withdrawal->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'Withdrawal berhasil disetujui.');
    }

    // Reject withdrawal
    public function reject(Request $request, $id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        $request->validate([
            'reason' => 'required|string'
        ]);

        $withdrawal->update([
            'status' => 'rejected',
            'reject_reason' => $request->reason
        ]);

        return back()->with('success', 'Withdrawal berhasil ditolak.');
    }
}
