@extends('layouts.app')

@section('title', 'Beranda - Laravel E-Commerce')

@section('content')
<div class="row">
    <div class="col-md-3">
        <!-- Sidebar Filter -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Filter Kategori</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('products.index') }}" method="GET" id="filter-form">
                    @foreach($categories as $category)
                    <div class="form-check mb-2">
                        <input class="form-check-input category-filter" 
                            type="checkbox" 
                            name="categories[]" 
                            value="{{ $category->id }}"
                            id="cat-{{ $category->id }}"
                            {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="cat-{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>
                    @endforeach
                    <button type="submit" class="btn btn-sm btn-primary mt-2">Terapkan Filter</button>
                </form>
            </div>
        </div>
        
        <!-- Sidebar Cart -->
        @auth
        @if(auth()->user()->role === 'member')
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Keranjang Belanja</h5>
            </div>
            <div class="card-body">
                <div id="mini-cart">
                    @if(count($cartItems) > 0)
                        @foreach($cartItems as $item)
                        <div class="cart-item mb-2">
                            <div class="d-flex justify-content-between">
                                <small>{{ $item->product->name }}</small>
                                <small>Rp {{ number_format($item->product->price) }}</small>
                            </div>
                        </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong>Total</strong>
                            <strong>Rp {{ number_format($cartTotal) }}</strong>
                        </div>
                    @else
                        <p class="text-muted">Keranjang kosong</p>
                    @endif
                </div>
                <a href="{{ route('checkout') }}" class="btn btn-success w-100 mt-3">Checkout</a>
            </div>
        </div>
        @endif
        @endauth
    </div>
    
    <div class="col-md-9">
        <h2 class="mb-4">Semua Produk</h2>
        
        @if($latestProducts->count() > 0)
        <div class="row">
            @foreach($latestProducts as $latestProducts)
                @include('partials.components.product-card', ['product' => $latestProducts])
            @endforeach
        </div>
        
        <div class="mt-4">
            {{ $latestProducts->links() }}
        </div>
        @else
        <div class="alert alert-info">
            Tidak ada produk yang ditemukan.
        </div>
        @endif
    </div>
</div>
@endsection