<!-- resources/views/pages/customer/order-detail.blade.php -->
@extends('layouts.app')

@section('title', 'Detail Pesanan #' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . ' - Laravel E-Commerce')

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
        
        <!-- Order Status Card -->
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
                        <div class="d-flex justify-content-end align-items-center">
                            <div class="me-3">
                                @if($order->payment_status === 'paid')
                                    <span class="badge bg-success">Lunas</span>
                                @elseif($order->payment_status === 'pending')
                                    <span class="badge bg-warning">Menunggu Pembayaran</span>
                                @else
                                    <span class="badge bg-danger">Gagal</span>
                                @endif
                            </div>
                            <div>
                                @if($order->status === 'pending')
                                    <span class="badge bg-warning">Menunggu</span>
                                @elseif($order->status === 'processing')
                                    <span class="badge bg-info">Diproses</span>
                                @elseif($order->status === 'shipped')
                                    <span class="badge bg-primary">Dikirim</span>
                                @elseif($order->status === 'completed')
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-danger">Dibatalkan</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- Left Column - Order Details -->
            <div class="col-md-8">
                <!-- Order Items -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Produk yang Dibeli</h6>
                    </div>
                    <div class="card-body">
                        @foreach($order->details as $detail)
                        <div class="row align-items-center mb-3 pb-3 border-bottom">
                            <div class="col-md-2">
                                @if($detail->product->images->count() > 0)
                                <img src="{{ asset('storage/' . $detail->product->images->first()->path) }}" 
                                     alt="{{ $detail->product->name }}" 
                                     class="img-fluid rounded"
                                     style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                     style="width: 80px; height: 80px;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-1">{{ $detail->product->name }}</h6>
                                <p class="text-muted mb-0 small">
                                    {{ $detail->product->store->name }}
                                </p>
                                <p class="mb-0 small">
                                    @if($detail->product->sku)
                                        SKU: {{ $detail->product->sku }}
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-2 text-center">
                                <p class="mb-0">x{{ $detail->quantity }}</p>
                            </div>
                            <div class="col-md-2 text-end">
                                <p class="mb-0 fw-bold">Rp {{ number_format($detail->price) }}</p>
                                <p class="mb-0 small text-muted">
                                    Total: Rp {{ number_format($detail->price * $detail->quantity) }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                        
                        <!-- Order Summary -->
                        <div class="row mt-4">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span>
                                    <span>Rp {{ number_format($order->details->sum(function($detail) { 
                                        return $detail->price * $detail->quantity; 
                                    })) }}</span>
                                </div>
                                
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Ongkos Kirim</span>
                                    <span>Rp {{ number_format($order->shipping_cost) }}</span>
                                </div>
                                
                                @if($order->discount_amount > 0)
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Diskon</span>
                                    <span class="text-success">- Rp {{ number_format($order->discount_amount) }}</span>
                                </div>
                                @endif
                                
                                <hr>
                                
                                <div class="d-flex justify-content-between fw-bold fs-5">
                                    <span>Total</span>
                                    <span class="text-primary">Rp {{ number_format($order->total_amount) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Shipping Information -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Informasi Pengiriman</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Penerima:</strong></p>
                                <p class="mb-3">{{ $order->receiver_name }}</p>
                                
                                <p class="mb-1"><strong>Alamat Pengiriman:</strong></p>
                                <p class="mb-3">{{ $order->shipping_address }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Kota:</strong></p>
                                <p class="mb-3">{{ $order->city }}</p>
                                
                                <p class="mb-1"><strong>Kode Pos:</strong></p>
                                <p class="mb-3">{{ $order->postal_code }}</p>
                                
                                <p class="mb-1"><strong>Nomor Telepon:</strong></p>
                                <p class="mb-3">{{ $order->phone }}</p>
                            </div>
                        </div>
                        
                        @if($order->status === 'shipped' || $order->status === 'completed')
                        <div class="alert alert-info mt-3">
                            <div class="d-flex">
                                <i class="bi bi-truck fs-4 me-3"></i>
                                <div>
                                    <h6 class="mb-1">Informasi Pengiriman</h6>
                                    <p class="mb-1"><strong>Kurir:</strong> {{ strtoupper($order->courier) }}</p>
                                    <p class="mb-1"><strong>Nomor Resi:</strong> {{ $order->tracking_number }}</p>
                                    @if($order->shipped_at)
                                    <p class="mb-0"><strong>Tanggal Dikirim:</strong> 
                                        {{ $order->shipped_at->format('d F Y') }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Payment Information -->
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Informasi Pembayaran</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Metode Pembayaran:</strong></p>
                                <p class="mb-3">
                                    @if($order->payment_method === 'wallet')
                                        Saldo
                                    @else
                                        Virtual Account
                                    @endif
                                </p>
                                
                                <p class="mb-1"><strong>Status Pembayaran:</strong></p>
                                <p class="mb-3">
                                    @if($order->payment_status === 'paid')
                                        <span class="badge bg-success">Lunas</span>
                                    @elseif($order->payment_status === 'pending')
                                        <span class="badge bg-warning">Menunggu Pembayaran</span>
                                    @else
                                        <span class="badge bg-danger">Gagal</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                @if($order->payment_status === 'pending' && $order->payment_method === 'va')
                                <div class="alert alert-warning">
                                    <div class="d-flex">
                                        <i class="bi bi-clock-history fs-4 me-3"></i>
                                        <div>
                                            <h6 class="mb-1">Menunggu Pembayaran</h6>
                                            <p class="mb-0">Silakan lakukan pembayaran untuk melanjutkan proses pesanan</p>
                                            <a href="{{ route('payment.page', $order->id) }}" 
                                               class="btn btn-sm btn-primary mt-2">
                                                <i class="bi bi-credit-card"></i> Bayar Sekarang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                @if($order->payment_status === 'paid')
                                <div class="alert alert-success">
                                    <div class="d-flex">
                                        <i class="bi bi-check-circle fs-4 me-3"></i>
                                        <div>
                                            <h6 class="mb-1">Pembayaran Berhasil</h6>
                                            <p class="mb-0">
                                                <strong>Tanggal Bayar:</strong> 
                                                {{ $order->paid_at ? $order->paid_at->format('d F Y H:i') : '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Actions & Timeline -->
            <div class="col-md-4">
                <!-- Order Actions -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Aksi Pesanan</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            @if($order->payment_status === 'pending' && $order->payment_method === 'va')
                            <a href="{{ route('payment.page', $order->id) }}" 
                               class="btn btn-primary">
                                <i class="bi bi-credit-card"></i> Bayar Pesanan
                            </a>
                            @endif
                            
                            @if($order->status === 'shipped')
                            <form action="{{ route('customer.orders.complete', $order->id) }}" 
                                  method="POST" class="d-grid">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle"></i> Konfirmasi Pesanan Diterima
                                </button>
                            </form>
                            @endif
                            
                            @if($order->status === 'completed')
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" 
                                    data-bs-target="#reviewModal">
                                <i class="bi bi-star"></i> Beri Ulasan
                            </button>
                            @endif
                            
                            @if(in_array($order->status, ['pending', 'processing']) && $order->payment_status === 'pending')
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" 
                                    data-bs-target="#cancelModal">
                                <i class="bi bi-x-circle"></i> Batalkan Pesanan
                            </button>
                            @endif
                            
                            <a href="{{ route('customer.orders') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pesanan
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Order Timeline -->
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Status Pesanan</h6>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            @php
                                $timeline = [
                                    [
                                        'status' => 'order_placed',
                                        'title' => 'Pesanan Dibuat',
                                        'date' => $order->created_at,
                                        'active' => true,
                                        'icon' => 'bi-bag'
                                    ],
                                    [
                                        'status' => 'payment',
                                        'title' => 'Pembayaran',
                                        'date' => $order->payment_status === 'paid' ? $order->paid_at : null,
                                        'active' => $order->payment_status === 'paid',
                                        'icon' => 'bi-credit-card'
                                    ],
                                    [
                                        'status' => 'processing',
                                        'title' => 'Diproses',
                                        'date' => $order->status === 'processing' ? $order->updated_at : null,
                                        'active' => in_array($order->status, ['processing', 'shipped', 'completed']),
                                        'icon' => 'bi-gear'
                                    ],
                                    [
                                        'status' => 'shipping',
                                        'title' => 'Dikirim',
                                        'date' => $order->status === 'shipped' ? $order->shipped_at : null,
                                        'active' => in_array($order->status, ['shipped', 'completed']),
                                        'icon' => 'bi-truck'
                                    ],
                                    [
                                        'status' => 'delivered',
                                        'title' => 'Selesai',
                                        'date' => $order->status === 'completed' ? $order->completed_at : null,
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
                                    <p class="text-muted mb-0 small">
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
                
                <!-- Store Contact -->
                @if($order->details->count() > 0)
                <div class="card mt-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Hubungi Penjual</h6>
                    </div>
                    <div class="card-body">
                        @php
                            $store = $order->details->first()->product->store;
                        @endphp
                        <div class="text-center">
                            @if($store->logo)
                            <img src="{{ asset('storage/' . $store->logo) }}" 
                                 alt="{{ $store->name }}" 
                                 class="rounded-circle mb-3"
                                 style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                            <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center mb-3"
                                 style="width: 60px; height: 60px;">
                                <i class="bi bi-shop text-white"></i>
                            </div>
                            @endif
                            <h6>{{ $store->name }}</h6>
                            <p class="text-muted small mb-2">{{ $store->description }}</p>
                            <p class="mb-2">
                                <i class="bi bi-telephone"></i> {{ $store->phone }}
                            </p>
                            @if($store->email)
                            <p class="mb-0">
                                <i class="bi bi-envelope"></i> {{ $store->email }}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Review Modal -->
@if($order->status === 'completed')
<div class="modal fade" id="reviewModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Beri Ulasan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('customer.orders.review', $order->id) }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Rating Produk</label>
                        <div class="rating-stars text-center">
                            @for($i = 1; $i <= 5; $i++)
                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}">
                            <label for="star{{ $i }}">
                                <i class="bi bi-star"></i>
                            </label>
                            @endfor
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Ulasan Anda</label>
                        <textarea class="form-control" name="review" rows="3" 
                                  placeholder="Bagikan pengalaman Anda dengan produk ini..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-warning w-100">
                        <i class="bi bi-send"></i> Kirim Ulasan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Cancel Modal -->
@if(in_array($order->status, ['pending', 'processing']) && $order->payment_status === 'pending')
<div class="modal fade" id="cancelModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Batalkan Pesanan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('customer.orders.cancel', $order->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    
                    <div class="mb-3">
                        <label class="form-label">Alasan Pembatalan</label>
                        <select class="form-select" name="cancel_reason" required>
                            <option value="" selected disabled>Pilih alasan</option>
                            <option value="change_mind">Saya berubah pikiran</option>
                            <option value="wrong_item">Salah memilih produk</option>
                            <option value="found_cheaper">Menemukan harga yang lebih murah</option>
                            <option value="shipping_too_long">Pengiriman terlalu lama</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Keterangan Tambahan (Opsional)</label>
                        <textarea class="form-control" name="cancel_note" rows="2" 
                                  placeholder="Tambahkan keterangan jika perlu..."></textarea>
                    </div>
                    
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i>
                        <small>Pembatalan pesanan tidak dapat dibatalkan kembali. 
                        Dana akan dikembalikan sesuai dengan kebijakan toko.</small>
                    </div>
                    
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="bi bi-x-circle"></i> Batalkan Pesanan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

<style>
    .timeline {
        position: relative;
        padding-left: 30px;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #e9ecef;
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 20px;
    }
    
    .timeline-item.active .timeline-icon {
        background-color: var(--primary-color);
        color: white;
    }
    
    .timeline-icon {
        position: absolute;
        left: -30px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
    }
    
    .timeline-content {
        padding-left: 10px;
    }
    
    .rating-stars input[type="radio"] {
        display: none;
    }
    
    .rating-stars label {
        font-size: 2rem;
        color: #ddd;
        cursor: pointer;
        transition: color 0.2s;
    }
    
    .rating-stars input[type="radio"]:checked ~ label,
    .rating-stars label:hover,
    .rating-stars label:hover ~ label {
        color: #ffc107;
    }
</style>
@endsection