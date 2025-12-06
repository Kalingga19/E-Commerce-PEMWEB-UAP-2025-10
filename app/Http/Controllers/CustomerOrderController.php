<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    // ============================================================
    // LIST PESANAN CUSTOMER
    // ============================================================
    public function index()
    {
        $orders = Transaction::where('buyer_id', auth()->id())
            ->with(['transactionDetails.product.images', 'transactionDetails.product.store'])
            ->latest()
            ->get();

        return view('pages.customer.order', compact('orders'));
    }


    // ============================================================
    // DETAIL PESANAN
    // ============================================================
    public function detail($id)
    {
        $order = Transaction::where('buyer_id', auth()->id())
            ->with([
                'transactionDetails.product.images',
                'transactionDetails.product.store'
            ])
            ->findOrFail($id);

        return view('pages.customer.order-detail', compact('order'));
    }


    // ============================================================
    // KONFIRMASI PESANAN SELESAI
    // ============================================================
    public function complete($id)
    {
        $order = Transaction::where('buyer_id', auth()->id())->findOrFail($id);

        if ($order->status !== 'shipped') {
            return back()->with('error', 'Pesanan belum dikirim.');
        }

        $order->status = 'completed';
        $order->completed_at = now();
        $order->save();

        return back()->with('success', 'Pesanan berhasil dikonfirmasi selesai.');
    }


    // ============================================================
    // REVIEW PRODUK
    // ============================================================
    public function review(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:500'
        ]);

        $order = Transaction::where('buyer_id', auth()->id())->findOrFail($id);

        if ($order->status !== 'completed') {
            return back()->with('error', 'Pesanan belum selesai, tidak dapat review.');
        }

        foreach ($order->transactionDetails as $detail) {
            ProductReview::create([
                'product_id' => $detail->product_id,
                'user_id' => auth()->id(),
                'transaction_id' => $order->id,
                'rating' => $request->rating,
                'review' => $request->review
            ]);
        }

        return back()->with('success', 'Terima kasih! Ulasan Anda telah dikirim.');
    }


    // ============================================================
    // PEMBATALAN PESANAN
    // ============================================================
    public function cancel(Request $request, $id)
    {
        $request->validate([
            'cancel_reason' => 'required'
        ]);

        $order = Transaction::where('buyer_id', auth()->id())->findOrFail($id);

        if (!in_array($order->status, ['pending', 'processing'])) {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan.');
        }

        // update status
        $order->status = 'cancelled';
        $order->cancel_reason = $request->cancel_reason;
        $order->cancel_note = $request->cancel_note;
        $order->save();

        return redirect()->route('customer.orders')
            ->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
