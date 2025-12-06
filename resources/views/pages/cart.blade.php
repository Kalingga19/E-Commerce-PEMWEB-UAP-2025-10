@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Keranjang Belanja</h2>

    @if($cartItems->count() > 0)

    <table class="table align-middle">
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
                <td>
                    <strong>{{ $item->product->name }}</strong><br>
                    <small class="text-muted">
                        {{ $item->product->store->name }}
                    </small>
                </td>

                <td>Rp {{ number_format($item->product->price) }}</td>

                <td>
                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                        @csrf
                        <input type="number" name="quantity" value="{{ $item->quantity }}" 
                               class="form-control d-inline-block w-50" min="1">
                        <button class="btn btn-primary btn-sm mt-1">Update</button>
                    </form>
                </td>

                <td>
                    Rp {{ number_format($item->product->price * $item->quantity) }}
                </td>

                <td>
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>

    <hr>

    <div class="text-end">
        <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg">
            Lanjutkan ke Checkout
        </a>
    </div>

    @else

    <div class="text-center py-5">
        <i class="bi bi-cart-x display-4 text-muted"></i>
        <h4 class="mt-3">Keranjang kosong</h4>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Belanja Sekarang</a>
    </div>

    @endif
</div>
@endsection
