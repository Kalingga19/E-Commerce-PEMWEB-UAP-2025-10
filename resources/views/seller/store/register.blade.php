@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Daftarkan Toko Baru</h2>

<form action="{{ route('store.register.store') }}" method="POST">
@csrf

    <label>Nama Toko:</label>
    <input type="text" name="name" class="border p-2 w-full mb-3" required>

    <label>No. HP:</label>
    <input type="text" name="phone" class="border p-2 w-full mb-3" required>

    <label>Kota:</label>
    <input type="text" name="city" class="border p-2 w-full mb-3" required>

    <label>Alamat Lengkap:</label>
    <textarea name="address" class="border p-2 w-full mb-3" required></textarea>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Daftar Toko</button>
</form>

@endsection
