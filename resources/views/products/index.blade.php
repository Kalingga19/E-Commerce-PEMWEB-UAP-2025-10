@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <h1>List Produk</h1>

    @foreach($products as $product)
        <p>{{ $product->name }} - Rp{{ $product->price }}</p>
    @endforeach
@endsection
