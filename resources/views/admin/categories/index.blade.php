@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Kategori Produk</h2>

<a href="{{ route('admin.categories.create') }}" 
    class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah Kategori</a>

<table class="w-full bg-white shadow rounded overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-3">Nama</th>
            <th class="p-3">Slug</th>
            <th class="p-3">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($categories as $c)
        <tr class="border-b">
            <td class="p-3">{{ $c->name }}</td>
            <td class="p-3">{{ $c->slug }}</td>
            <td class="p-3">
                <a href="{{ route('admin.categories.edit', $c) }}" class="text-blue-600">Edit</a>

                <form action="{{ route('admin.categories.destroy', $c) }}"
                    method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 ml-2">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>

@endsection
