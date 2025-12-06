<!-- resources/views/pages/customer/order.blade.php -->
@extends('layouts.app')

@section('title', 'Pesanan Saya - Laravel E-Commerce')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-bag-check"></i> Pesanan Saya</h5>
            </div>
            <div class="card-body">
                <!-- Filter Tabs -->
                <ul class="nav nav-tabs mb-4" id="orderTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" 
                                data-bs-target="#all" type="button" role="tab">
                            Semua
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pending-tab" data-bs-toggle="tab" 
                                data-bs-target="#pending" type="button" role="tab">
                            Menunggu Pembayaran
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="process-tab" data-bs-toggle="tab" 
                                data-bs-target="#process" type="button" role="tab">
                            Diproses
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" 
                                data-bs-target="#shipping" type="button" role="tab">
                            Dikirim
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="completed-tab" data-bs-toggle="tab" 
                                data-bs-target="#completed" type="button" role="tab">
                            Selesai
                        </button>
                    </li>
                </ul>
                
                <!-- Tab Content -->
                <div class="tab-content" id="orderTabContent">
                    
                    <!-- Tab: Semua Pesanan -->
                    <div class="tab-pane fade show active" id="all" role="tabpanel">
                        @if($orders->where('user_id', auth()->id())->count() > 0)
                            @include('partials.components.order-list', [
                                'orders' => $orders->where('user_id', auth()->id())
                            ])
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-bag display-4 text-muted"></i>
                                <h4 class="mt-3 text-muted">Belum ada pesanan</h4>
                                <p class="mb-0">Mulai belanja sekarang untuk melihat pesanan Anda</p>
                                <a href="{{ route('home') }}" class="btn btn-primary mt-3">
                                    <i class="bi bi-bag"></i> Mulai Belanja
                                </a>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Tab: Menunggu Pembayaran -->
                    <div class="tab-pane fade" id="pending" role="tabpanel">
                        @php
                            $pendingOrders = $orders->where('user_id', auth()->id())
                                                   ->where('payment_status', 'pending');
                        @endphp
                        
                        @if($pendingOrders->count() > 0)
                            @include('partials.components.order-list', ['orders' => $pendingOrders])
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-credit-card display-4 text-muted"></i>
                                <h4 class="mt-3 text-muted">Tidak ada pesanan menunggu pembayaran</h4>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Tab: Diproses -->
                    <div class="tab-pane fade" id="process" role="tabpanel">
                        @php
                            $processOrders = $orders->where('user_id', auth()->id())
                                                   ->where('status', 'processing')
                                                   ->where('payment_status', 'paid');
                        @endphp
                        
                        @if($processOrders->count() > 0)
                            @include('partials.components.order-list', ['orders' => $processOrders])
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-gear display-4 text-muted"></i>
                                <h4 class="mt-3 text-muted">Tidak ada pesanan yang diproses</h4>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Tab: Dikirim -->
                    <div class="tab-pane fade" id="shipping" role="tabpanel">
                        @php
                            $shippingOrders = $orders->where('user_id', auth()->id())
                                                    ->where('status', 'shipped')
                                                    ->where('payment_status', 'paid');
                        @endphp
                        
                        @if($shippingOrders->count() > 0)
                            @include('partials.components.order-list', ['orders' => $shippingOrders])
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-truck display-4 text-muted"></i>
                                <h4 class="mt-3 text-muted">Tidak ada pesanan dalam pengiriman</h4>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Tab: Selesai -->
                    <div class="tab-pane fade" id="completed" role="tabpanel">
                        @php
                            $completedOrders = $orders->where('user_id', auth()->id())
                                                     ->where('status', 'completed')
                                                     ->where('payment_status', 'paid');
                        @endphp
                        
                        @if($completedOrders->count() > 0)
                            @include('partials.components.order-list', ['orders' => $completedOrders])
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-check-circle display-4 text-muted"></i>
                                <h4 class="mt-3 text-muted">Belum ada pesanan yang selesai</h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection