@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Checkout</h2>

<form method="POST" action="/checkout">
@csrf

<div class="grid grid-cols-2 gap-6">
    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-semibold mb-2">Alamat Pengiriman</h3>

        <input type="text" name="address" class="border p-2 w-full mb-3" placeholder="Alamat" required>
        <input type="text" name="city" class="border p-2 w-full mb-3" placeholder="Kota" required>
        <input type="text" name="postal_code" class="border p-2 w-full mb-3" placeholder="Kode Pos" required>

        <!-- Hidden for demo -->
        <input type="hidden" name="shipping_cost" value="20000">
        <input type="hidden" name="shipping_type" value="REG">
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-semibold">Metode Pembayaran</h3>

        <label><input type="radio" name="payment_method" value="wallet"> Saldo</label><br>
        <label><input type="radio" name="payment_method" value="va"> Virtual Account</label>

        <button class="mt-4 bg-green-600 text-white px-4 py-2 rounded">Proses Checkout</button>
    </div>
</div>

</form>

@endsection
