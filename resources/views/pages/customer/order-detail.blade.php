@extends('layouts.app')

@section('title', 'Detail Pesanan #' . str_pad($order->id, 6, '0', STR_PAD_LEFT))

@section('content')
<div class="row">
    <div class="col-md-12">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('customer.orders') }}">Pesanan Saya</a>
                </li>
                <li class="breadcrumb-item active">
                    Pesanan #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                </li>
            </ol>
        </nav>

        <!-- STATUS PESANAN -->
        <div class="card mb-4">
            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-md-8">
                        <h5 class="mb-1">Pesanan #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h5>

                        <p class="text-muted mb-0">
                            Tanggal: {{ $order->created_at->format('d F Y H:i') }}
                        </p>
                    </div>

                    <div class="col-md-4 text-end">

                        {{-- Payment Status --}}
                        @if($order->payment_status === 'paid')
                            <span class="badge bg-success">Lunas</span>
                        @elseif($order->payment_status === 'pending')
                            <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
                        @else
                            <span class="badge bg-danger">Gagal</span>
                        @endif

                        {{-- Order Status --}}
                        @php
                            $statusMap = [
                                'pending' => ['Menunggu', 'warning'],
                                'processing' => ['Diproses', 'info'],
                                'shipped' => ['Dikirim', 'primary'],
                                'completed' => ['Selesai', 'success'],
                                'cancelled' => ['Dibatalkan', 'danger'],
                            ];
                        @endphp

                        <span class="badge bg-{{ $statusMap[$order->order_status][1] }} ms-1">
                            {{ $statusMap[$order->order_status][0] }}
                        </span>
                    </div>

                </div>

            </div>
        </div>

        <div class="row">

            <!-- LEFT COLUMN: DETAIL PESANAN -->
            <div class="col-md-8">

                <!-- PRODUK -->
                <div class="card mb-4">

                    <div class="card-header bg-light">
                        <h6 class="mb-0">Produk yang Dibeli</h6>
                    </div>

                    <div class="card-body">

                        @foreach($order->details as $detail)
                        <div class="row align-items-center mb-3 pb-3 border-bottom">

                            <div class="col-md-2">

                                {{-- Thumbnail Product --}}
                                @if($detail->product->images->count() > 0)
                                    <img src="{{ asset('storage/' . $detail->product->images->first()->image) }}"
                                        alt="{{ $detail->product->name }}"
                                        class="img-fluid rounded"
                                        style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                        style="width: 80px; height: 80px;">
                                        <i class="bi bi-image text-muted fs-3"></i>
                                    </div>
                                @endif

                            </div>

                            <div class="col-md-6">
                                <h6 class="mb-1">{{ $detail->product->name }}</h6>
                                <p class="text-muted mb-0 small">{{ $detail->product->store->name }}</p>
                            </div>

                            <div class="col-md-2 text-center">
                                <p class="mb-0">x{{ $detail->qty }}</p>
                            </div>

                            <div class="col-md-2 text-end">
                                <p class="mb-0 fw-bold">
                                    Rp {{ number_format($detail->subtotal / $detail->qty) }}
                                </p>
                                <p class="mb-0 small text-muted">
                                    Total: Rp {{ number_format($detail->subtotal) }}
                                </p>
                            </div>

                        </div>
                        @endforeach

                                            <!-- ORDER SUMMARY -->
                        <div class="row mt-4">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">

                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span>
                                    <span>
                                        Rp {{ number_format($order->details->sum('subtotal')) }}
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>Ongkos Kirim</span>
                                    <span>Rp {{ number_format($order->shipping_cost) }}</span>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between fw-bold fs-5">
                                    <span>Total</span>
                                    <span class="text-primary">
                                        Rp {{ number_format($order->grand_total) }}
                                    </span>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>


                <!-- INFORMASI PENGIRIMAN -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Informasi Pengiriman</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <p class="mb-1"><strong>Alamat Pengiriman:</strong></p>
                                <p class="mb-3">{{ $order->address }}</p>

                                <p class="mb-1"><strong>Kota:</strong></p>
                                <p class="mb-3">{{ $order->city }}</p>

                                <p class="mb-1"><strong>Kode Pos:</strong></p>
                                <p class="mb-3">{{ $order->postal_code }}</p>
                            </div>

                            <div class="col-md-6">
                                <p class="mb-1"><strong>Metode Pengiriman:</strong></p>
                                <p class="mb-3">{{ strtoupper($order->shipping) }} ({{ $order->shipping_type }})</p>

                                @if($order->tracking_number)
                                    <p class="mb-1"><strong>No. Resi:</strong></p>
                                    <p class="mb-3">{{ $order->tracking_number }}</p>
                                @endif

                                @if($order->shipped_at)
                                    <p class="mb-1"><strong>Tanggal Dikirim:</strong></p>
                                    <p class="mb-0">{{ $order->shipped_at->format('d F Y H:i') }}</p>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>


                <!-- INFORMASI PEMBAYARAN -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Informasi Pembayaran</h6>
                    </div>

                    <div class="card-body">

                        <p class="mb-1"><strong>Metode Pembayaran:</strong></p>
                        <p class="mb-3">
                            @if($order->payment_method === 'wallet')
                                Saldo Dompet
                            @else
                                Virtual Account
                            @endif
                        </p>

                        <p class="mb-1"><strong>Status Pembayaran:</strong></p>
                        <p>
                            @if($order->payment_status === 'paid')
                                <span class="badge bg-success">Lunas</span>
                            @elseif($order->payment_status === 'pending')
                                <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
                            @else
                                <span class="badge bg-danger">Gagal</span>
                            @endif
                        </p>

                        @if($order->payment_status === 'pending' && $order->payment_method === 'va')
                            <div class="alert alert-warning">
                                <i class="bi bi-clock-history"></i> Pembayaran belum dilakukan.
                                <br>
                                <a href="{{ route('payment.page', $order->id) }}" class="btn btn-sm btn-primary mt-2">
                                    Bayar Sekarang
                                </a>
                            </div>
                        @endif

                        @if($order->payment_status === 'paid')
                            <div class="alert alert-success d-flex">
                                <i class="bi bi-check-circle fs-4 me-3"></i>
                                <div>
                                    Pembayaran berhasil.
                                    <br>
                                    <strong>Tanggal Bayar:</strong>
                                    {{ $order->paid_at ? $order->paid_at->format('d F Y H:i') : '-' }}
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div> <!-- END LEFT COLUMN -->

            <!-- RIGHT COLUMN -->
            <div class="col-md-4">

                <!-- ORDER ACTIONS -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Aksi Pesanan</h6>
                    </div>

                    <div class="card-body d-grid gap-2">

                        {{-- PEMBAYARAN VA --}}
                        @if($order->payment_status === 'pending' && $order->payment_method === 'va')
                            <a href="{{ route('payment.page', $order->id) }}" 
                                class="btn btn-primary">
                                <i class="bi bi-credit-card"></i> Bayar Pesanan
                            </a>
                        @endif

                        {{-- KONFIRMASI BARANG DITERIMA --}}
                        @if($order->status === 'shipped')
                            <form action="{{ route('customer.orders.complete', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle"></i> Konfirmasi Barang Diterima
                                </button>
                            </form>
                        @endif

                        {{-- REVIEW PRODUK --}}
                        @if($order->status === 'completed')
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#reviewModal">
                                <i class="bi bi-star"></i> Beri Ulasan
                            </button>
                        @endif

                        {{-- CANCEL ORDER --}}
                        @if(in_array($order->status, ['pending', 'processing']) && $order->payment_status === 'pending')
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal">
                                <i class="bi bi-x-circle"></i> Batalkan Pesanan
                            </button>
                        @endif

                        <a href="{{ route('customer.orders') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pesanan
                        </a>

                    </div>
                </div>
                <!-- ORDER TIMELINE -->
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Status Pesanan</h6>
                    </div>

                    <div class="card-body">
                        <div class="timeline">

                            @php
                                $timeline = [
                                    [
                                        'title' => 'Pesanan Dibuat',
                                        'date' => $order->created_at,
                                        'active' => true,
                                        'icon' => 'bi-bag'
                                    ],
                                    [
                                        'title' => 'Pembayaran',
                                        'date' => $order->payment_status === 'paid' ? $order->paid_at : null,
                                        'active' => $order->payment_status === 'paid',
                                        'icon' => 'bi-credit-card'
                                    ],
                                    [
                                        'title' => 'Diproses Penjual',
                                        'date' => $order->status === 'processing' ? $order->updated_at : null,
                                        'active' => in_array($order->status, ['processing', 'shipped', 'completed']),
                                        'icon' => 'bi-gear'
                                    ],
                                    [
                                        'title' => 'Dikirim',
                                        'date' => $order->shipped_at,
                                        'active' => in_array($order->status, ['shipped', 'completed']),
                                        'icon' => 'bi-truck'
                                    ],
                                    [
                                        'title' => 'Pesanan Selesai',
                                        'date' => $order->completed_at,
                                        'active' => $order->status === 'completed',
                                        'icon' => 'bi-check-circle'
                                    ]
                                ];
                            @endphp

                            @foreach($timeline as $item)
                            <div class="timeline-item {{ $item['active'] ? 'active' : '' }}">
                                <div class="timeline-icon">
                                    <i class="bi {{ $item['icon'] }}"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">{{ $item['title'] }}</h6>
                                    <p class="text-muted small mb-0">
                                        @if($item['date'])
                                            {{ $item['date']->format('d M Y H:i') }}
                                        @else
                                            Menunggu...
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <!-- STORE CONTACT -->
                @php
                    $store = $order->details->first()->product->store ?? null;
                @endphp

                @if($store)
                <div class="card mt-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Hubungi Penjual</h6>
                    </div>

                    <div class="card-body text-center">

                        @if($store->logo)
                            <img src="{{ asset('storage/' . $store->logo) }}"
                                class="rounded-circle mb-3"
                                style="width: 60px; height: 60px; object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center mb-3"
                                 style="width: 60px; height: 60px;">
                                <i class="bi bi-shop text-white fs-4"></i>
                            </div>
                        @endif

                        <h6>{{ $store->name }}</h6>
                        <p class="text-muted small">{{ $store->about }}</p>

                        @if($store->phone)
                        <p><i class="bi bi-telephone"></i> {{ $store->phone }}</p>
                        @endif

                        <p><i class="bi bi-geo-alt"></i> {{ $store->address }}</p>

                    </div>
                </div>
                @endif
