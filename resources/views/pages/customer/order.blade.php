@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-bag-check"></i> Pesanan Saya</h5>
            </div>

            <div class="card-body">

                {{-- TABS FILTER --}}
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#all">Semua</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#pending">Menunggu Pembayaran</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#processing">Diproses</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#shipping">Dikirim</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#completed">Selesai</button></li>
                </ul>

                <div class="tab-content">

                    {{-- SEMUA PESANAN --}}
                    <div class="tab-pane fade show active" id="all">
                        @if($orders->count() > 0)
                            @include('partials.components.order-list', ['orders' => $orders])
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-bag display-4 text-muted"></i>
                                <h4 class="mt-3">Belum ada pesanan</h4>
                                <a href="{{ route('home') }}" class="btn btn-primary mt-3">Mulai Belanja</a>
                            </div>
                        @endif
                    </div>

                    {{-- MENUNGGU PEMBAYARAN --}}
                    <div class="tab-pane fade" id="pending">
                        @php
                            $pendingOrders = $orders->where('payment_status', 'pending');
                        @endphp

                        @if($pendingOrders->count() > 0)
                            @include('partials.components.order-list', ['orders' => $pendingOrders])
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-credit-card display-4 text-muted"></i>
                                <h4 class="mt-3">Tidak ada pesanan menunggu pembayaran</h4>
                            </div>
                        @endif
                    </div>

                    {{-- DIPROSES --}}
                    <div class="tab-pane fade" id="processing">
                        @php
                            $processingOrders = $orders->where('order_status', 'processing');
                        @endphp

                        @if($processingOrders->count() > 0)
                            @include('partials.components.order-list', ['orders' => $processingOrders])
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-gear display-4 text-muted"></i>
                                <h4 class="mt-3">Tidak ada pesanan yang sedang diproses</h4>
                            </div>
                        @endif
                    </div>

                    {{-- DIKIRIM --}}
                    <div class="tab-pane fade" id="shipping">
                        @php
                            $shippingOrders = $orders->where('order_status', 'shipped');
                        @endphp

                        @if($shippingOrders->count() > 0)
                            @include('partials.components.order-list', ['orders' => $shippingOrders])
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-truck display-4 text-muted"></i>
                                <h4 class="mt-3">Tidak ada pesanan dalam pengiriman</h4>
                            </div>
                        @endif
                    </div>

                    {{-- SELESAI --}}
                    <div class="tab-pane fade" id="completed">
                        @php
                            $completedOrders = $orders->where('order_status', 'completed');
                        @endphp

                        @if($completedOrders->count() > 0)
                            @include('partials.components.order-list', ['orders' => $completedOrders])
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-check-circle display-4 text-muted"></i>
                                <h4 class="mt-3">Belum ada pesanan selesai</h4>
                            </div>
                        @endif
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
@endsection
