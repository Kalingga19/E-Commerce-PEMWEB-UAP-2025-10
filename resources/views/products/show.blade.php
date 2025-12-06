@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="row">

        <!-- LEFT IMAGE SECTION -->
        <div class="col-md-6 text-center">
            @if($product->images->count() > 0)
                <img 
                    src="{{ asset('storage/' . $product->images->first()->path) }}" 
                    class="img-fluid rounded mb-3"
                    style="max-height: 400px; object-fit: cover;"
                >
            @else
                <img src="/default.png" class="img-fluid rounded mb-3">
            @endif

            <!-- Thumbnail list -->
            <div class="d-flex flex-wrap justify-content-center gap-2">
                @foreach($product->images as $img)
                    <img 
                        src="{{ asset('storage/' . $img->path) }}" 
                        class="rounded"
                        style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                        onclick="document.getElementById('main-img').src=this.src;"
                    >
                @endforeach
            </div>
        </div>

        <!-- RIGHT INFO SECTION -->
        <div class="col-md-6">

            <h2>{{ $product->name }}</h2>

            <h3 class="text-danger">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </h3>

            <p class="text-muted">
                Kondisi: <strong>{{ $product->condition == 'new' ? 'Baru' : 'Bekas' }}</strong>
            </p>

            <p class="text-muted">
                Stok: <strong>{{ $product->stock }}</strong>
            </p>

            <hr>

            <p>{{ $product->description }}</p>

            <hr>

            <!-- Toko -->
            <h5>Informasi Toko</h5>
            <p>
                <strong>{{ $product->store->name }}</strong><br>
                {{ $product->store->city }}<br>
                <small class="text-muted">{{ $product->store->address }}</small>
            </p>

            <hr>

            <!-- Button Add to Cart (kalau belum ada cart, nanti kita buatkan) -->
            <form action="#" method="POST">
                @csrf
                <button class="btn btn-primary btn-lg w-100">
                    Tambah ke Keranjang
                </button>
            </form>

        </div>

    </div> <!-- row -->

</div>
@endsection
