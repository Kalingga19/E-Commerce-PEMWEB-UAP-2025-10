@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="row">

        <!-- LEFT IMAGE SECTION -->
        <div class="col-md-6 text-center">

            {{-- Main Image --}}
            @if($product->images->count() > 0)
                <img 
                    id="main-img"
                    src="{{ asset('storage/' . ($product->images->first()->image)) }}" 
                    class="img-fluid rounded mb-3"
                    style="max-height: 400px; object-fit: cover;"
                >
            @else
                <img id="main-img" src="/default.png" class="img-fluid rounded mb-3">
            @endif

            <!-- Thumbnail list -->
            <div class="d-flex flex-wrap justify-content-center gap-2">
                @foreach($product->images as $img)
                    <img 
                        src="{{ asset('storage/' . $img->image) }}" 
                        class="rounded border"
                        style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                        onclick="document.getElementById('main-img').src=this.src;"
                    >
                @endforeach
            </div>
        </div>

        <!-- RIGHT INFO SECTION -->
        <div class="col-md-6">

            <h2 class="fw-bold">{{ $product->name }}</h2>

            <h3 class="text-danger fw-bold">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </h3>

            <p class="text-muted">
                Kondisi: 
                <strong>
                    {{ $product->condition == 'new' ? 'Baru' : 'Bekas' }}
                </strong>
            </p>

            <p class="text-muted">
                Stok: <strong>{{ $product->stock }}</strong>
            </p>

            <hr>

            <p>{{ $product->description }}</p>

            <hr>

            <!-- Toko -->
            <h5 class="fw-bold">Informasi Toko</h5>

            <div class="d-flex align-items-center mb-2">
                @if($product->store->logo)
                    <img src="{{ asset('storage/' . $product->store->logo) }}"
                        class="rounded-circle me-3"
                        style="width:60px; height:60px; object-fit:cover;">
                @else
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-3"
                        style="width:60px; height:60px;">
                        <i class="bi bi-shop text-white fs-4"></i>
                    </div>
                @endif

                <div>
                    <strong>{{ $product->store->name }}</strong> <br>
                    <small class="text-muted">{{ $product->store->city }}</small> <br>
                    <small>{{ $product->store->address }}</small>
                </div>
            </div>

            <hr>

            <!-- ADD TO CART -->
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button class="btn btn-primary btn-lg w-100">
                    Tambah ke Keranjang
                </button>
            </form>
        </div>

    </div> <!-- row -->

</div>
@endsection
