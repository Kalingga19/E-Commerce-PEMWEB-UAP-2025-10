@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')

<div class="container py-4">

    <h2 class="mb-4">Semua Produk</h2>

    <div class="row mb-4">
        @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark">
                <div class="card product-card h-100">

                    {{-- Gambar --}}
                    <img 
                        src="{{ asset('storage/' . ($product->images->first()->image ?? 'default.png')) }}"
                        class="card-img-top"
                        style="height: 200px; object-fit: cover;"
                    >

                    <div class="card-body">
                        <h6 class="card-title">{{ Str::limit($product->name, 40) }}</h6>

                        <p class="fw-bold text-primary">
                            Rp {{ number_format($product->price) }}
                        </p>

                        <p class="text-muted small mb-1">
                            {{ $product->store->name ?? '-' }}
                        </p>
                    </div>

                </div>
            </a>
        </div>
        @endforeach
    </div>

</div>

@endsection
