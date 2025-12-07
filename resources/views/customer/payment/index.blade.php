@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold mb-4">Konfirmasi Pembayaran</h2>

<form method="POST" action="/payment">
@csrf

    <input type="text" name="va_code" placeholder="Masukkan Kode VA" class="border p-2 w-full mb-4" required>

    <button class="bg-green-600 text-white px-4 py-2 rounded">Konfirmasi</button>
</form>

@endsection
