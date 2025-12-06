<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\StoreBalance;
use App\Models\StoreBalanceHistory;
use Illuminate\Http\Request;

class SellerOrderController extends Controller
{
    // ============================================================== 
    // LIST PESANAN TOKO
    // ==============================================================
    public function index()
    {
        $store = auth()->user()->store;

        $orders = Transaction::with(['transactionDetails.product'])
            ->where('store_id', $store->id)
            ->latest()
            ->paginate(10);

        // Statistik
        $stats = [
            'waiting'   => Transaction::where('store_id', $store->id)->where('status', 'pending')->count(),
            'processed' => Transaction::where('store_id', $store->id)->where('status', 'processing')->count(),
            'shipped'   => Transaction::where('store_id', $store->id)->where('status', 'shipped')->count(),
            'completed' => Transaction::where('store_id', $store->id)->where('status', 'completed')->count(),
        ];

        return view('seller.orders', compact('orders', 'stats'));
    }


    // ============================================================== 
    // DETAIL PESANAN
    // ==============================================================
    public function show($id)
    {
        $store = auth()->user()->store;

        $order = Transaction::with(['transactionDetails.product.images'])
            ->where('store_id', $store->id)
            ->findOrFail($id);

        return view('seller.order-detail', compact('order'));
    }


    // ============================================================== 
    // UPDATE STATUS PESANAN (processing → shipped → completed)
    // ==============================================================
    public function updateStatus(Request $request, $id)
    {
        $store = auth()->user()->store;

        $order = Transaction::where('store_id', $store->id)->findOrFail($id);

        $request->validate([
            'order_status' => 'required',
            'courier'      => 'nullable|string',
            'tracking_number' => 'nullable|string',
        ]);

        // ==== IF SELLER PROCESSES THE ORDER =====
        if ($request->order_status === 'processing') {
            if ($order->payment_status !== 'paid') {
                return back()->with('error', 'Pesanan belum dibayar.');
            }

            $order->status = 'processing';
            $order->save();

            return back()->with('success', 'Pesanan berhasil diproses.');
        }

        // ==== IF SELLER SHIPS THE ORDER ====
        if ($request->order_status === 'shipped') {

            if (!$request->courier || !$request->tracking_number) {
                return back()->with('error', 'Kurir & Nomor resi harus diisi.');
            }

            $order->status = 'shipped';
            $order->courier = $request->courier;
            $order->tracking_number = $request->tracking_number;
            $order->shipped_at = now();
            $order->save();

            return back()->with('success', 'Pesanan berhasil dikirim.');
        }

        // ==== COMPLETE ORDER (optional if seller) ====
        if ($request->order_status === 'completed') {

            $order->status = 'completed';
            $order->completed_at = now();
            $order->save();

            // Tambahkan pendapatan ke saldo toko
            $balance = StoreBalance::firstOrCreate(
                ['store_id' => $store->id],
                ['balance' => 0]
            );

            $balance->balance += $order->grand_total;
            $balance->save();

            StoreBalanceHistory::create([
                'store_balance_id' => $balance->id,
                'type' => 'income',
                'reference_id' => $order->id,
                'reference_type' => 'transaction',
                'amount' => $order->grand_total,
                'remarks' => 'Pendapatan transaksi #' . $order->id
            ]);

            return back()->with('success', 'Pesanan selesai & saldo toko bertambah.');
        }

        return back()->with('error', 'Status tidak valid.');
    }
}
