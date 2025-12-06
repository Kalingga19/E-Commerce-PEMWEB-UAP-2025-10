@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h2>Checkout</h2>

    <form action="{{ route('checkout.process') }}" method="POST" class="mt-4">
        @csrf

        <h4>Informasi Penerima</h4>
        <div class="mb-3">
            <label>Nama Penerima</label>
            <input type="text" name="receiver_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>No. Telepon</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Alamat Lengkap</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Kota</label>
                <input type="text" name="city" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Kode Pos</label>
                <input type="text" name="postal_code" class="form-control" required>
            </div>
        </div>

        <hr>

        <h4>Ringkasan Pesanan</h4>

        <ul class="list-group mb-3">
            @php $total = 0; @endphp
            @foreach ($cart as $item)
                @php 
                    $subtotal = $item['price'] * $item['quantity']; 
                    $total += $subtotal;
                @endphp
                <li class="list-group-item d-flex justify-content-between">
                    <div>
                        <strong>{{ $item['name'] }}</strong><br>
                        <small>{{ $item['quantity'] }} × Rp {{ number_format($item['price']) }}</small>
                    </div>
                    <span>Rp {{ number_format($subtotal) }}</span>
                </li>
            @endforeach

            <li class="list-group-item d-flex justify-content-between bg-light">
                <strong>Total</strong>
                <strong>Rp {{ number_format($total) }}</strong>
            </li>
        </ul>

        <button class="btn btn-success btn-lg w-100">Lanjut ke Pembayaran</button>

    </form>

</div>
@endsection
