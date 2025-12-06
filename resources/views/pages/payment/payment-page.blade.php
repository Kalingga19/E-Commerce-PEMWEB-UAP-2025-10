@extends('layouts.app')

@section('title', 'Pembayaran Virtual Account')

@section('content')
<div class="container py-4">

    <h3 class="mb-4">
        <i class="bi bi-credit-card"></i> Pembayaran Virtual Account
    </h3>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- FORM INPUT KODE VA --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white"><strong>Cari Kode VA</strong></div>
        <div class="card-body">

            <form action="{{ route('payment.index') }}" method="GET" class="row g-3">
                <div class="col-md-8">
                    <input 
                        type="text"
                        name="va_code"
                        class="form-control"
                        value="{{ request('va_code') }}"
                        placeholder="Masukkan kode VA (contoh: TOPUP-1-1712345678)"
                        required>
                </div>

                <div class="col-md-4">
                    <button class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </form>

        </div>
    </div>


    {{-- DETAIL VA --}}
    @if(isset($va) && $va)
    <div class="card mb-4">
        <div class="card-header bg-success text-white"><strong>Detail Virtual Account</strong></div>

        <div class="card-body">

            <p><strong>Kode VA:</strong> {{ $va->va_code }}</p>

            <p><strong>Jenis:</strong> 
                @if($va->type === 'topup')
                    Topup Saldo
                @else
                    Pembayaran Transaksi #{{ $va->transaction_id }}
                @endif
            </p>

            <p><strong>Jumlah Tagihan:</strong> Rp {{ number_format($va->amount) }}</p>

            <p><strong>Status:</strong> 
                <span class="badge bg-{{ $va->status === 'pending' ? 'warning' : 'success' }}">
                    {{ strtoupper($va->status) }}
                </span>
            </p>


            {{-- FORM KONFIRMASI --}}
            @if($va->status === 'pending')
                <hr>

                <form action="{{ route('payment.confirm') }}" method="POST">
                    @csrf

                    <input type="hidden" name="va_code" value="{{ $va->va_code }}">

                    <div class="mb-3">
                        <label class="form-label">Masukkan Nominal Transfer</label>
                        <input 
                            type="number" 
                            class="form-control" 
                            name="amount" 
                            placeholder="Masukkan nominal tepat: {{ $va->amount }}"
                            required>
                    </div>

                    <button class="btn btn-success w-100">
                        <i class="bi bi-check-circle"></i> Konfirmasi Pembayaran
                    </button>
                </form>

            @else
                <div class="alert alert-success mt-3">Pembayaran sudah selesai.</div>
            @endif

        </div>
    </div>
    @endif

</div>
@endsection
