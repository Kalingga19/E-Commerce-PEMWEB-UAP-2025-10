@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold mb-4">Edit Produk</h2>

<form action="{{ route('seller.products.update', $product) }}" method="POST">
@csrf
@method('PUT')

<div class="grid grid-cols-2 gap-6">

    <div>
        <label>Nama Produk</label>
        <input type="text" name="name" class="border p-2 w-full mb-3" 
               value="{{ $product->name }}">

        <label>Kategori</label>
        <select name="product_category_id" class="border p-2 w-full mb-3">
            @foreach($categories as $c)
                <option value="{{ $c->id }}" 
                        @if($product->product_category_id==$c->id) selected @endif>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>

        <label>Harga</label>
        <input type="number" name="price" class="border p-2 w-full mb-3"
               value="{{ $product->price }}">

        <label>Stok</label>
        <input type="number" name="stock" class="border p-2 w-full mb-3"
               value="{{ $product->stock }}">
    </div>

    <div>
        <label>Deskripsi</label>
        <textarea name="description" class="border p-2 w-full h-40 mb-3">
            {{ $product->description }}
        </textarea>

        <label>Kondisi</label>
        <select name="condition" class="border p-2 w-full">
            <option value="new" @if($product->condition=='new') selected @endif>Baru</option>
            <option value="second" @if($product->condition=='second') selected @endif>Bekas</option>
        </select>
    </div>

</div>

<button class="mt-4 bg-green-600 text-white px-4 py-2 rounded">
    Update Produk
</button>

</form>

@endsection
