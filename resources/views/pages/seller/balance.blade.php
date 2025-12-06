<!-- resources/views/pages/seller/balance.blade.php -->
@extends('layouts.app')

@section('title', 'Saldo Toko - Laravel E-Commerce')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-wallet2"></i> Saldo Toko</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                <!-- Saldo Info -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center py-4">
                                <h6 class="card-subtitle mb-2">Saldo Tersedia</h6>
                                <h2 class="card-title">Rp {{ number_format($storeBalance->balance ?? 0) }}</h2>
                                <p class="mb-0">Dapat ditarik</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center py-4">
                                <h6 class="card-subtitle mb-2">Total Pendapatan</h6>
                                <h2 class="card-title">Rp {{ number_format($totalRevenue) }}</h2>
                                <p class="mb-0">Semua waktu</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center py-4">
                                <h6 class="card-subtitle mb-2">Menunggu Pencairan</h6>
                                <h2 class="card-title">Rp {{ number_format($pendingWithdrawals) }}</h2>
                                <p class="mb-0">Dalam proses</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Penarikan -->
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0">Ajukan Penarikan</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('seller.withdrawals.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label">Jumlah Penarikan (Rp)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" name="amount" 
                                           min="50000" max="{{ $storeBalance->balance ?? 0 }}" 
                                           step="1000" required placeholder="Minimal Rp 50.000">
                                </div>
                                <small class="text-muted">
                                    Saldo tersedia: Rp {{ number_format($storeBalance->balance ?? 0) }}
                                </small>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Rekening Tujuan</label>
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <p class="mb-1"><strong>{{ $store->bank_name ?? 'Belum diatur' }}</strong></p>
                                        <p class="mb-1">{{ $store->account_number ?? '-' }}</p>
                                        <p class="mb-0">a/n {{ $store->account_holder_name ?? '-' }}</p>
                                    </div>
                                </div>
                                <small class="text-muted">
                                    Untuk mengubah rekening, perbarui di <a href="{{ route('seller.profile') }}">Profil Toko</a>
                                </small>
                            </div>
                            
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i>
                                <small>
                                    Penarikan akan diproses dalam 1-3 hari kerja. Minimal penarikan Rp 50.000.
                                </small>
                            </div>
                            
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-cash-coin"></i> Ajukan Penarikan
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Riwayat Saldo -->
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0">Riwayat Saldo</h6>
                    </div>
                    <div class="card-body">
                        @if($balanceHistories->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Jenis</th>
                                        <th>Jumlah</th>
                                        <th>Saldo Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($balanceHistories as $history)
                                    <tr>
                                        <td>{{ $history->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            {{ $history->description }}
                                            @if($history->transaction_id)
                                                <br>
                                                <small class="text-muted">
                                                    Transaksi #{{ str_pad($history->transaction_id, 6, '0', STR_PAD_LEFT) }}
                                                </small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($history->type === 'credit')
                                                <span class="badge bg-success">Kredit</span>
                                            @else
                                                <span class="badge bg-danger">Debit</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($history->type === 'credit')
                                                <span class="text-success">
                                                    + Rp {{ number_format($history->amount) }}
                                                </span>
                                            @else
                                                <span class="text-danger">
                                                    - Rp {{ number_format($history->amount) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($history->ending_balance) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-3">
                            {{ $balanceHistories->links() }}
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