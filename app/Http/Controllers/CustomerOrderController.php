<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $orders = Transaction::where('buyer_id', auth()->id())
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('pages.customer.orders', compact('orders'));
    }

    public function show($id)
    {
        $order = Transaction::where('buyer_id', auth()->id())
            ->with(['details.product', 'store'])
            ->findOrFail($id);

        return view('pages.customer.order-detail', compact('order'));
    }
}
