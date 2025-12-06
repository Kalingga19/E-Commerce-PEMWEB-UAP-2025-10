@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container py-4">

    <h3 class="mb-4">Dashboard Admin</h3>

    <div class="row">

        <div class="col-md-3">
            <div class="card text-center text-white bg-primary mb-3">
                <div class="card-body">
                    <h5>Total User</h5>
                    <h2>{{ $totalUsers }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center text-white bg-success mb-3">
                <div class="card-body">
                    <h5>Total Toko</h5>
                    <h2>{{ $totalStores }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center text-white bg-info mb-3">
                <div class="card-body">
                    <h5>Total Produk</h5>
                    <h2>{{ $totalProducts }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center text-white bg-warning mb-3">
                <div class="card-body">
                    <h5>Total Transaksi</h5>
                    <h2>{{ $totalTransactions }}</h2>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
