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
            ->with('transactionDetails.product')
            ->latest()
            ->get();

        return view('seller.orders.index', compact('orders'));
    }

    public function show(Transaction $order)
    {
        $this->authorizeOrder($order);
        return view('seller.orders.show', compact('order'));
    }

    public function update(Request $request, Transaction $order)
    {
        $this->authorizeOrder($order);

        $order->update([
            'tracking_number' => $request->tracking_number,
            'payment_status' => $request->payment_status ?? $order->payment_status
        ]);

        return back()->with('success', 'Order berhasil diperbarui.');
    }

    private function authorizeOrder(Transaction $order)
    {
        if ($order->store_id !== Auth::user()->store->id) {
            abort(403, "Unauthorized order access.");
        }
    }
}
