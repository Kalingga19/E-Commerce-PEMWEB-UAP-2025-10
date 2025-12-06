@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h2 class="mb-4">Keranjang Belanja</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (empty($cart))
        <p class="text-muted">Keranjang masih kosong.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Belanja Sekarang</a>
    @else

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @php $total = 0; @endphp

                @foreach ($cart as $item)
                    @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    @endphp

                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $item['image']) }}" width="70">
                            <strong>{{ $item['name'] }}</strong>
                        </td>

                        <td>Rp {{ number_format($item['price'],0,',','.') }}</td>

                        <td>
                            <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                       class="form-control d-inline w-50">
                                <button class="btn btn-sm btn-primary mt-1">Update</button>
                            </form>
                        </td>

                        <td>Rp {{ number_format($subtotal,0,',','.') }}</td>

                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <th colspan="3" class="text-end">Total</th>
                    <th colspan="2">Rp {{ number_format($total,0,',','.') }}</th>
                </tr>

            </tbody>
        </table>

        <a href="/checkout" class="btn btn-success btn-lg">Lanjut ke Checkout</a>

    @endif
</div>
@endsection
