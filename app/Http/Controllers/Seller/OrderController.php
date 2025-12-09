<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->store->transactions()
            ->with(['buyer', 'transactionDetails.product.productImages'])
            ->latest()
            ->paginate(10);

        return view('seller.orders.index', compact('orders'));
    }

    public function show(Transaction $order)
    {
        if ($order->store_id !== Auth::user()->store->id) {
            abort(403);
        }

        $order->load([
            'buyer',
            'transactionDetails.product.productImages'
        ]);

        return view('seller.orders.show', compact('order'));
    }

    public function update(Request $request, Transaction $order)
    {
        if ($order->store_id !== Auth::user()->store->id) {
            abort(403);
        }

        $order->update([
            'tracking_number' => $request->tracking_number,
            'payment_status'  => $request->payment_status,
        ]);

        return back()->with('success', 'Order berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Transaction $order)
    {
        $this->authorizeOrder($order);

        $request->validate([
            'status' => 'required|in:paid,processing,shipped,completed,cancelled',
        ]);

        $order->payment_status = $request->status;

        // Jika status shipped dan belum ada resi → set default resi
        if ($request->status === 'shipped' && !$order->tracking_number) {
            $order->tracking_number = 'RESI-' . strtoupper(str()->random(10));
        }

        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    private function authorizeOrder(Transaction $order)
    {
        if ($order->store_id !== Auth::user()->store->id) {
            abort(403, "Unauthorized order access.");
        }
    }


}
