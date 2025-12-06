@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container py-4">

    <h2 class="mb-4">Keranjang Belanja</h2>

    @if($cartItems->count() > 0)

    <div class="row">

        <!-- LIST ITEM -->
        <div class="col-md-8">
            @foreach($cartItems as $item)
            <div class="card mb-3">
                <div class="card-body d-flex align-items-center">

                    {{-- Gambar --}}
                    <img 
                        src="{{ asset('storage/' . ($item->product->images->first()->image ?? 'default.png')) }}"
                        width="80" height="80"
                        class="rounded me-3"
                        style="object-fit: cover;"
                    >

                    {{-- Info Produk --}}
                    <div class="flex-grow-1">
                        <h5 class="mb-1">{{ $item->product->name }}</h5>

                        <p class="text-muted mb-2">
                            Rp {{ number_format($item->product->price) }}
                        </p>

                        {{-- Update Jumlah --}}
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex">
                            @csrf
                            <input 
                                type="number" 
                                name="quantity" 
                                min="1" 
                                value="{{ $item->quantity }}" 
                                class="form-control w-25"
                            >
                            <button class="btn btn-outline-primary ms-2">
                                Update
                            </button>
                        </form>
                    </div>

                    {{-- Delete --}}
                    <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger ms-2">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>

                </div>
            </div>
            @endforeach
        </div>

        <!-- SUMMARY -->
        <div class="col-md-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-body">

                    <h5>Ringkasan Belanja</h5>

                    <h3 class="text-primary fw-bold">
                        Rp {{ number_format($subtotal) }}
                    </h3>

                    <a href="{{ route('checkout.index') }}" class="btn btn-success w-100 mt-3">
                        Lanjut Checkout
                    </a>
                </div>
            </div>
        </div>

    </div>

    @else

    <div class="text-center py-5">
        <i class="bi bi-cart-x display-4 text-muted"></i>
        <h4 class="mt-3">Keranjang kosong</h4>
        <p class="text-muted">Tambahkan produk ke keranjang dulu</p>

        <a href="{{ route('home') }}" class="btn btn-primary mt-3">
            Belanja Sekarang
        </a>
    </div>

    @endif

</div>
@endsection
