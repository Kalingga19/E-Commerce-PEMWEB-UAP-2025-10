<!-- resources/views/pages/product-detail.blade.php -->
@extends('layouts.app')

@section('title', $product->name . ' - Laravel E-Commerce')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div id="productImagesCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($product->images as $index => $image)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $image->path) }}" 
                             class="d-block w-100" 
                             alt="{{ $product->name }}" 
                             style="height: 400px; object-fit: cover;">
                    </div>
                    @endforeach
                </div>
                @if($product->images->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#productImagesCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productImagesCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
                @endif
            </div>
            
            <div class="card-body">
                <h2 class="card-title">{{ $product->name }}</h2>
                <h3 class="text-success">Rp {{ number_format($product->price) }}</h3>
                <p class="text-muted">
                    <i class="bi bi-shop"></i> {{ $product->store->name }} | 
                    <i class="bi bi-grid"></i> {{ $product->category->name }}
                </p>
                <p class="card-text">{{ $product->description }}</p>
                <p><strong>Stok:</strong> {{ $product->stock }} unit</p>
                
                @auth
                    @if(auth()->user()->role === 'member')
                    <form action="{{ route('cart.add') }}" method="POST" class="mb-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="row g-2">
                            <div class="col-md-3">
                                <input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}">
                            </div>
                            <div class="col-md-9">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <form action="{{ route('checkout.direct') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-lightning"></i> Beli Sekarang
                        </button>
                    </form>
                    @endif
                @else
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i>
                        Silakan <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">login</a> untuk membeli produk.
                    </div>
                @endauth
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Detail Produk</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="150">Kondisi</th>
                        <td>{{ $product->condition ?? 'Baru' }}</td>
                    </tr>
                    <tr>
                        <th>Berat</th>
                        <td>{{ $product->weight ?? '500' }} gram</td>
                    </tr>
                    <tr>
                        <th>Garansi</th>
                        <td>{{ $product->warranty ?? '1 Tahun' }}</td>
                    </tr>
                    <tr>
                        <th>Pengiriman</th>
                        <td>1-3 hari kerja</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Ulasan ({{ $product->reviews->count() }})</h5>
            </div>
            <div class="card-body">
                @if($product->reviews->count() > 0)
                    @foreach($product->reviews->take(3) as $review)
                    <div class="border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>{{ $review->user->name }}</strong>
                            <div class="text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <i class="bi bi-star-fill"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <p class="mb-0 mt-2">{{ $review->comment }}</p>
                        <small class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                    </div>
                    @endforeach
                    
                    @if($product->reviews->count() > 3)
                    <div class="text-center">
                        <a href="#" class="btn btn-sm btn-outline-primary">Lihat semua ulasan</a>
                    </div>
                    @endif
                @else
                    <p class="text-muted text-center py-3">
                        <i class="bi bi-chat-dots display-6"></i><br>
                        Belum ada ulasan untuk produk ini.
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('home') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Beranda
    </a>
</div>
@endsection