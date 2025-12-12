<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StoreBalance;

class AdminWithdrawalController extends Controller
{
    // List Withdrawals
    public function index()
    {
        $withdrawals = Withdrawal::latest()->paginate(10);

        return view('admin.withdrawals.index', [
            'withdrawals' => $withdrawals,
            'approvedCount' => Withdrawal::where('status', 'approved')->count(),
            'rejectedCount' => Withdrawal::where('status', 'rejected')->count(),
            'pendingCount'  => Withdrawal::where('status', 'pending')->count(),
        ]);
    }

    // Detail Withdrawal
    public function show($id)
    {
        $withdrawal = Withdrawal::with('store')->findOrFail($id);
        return view('admin.withdrawals.show', compact('withdrawal'));
    }

    // Approve Withdrawal
    public function approve(Withdrawal $withdrawal)
    {
        DB::transaction(function () use ($withdrawal) {

            // Cegah approve ulang
            if ($withdrawal->status !== 'pending') {
                return;
            }

            // Update status withdrawal
            $withdrawal->update([
                'status' => 'approved',
            ]);

            // Kurangi saldo toko
            $storeBalance = StoreBalance::where('store_id', $withdrawal->store_id)->lockForUpdate()->first();

            if ($storeBalance) {
                $storeBalance->decrement('balance', $withdrawal->amount);
            }
        });

        return back()->with('success', 'Withdrawal berhasil di-approve.');
    }

    public function reject(Withdrawal $withdrawal)
    {
        if ($withdrawal->status !== 'pending') {
            return back();
        }

        $withdrawal->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Withdrawal berhasil ditolak.');
    }
}
