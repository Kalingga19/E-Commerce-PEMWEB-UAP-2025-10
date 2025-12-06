@extends('layouts.app')

@section('title', 'Dashboard Penjual')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-speedometer2"></i> Dashboard Penjual</h2>
    <div class="btn-group">
        <a href="{{ route('seller.products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Produk
        </a>
        <a href="{{ route('seller.orders.index') }}" class="btn btn-success">
            <i class="bi bi-cart-check"></i> Lihat Pesanan
        </a>
    </div>
</div>

@if(!$store->is_verified)
<div class="alert alert-warning">
    <div class="d-flex align-items-center">
        <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
        <div>
            <h5 class="mb-1">Toko Belum Terverifikasi</h5>
            <p class="mb-0">Toko Anda sedang dalam proses verifikasi oleh admin.</p>
        </div>
    </div>
</div>
@endif

<div class="row">
    <!-- Total Pendapatan -->
    <div class="col-md-3 mb-4">
        <div class="card dashboard-card bg-primary text-white">
            <div class="card-body">
                <h6>Total Pendapatan</h6>
                <h3>Rp {{ number_format($balance->balance) }}</h3>
            </div>
        </div>
    </div>

    <!-- Total Pesanan -->
    <div class="col-md-3 mb-4">
        <div class="card dashboard-card bg-success text-white">
            <div class="card-body">
                <h6>Total Pesanan</h6>
                <h3>{{ $totalOrders }}</h3>
            </div>
        </div>
    </div>

    <!-- Total Produk -->
    <div class="col-md-3 mb-4">
        <div class="card dashboard-card bg-info text-white">
            <div class="card-body">
                <h6>Total Produk</h6>
                <h3>{{ $totalProducts }}</h3>
            </div>
        </div>
    </div>

    <!-- Pesanan Baru -->
    <div class="col-md-3 mb-4">
        <div class="card dashboard-card bg-warning text-white">
            <div class="card-body">
                <h6>Pesanan Baru</h6>
                <h3>{{ $newOrders }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <!-- Recent Orders -->
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Pesanan Terbaru</h5>
            </div>
            <div class="card-body">

                @if($recentOrders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pelanggan</th>
                                    <th>Produk</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>
                                        @foreach($order->details as $detail)
                                            <small>{{ $detail->product->name }} ({{ $detail->qty }})</small><br>
                                        @endforeach
                                    </td>
                                    <td>Rp {{ number_format($order->total_price) }}</td>
                                    <td>{{ ucfirst($order->status) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-cart-x display-4 text-muted"></i>
                        <p class="mt-3 text-muted">Belum ada pesanan.</p>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <!-- Store Info -->
    <div class="col-md-4">

        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Informasi Toko</h5>
            </div>

            <div class="card-body text-center">

                @if($store->logo)
                    <img src="{{ asset('storage/' . $store->logo) }}"
                         class="rounded-circle mb-3"
                         style="width:100px;height:100px;object-fit:cover;">
                @else
                    <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center mb-3"
                         style="width:100px;height:100px;">
                        <i class="bi bi-shop fs-1 text-white"></i>
                    </div>
                @endif

                <h5>{{ $store->name }}</h5>
                <p class="text-muted">{{ Str::limit($store->about, 100) }}</p>

                <div class="list-group list-group-flush text-start">
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Status Toko</span>
                        <span class="badge bg-{{ $store->is_verified ? 'success':'warning' }}">
                            {{ $store->is_verified ? 'Terverifikasi':'Menunggu' }}
                        </span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Total Produk</span>
                        <span>{{ $totalProducts }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Total Pesanan</span>
                        <span>{{ $totalOrders }}</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- Quick Links -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Menu Cepat</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('seller.products.index') }}" class="btn btn-outline-primary">
                        Manajemen Produk
                    </a>
                    <a href="{{ route('seller.orders.index') }}" class="btn btn-outline-success">
                        Manajemen Pesanan
                    </a>
                    <a href="{{ route('seller.balance.index') }}" class="btn btn-outline-warning">
                        Saldo & Keuangan
                    </a>
                    <a href="{{ route('seller.withdraw.index') }}" class="btn btn-outline-danger">
                        Penarikan Dana
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
