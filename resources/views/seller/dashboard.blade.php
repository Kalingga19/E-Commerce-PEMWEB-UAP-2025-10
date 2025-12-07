@extends('layouts.app')

@section('content')
<div class="py-6">

    <h2 class="text-2xl font-bold mb-4">Dashboard Penjual</h2>

    <div class="grid grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">Total Produk</h3>
            <p class="text-3xl font-bold">{{ $products }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">Total Pesanan</h3>
            <p class="text-3xl font-bold">{{ $orders }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">Saldo Toko</h3>
            <p class="text-3xl font-bold text-green-600">
                Rp {{ number_format($revenue, 0, ',', '.') }}
            </p>
        </div>

    </div>

</div>
@endsection
