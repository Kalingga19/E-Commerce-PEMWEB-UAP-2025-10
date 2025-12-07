@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold mb-4">Saldo Toko</h2>

<div class="bg-white p-4 rounded shadow mb-4">
    <h3 class="text-lg font-semibold">Saldo Saat Ini:</h3>
    <p class="text-3xl text-green-600 font-bold">
        Rp {{ number_format($balance, 0, ',', '.') }}
    </p>
</div>

<h3 class="font-semibold text-lg mt-6 mb-2">Riwayat Saldo</h3>

@foreach($histories as $h)
<div class="bg-white p-4 rounded shadow mb-3">
    <p>{{ ucfirst($h->type) }}: Rp {{ number_format($h->amount) }}</p>
    <p>Ref: {{ $h->reference_id }} ({{ $h->reference_type }})</p>
</div>
@endforeach

@endsection
