<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StoreBalance;
use App\Models\Transaction;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $store = auth()->user()->store;

        if (!$store) {
            abort(404, 'Store not found');
        }

        // Total produk
        $totalProducts = Product::where('store_id', $store->id)->count();

        // Total pesanan
        $totalOrders = Transaction::where('store_id', $store->id)->count();

        // Pesanan baru (status waiting)
        $newOrders = Transaction::where('store_id', $store->id)
            ->where('status', 'waiting')
            ->count();

        // Pesanan terbaru
        $recentOrders = Transaction::with(['details.product', 'user'])
            ->where('store_id', $store->id)
            ->latest()
            ->take(5)
            ->get();

        // Saldo toko
        $balance = StoreBalance::firstOrCreate(
            ['store_id' => $store->id],
            ['balance' => 0]
        );

        // Statistik status order
        $stats = [
            'waiting'   => Transaction::where('store_id', $store->id)->where('status', 'waiting')->count(),
            'processed' => Transaction::where('store_id', $store->id)->where('status', 'processed')->count(),
            'shipped'   => Transaction::where('store_id', $store->id)->where('status', 'shipped')->count(),
            'completed' => Transaction::where('store_id', $store->id)->where('status', 'completed')->count(),
        ];

        return view('seller.dashboard', compact(
            'store',
            'totalProducts',
            'totalOrders',
            'newOrders',
            'recentOrders',
            'balance',
            'stats'
        ));
    }
}
