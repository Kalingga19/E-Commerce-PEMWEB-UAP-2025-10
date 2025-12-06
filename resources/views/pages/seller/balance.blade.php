@extends('layouts.app')

@section('title', 'Saldo Toko')

@section('content')
<div class="row">
    <div class="col-md-12">

        {{-- Card Utama --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-wallet2"></i> Saldo Toko</h5>
            </div>

            <div class="card-body">

                {{-- Alert --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif


                {{-- SUMMARY SALDO --}}
                <div class="row mb-4">

                    {{-- Saldo tersedia --}}
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center py-4">
                                <h6>Saldo Tersedia</h6>
                                <h2>Rp {{ number_format($balance->balance) }}</h2>
                                <p class="mb-0">Dapat ditarik</p>
                            </div>
                        </div>
                    </div>

                    {{-- Total Pendapatan (sum income) --}}
                    <div class="col-md-4">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center py-4">
                                <h6>Total Pendapatan</h6>
                                <h2>
                                    Rp {{ number_format($histories->where('type','income')->sum('amount')) }}
                                </h2>
                                <p class="mb-0">Semua waktu</p>
                            </div>
                        </div>
                    </div>

                    {{-- Pending Withdraw --}}
                    <div class="col-md-4">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center py-4">
                                <h6>Menunggu Pencairan</h6>
                                <h2>
                                    Rp {{ number_format(
                                        $pendingWithdrawals ?? 0
                                    ) }}
                                </h2>
                                <p class="mb-0">Dalam proses</p>
                            </div>
                        </div>
                    </div>

                </div>


                {{-- FORM WITHDRAW --}}
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0">Ajukan Penarikan</h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('seller.withdraw.store') }}" method="POST">
                            @csrf

                            {{-- Amount --}}
                            <div class="mb-3">
                                <label>Jumlah Penarikan (Rp)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control"
                                           name="amount"
                                           min="50000"
                                           max="{{ $balance->balance }}"
                                           required>
                                </div>
                                <small class="text-muted">
                                    Saldo Anda: Rp {{ number_format($balance->balance) }}
                                </small>
                            </div>

                            {{-- BANK INFO --}}
                            <div class="mb-3">
                                <label>Rekening Tujuan</label>

                                <div class="card bg-light">
                                    <div class="card-body">

                                        <strong>{{ $store->bank_name ?? 'Belum diisi' }}</strong><br>
                                        {{ $store->bank_account_number ?? '-' }}<br>
                                        a/n {{ $store->bank_account_name ?? '-' }}

                                    </div>
                                </div>

                                <small class="text-muted">
                                    Untuk mengubah rekening, masuk ke Profil Toko.
                                </small>
                            </div>

                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i>
                                Penarikan diproses 1–3 hari kerja.
                            </div>

                            <button class="btn btn-success">
                                <i class="bi bi-cash-coin"></i> Ajukan Penarikan
                            </button>
                        </form>
                    </div>
                </div>


                {{-- RIWAYAT SALDO --}}
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0">Riwayat Saldo</h6>
                    </div>

                    <div class="card-body">

                        @if($histories->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Jenis</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($histories as $h)
                                    <tr>
                                        <td>{{ $h->created_at->format('d/m/Y H:i') }}</td>

                                        <td>
                                            <span class="badge bg-{{ $h->type == 'income' ? 'success' : 'danger' }}">
                                                {{ ucfirst($h->type) }}
                                            </span>
                                        </td>

                                        <td>
                                            @if($h->type == 'income')
                                                <span class="text-success">
                                                    + Rp {{ number_format($h->amount) }}
                                                </span>
                                            @else
                                                <span class="text-danger">
                                                    - Rp {{ number_format($h->amount) }}
                                                </span>
                                            @endif
                                        </td>

                                        <td>{{ $h->remarks }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-wallet display-4 text-muted"></i>
                                <p class="mt-3 text-muted">Belum ada riwayat saldo.</p>
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
