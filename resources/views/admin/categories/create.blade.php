@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold mb-4">Tambah Kategori</h2>

<form method="POST" action="{{ route('admin.categories.store') }}">
@csrf

<label>Nama Kategori:</label>
<input type="text" name="name" class="border p-2 w-full mb-3">

<label>Slug:</label>
<input type="text" name="slug" class="border p-2 w-full mb-3">

<label>Tagline:</label>
<input type="text" name="tagline" class="border p-2 w-full mb-3">

<label>Deskripsi:</label>
<textarea name="description" class="border p-2 w-full mb-3"></textarea>

<button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>

</form>

@endsection
