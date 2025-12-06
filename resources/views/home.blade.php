@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="container py-4">

    {{-- Hero Section --}}
    <div class="bg-primary text-white p-4 rounded mb-4">
        <h2 class="fw-bold">Selamat Datang di E-Commerce</h2>
        <p>Temukan produk terbaik dari para seller terpercaya!</p>
    </div>

    {{-- Categories --}}
    <h4 class="mb-3">Kategori</h4>
    <div class="row mb-5">
        @foreach($categories as $cat)
        <div class="col-6 col-md-3 mb-3">
            <a href="{{ route('category.show', $cat->slug) }}" 
               class="text-decoration-none">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="bi bi-box fs-1 text-primary"></i>
                        <p class="mt-2 fw-bold">{{ $cat->name }}</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    <hr>

    {{-- Latest Products --}}
    <h4 class="mb-3">Produk Terbaru</h4>

    <div class="row">
        @foreach($latestProducts as $product)
        <div class="col-6 col-md-3 mb-4">
            <a href="{{ route('products.show', $product->slug) }}" 
               class="text-decoration-none">
                <div class="card h-100">
                    @if($product->images->count() > 0)
                        <img src="{{ asset('storage/' . $product->images->first()->path) }}"
                             class="card-img-top"
                             style="height: 180px; object-fit: cover;">
                    @else
                        <img src="/default.png" class="card-img-top">
                    @endif

                    <div class="card-body">
                        <h6 class="fw-bold">{{ Str::limit($product->name, 25) }}</h6>
                        <p class="text-danger mb-0">
                            Rp {{ number_format($product->price) }}
                        </p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

</div>
@endsection
