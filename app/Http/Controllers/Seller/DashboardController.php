<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $store = Auth::user()->store;

        if (!$store) {
            return redirect()->route('store.register')
                ->with('error', 'Anda belum memiliki toko.');
        }

        // --------- STATISTIK UTAMA ---------
        $products = $store->products()->count();

        $ordersTotal = $store->transactions()->count();

        $revenue = $store->storeBalance->balance ?? 0;

        // --------- STATUS PESANAN ---------
        $waiting = $store->transactions()
            ->where('payment_status', 'pending')
            ->count();

        $shipping = $store->transactions()
            ->where('payment_status', 'paid')
            ->whereNotNull('tracking_number')
            ->count();

        $completed = $store->transactions()
            ->where('payment_status', 'paid')
            ->count();

        $canceled = $store->transactions()
            ->where('payment_status', 'failed')
            ->count();

        // --------- PRODUK TERLARIS ---------
        $topProducts = TransactionDetail::with('product')
            ->whereHas('transaction', function ($q) use ($store) {
                $q->where('store_id', $store->id);
            })
            ->selectRaw('product_id, SUM(qty) as total_sold')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        // --------- PESANAN TERBARU ---------
        $latestOrders = $store->transactions()
            ->with(['buyer'])
            ->latest()
            ->take(5)
            ->get();

        return view('seller.dashboard', compact(
            'store',
            'products',
            'ordersTotal',
            'revenue',
            'waiting',
            'shipping',
            'completed',
            'canceled',
            'topProducts',
            'latestOrders'
        ));
    }
}
