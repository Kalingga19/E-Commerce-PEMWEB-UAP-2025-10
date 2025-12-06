<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\StoreBalance;
use App\Models\StoreBalanceHistory;
use Illuminate\Http\Request;

class SellerOrderController extends Controller
{
    public function index(Request $request)
    {
        $storeId = auth()->user()->store->id;

        // --- FILTERING ---
        $query = Transaction::where('store_id', $storeId)
            ->with(['details.product', 'user']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->payment_status) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // PAGINATE
        $orders = $query->latest()->paginate(10);

        // --- STATS ---
        $stats = [
            'waiting'   => Transaction::where('store_id', $storeId)->where('status', 'waiting')->count(),
            'processed' => Transaction::where('store_id', $storeId)->where('status', 'processed')->count(),
            'shipped'   => Transaction::where('store_id', $storeId)->where('status', 'shipped')->count(),
            'completed' => Transaction::where('store_id', $storeId)->where('status', 'completed')->count(),
        ];

        return view('seller.orders', compact('orders', 'stats'));
    }


    public function show($id)
    {
        $storeId = auth()->user()->store->id;

        $order = Transaction::where('store_id', $storeId)
            ->with(['details.product', 'user'])
            ->findOrFail($id);

        return view('seller.order-detail', compact('order'));
    }


    public function updateStatus(Request $request, $id)
    {
        $store = auth()->user()->store;
        $order = Transaction::where('store_id', $store->id)->findOrFail($id);

        $request->validate([
            'status' => 'required|in:waiting,processed,shipped,completed'
        ]);

        $oldStatus = $order->status;
        $order->status = $request->status;
        $order->save();

        // --- IF ORDER COMPLETED → ADD BALANCE ---
        if ($oldStatus !== 'completed' && $request->status === 'completed') {

            $balance = StoreBalance::firstOrCreate(
                ['store_id' => $store->id],
                ['balance' => 0]
            );

            // Tambahkan saldo toko
            $balance->balance += $order->total_price;
            $balance->save();

            // Tambahkan history
            StoreBalanceHistory::create([
                'store_balance_id' => $balance->id,
                'type' => 'income',
                'reference_id' => $order->id,
                'reference_type' => 'transaction',
                'amount' => $order->total_price,
                'remarks' => 'Pendapatan dari pesanan #' . $order->id,
            ]);
        }

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
