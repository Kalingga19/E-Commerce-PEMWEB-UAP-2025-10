<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    // ==========================================================
    // LIST ORDER
    // ==========================================================
    public function index()
    {
        $orders = Transaction::with(['transactionDetails.product.images'])
            ->where('buyer_id', auth()->id())
            ->latest()
            ->get();

        return view('pages.customer.order', compact('orders'));
    }


    // ==========================================================
    // DETAIL ORDER
    // ==========================================================
    public function detail($id)
    {
        $order = Transaction::with([
            'transactionDetails.product.images',
            'transactionDetails.product.store'
        ])
        ->where('buyer_id', auth()->id())
        ->findOrFail($id);

        return view('pages.customer.order-detail', compact('order'));
    }


    // ==========================================================
    // KONFIRMASI PESANAN SELESAI
    // ==========================================================
    public function complete($id)
    {
        $order = Transaction::where('buyer_id', auth()->id())->findOrFail($id);

        if ($order->status !== 'shipped') {
            return back()->with('error', 'Pesanan belum dapat dikonfirmasi.');
        }

        $order->status = 'completed';
        $order->completed_at = now();
        $order->save();

        return back()->with('success', 'Pesanan berhasil dikonfirmasi!');
    }


    // ==========================================================
    // REVIEW PRODUK
    // ==========================================================
    public function review(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string'
        ]);

        $order = Transaction::where('buyer_id', auth()->id())->findOrFail($id);

        if ($order->status !== 'completed') {
            return back()->with('error', 'Pesanan belum selesai, tidak bisa review.');
        }

        foreach ($order->transactionDetails as $detail) {
            ProductReview::create([
                'product_id' => $detail->product_id,
                'user_id'    => auth()->id(),
                'rating'     => $request->rating,
                'review'     => $request->review,
            ]);
        }

        return back()->with('success', 'Ulasan berhasil dikirim!');
    }


    // ==========================================================
    // CANCEL ORDER
    // ==========================================================
    public function cancel(Request $request, $id)
    {
        $order = Transaction::where('buyer_id', auth()->id())->findOrFail($id);

        if (!in_array($order->status, ['pending', 'processing']) || $order->payment_status === 'paid') {
            return back()->with('error', 'Pesanan tidak bisa dibatalkan.');
        }

        $request->validate([
            'cancel_reason' => 'required|string',
            'cancel_note'   => 'nullable|string'
        ]);

        $order->status = 'cancelled';
        $order->cancel_reason = $request->cancel_reason;
        $order->cancel_note = $request->cancel_note;
        $order->save();

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
