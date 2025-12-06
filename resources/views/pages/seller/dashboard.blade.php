<!-- resources/views/pages/seller/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard Penjual - Laravel E-Commerce')

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
            <p class="mb-0">Toko Anda sedang dalam proses verifikasi oleh admin. Anda tidak dapat menjual produk sampai toko diverifikasi.</p>
        </div>
    </div>
</div>
@endif

<div class="row">
    <!-- Stats Cards -->
    <div class="col-md-3 mb-4">
        <div class="card dashboard-card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2">Total Pendapatan</h6>
                        <h3 class="card-title">Rp {{ number_format($totalRevenue) }}</h3>
                    </div>
                    <i class="bi bi-currency-dollar fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card dashboard-card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2">Total Pesanan</h6>
                        <h3 class="card-title">{{ $totalOrders }}</h3>
                    </div>
                    <i class="bi bi-cart-check fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card dashboard-card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2">Total Produk</h6>
                        <h3 class="card-title">{{ $totalProducts }}</h3>
                    </div>
                    <i class="bi bi-box-seam fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card dashboard-card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2">Pesanan Baru</h6>
                        <h3 class="card-title">{{ $newOrders }}</h3>
                    </div>
                    <i class="bi bi-bell fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <!-- Recent Orders -->
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
                                <th>ID Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Produk</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                            <tr>
                                <td>#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>
                                    @foreach($order->details as $detail)
                                    <small>{{ $detail->product->name }} ({{ $detail->quantity }})</small><br>
                                    @endforeach
                                </td>
                                <td>Rp {{ number_format($order->total_amount) }}</td>
                                <td>
                                    @if($order->status === 'pending')
                                        <span class="badge bg-warning">Menunggu</span>
                                    @elseif($order->status === 'processing')
                                        <span class="badge bg-info">Diproses</span>
                                    @elseif($order->status === 'shipped')
                                        <span class="badge bg-primary">Dikirim</span>
                                    @else
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('seller.orders.show', $order->id) }}" 
                                       class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
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
    
    <div class="col-md-4">
        <!-- Store Info -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Informasi Toko</h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    @if($store->logo)
                        <img src="{{ asset('storage/' . $store->logo) }}" 
                             class="rounded-circle mb-3" 
                             alt="{{ $store->name }}" 
                             style="width: 100px; height: 100px; object-fit: cover;">
                    @else
                        <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center mb-3" 
                             style="width: 100px; height: 100px;">
                            <i class="bi bi-shop fs-1 text-white"></i>
                        </div>
                    @endif
                    <h5>{{ $store->name }}</h5>
                    <p class="text-muted">{{ $store->description ? Str::limit($store->description, 100) : 'Tidak ada deskripsi' }}</p>
                </div>
                
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Status Toko</span>
                        <span>
                            @if($store->is_verified)
                                <span class="badge bg-success">Terverifikasi</span>
                            @else
                                <span class="badge bg-warning">Menunggu</span>
                            @endif
                        </span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Total Produk</span>
                        <span>{{ $totalProducts }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>Total Penjualan</span>
                        <span>{{ $totalOrders }}</span>
                    </div>
                </div>
                
                <div class="mt-3">
                    <a href="{{ route('seller.profile') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-pencil"></i> Kelola Toko
                    </a>
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
                    <a href="{{ route('seller.products.index') }}" class="btn btn-outline-primary text-start">
                        <i class="bi bi-box"></i> Manajemen Produk
                    </a>
                    <a href="{{ route('seller.orders.index') }}" class="btn btn-outline-success text-start">
                        <i class="bi bi-cart-check"></i> Manajemen Pesanan
                    </a>
                    <a href="{{ route('seller.balance') }}" class="btn btn-outline-warning text-start">
                        <i class="bi bi-wallet2"></i> Saldo & Keuangan
                    </a>
                    <a href="{{ route('seller.withdrawals.index') }}" class="btn btn-outline-danger text-start">
                        <i class="bi bi-cash-coin"></i> Penarikan Dana
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection