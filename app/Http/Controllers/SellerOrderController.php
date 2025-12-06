<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class SellerOrderController extends Controller
{
    /**
     * LIST PESANAN SELLER
     */
    public function index()
    {
        $storeId = auth()->user()->store->id;

        $orders = Transaction::where('store_id', $storeId)
            ->with(['buyer', 'details.product'])
            ->orderBy('id', 'DESC')
            ->paginate(10);

        // Hitung statistik
        $stats = [
            'waiting'   => Transaction::where('store_id', $storeId)->where('order_status', 'pending')->count(),
            'processed' => Transaction::where('store_id', $storeId)->where('order_status', 'processing')->count(),
            'shipped'   => Transaction::where('store_id', $storeId)->where('order_status', 'shipped')->count(),
            'completed' => Transaction::where('store_id', $storeId)->where('order_status', 'completed')->count(),
        ];

        return view('pages.seller.orders', compact('orders', 'stats'));
    }



    /**
     * DETAIL PESANAN
     */
    public function show($id)
    {
        $storeId = auth()->user()->store->id;

        $order = Transaction::where('store_id', $storeId)
            ->with(['buyer', 'details.product'])
            ->findOrFail($id);

        return view('pages.seller.order-detail', compact('order'));
    }



    /**
     * UPDATE STATUS PESANAN (processing / shipped / completed / cancelled)
     */
    public function updateStatus(Request $request, $id)
    {
        $storeId = auth()->user()->store->id;

        $order = Transaction::where('store_id', $storeId)->findOrFail($id);

        // Validasi status
        $request->validate([
            'order_status' => 'required|in:processing,shipped,completed,cancelled',
            'courier' => 'nullable|string',
            'tracking_number' => 'nullable|string',
        ]);

        // LOGIC STATUS
        if ($request->order_status === 'processing') {

            // Dari pending → processing
            if ($order->payment_status !== 'paid') {
                return back()->with('error', 'Tidak bisa memproses pesanan yang belum dibayar.');
            }

            $order->order_status = 'processing';
        }

        if ($request->order_status === 'shipped') {

            // Validasi pengiriman
            if (!$request->courier || !$request->tracking_number) {
                return back()->with('error', 'Kurir dan nomor resi wajib diisi.');
            }

            $order->order_status = 'shipped';
            $order->shipping = $request->courier;
            $order->tracking_number = $request->tracking_number;
        }

        if ($request->order_status === 'completed') {

            // Jangan double payout
            if ($order->payout_status === 'paid') {
                return back()->with('error', 'Saldo pesanan ini sudah pernah dibayarkan.');
            }

            $order->order_status = 'completed';
            $order->payout_status = 'paid';

            // Ambil saldo toko
            $balance = \App\Models\StoreBalance::firstOrCreate(
                ['store_id' => $order->store_id],
                ['balance' => 0]
            );

            // Tambah saldo seller
            $balance->balance += $order->grand_total;
            $balance->save();

            // Catat histori saldo
            \App\Models\StoreBalanceHistory::create([
                'store_balance_id' => $balance->id,
                'type' => 'income',
                'reference_id' => $order->id,
                'reference_type' => 'transaction',
                'amount' => $order->grand_total,
                'remarks' => 'Pendapatan dari pesanan #' . $order->id
            ]);
        }

        if ($request->order_status === 'cancelled') {
            $order->order_status = 'cancelled';
        }

        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
