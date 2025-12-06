@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container py-4">

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<h2 class="mb-4">Keranjang Belanja</h2>

@if($cartItems->count() == 0)

    <div class="text-center py-5">
        <i class="bi bi-cart-x display-3 text-muted"></i>
        <h4 class="mt-3 text-muted">Keranjang masih kosong</h4>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Belanja Sekarang</a>
    </div>

@else

<table class="table table-hover">
    <thead>
        <tr>
            <th>Produk</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

        @foreach($cartItems as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>Rp {{ number_format($item->product->price) }}</td>

            <td>
                <form action="{{ route('cart.update') }}" method="POST" class="d-flex">
                    @csrf
                    <input type="hidden" name="cart_id" value="{{ $item->id }}">
                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control w-50">
                    <button class="btn btn-sm btn-warning ms-2">Update</button>
                </form>
            </td>

            <td>Rp {{ number_format($item->quantity * $item->product->price) }}</td>

            <td>
                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

<hr>

<div class="d-flex justify-content-between">
    <h4>Total: Rp {{ number_format($subtotal) }}</h4>

    <div>
        <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger">Clear Cart</button>
        </form>

        <a href="{{ route('checkout.index') }}" class="btn btn-success">
            Checkout →
        </a>
    </div>
</div>

@endif

</div>
@endsection
