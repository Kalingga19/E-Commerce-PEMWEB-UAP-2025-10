<!-- resources/views/pages/seller/withdrawals.blade.php -->
@extends('layouts.app')

@section('title', 'Penarikan Dana - Laravel E-Commerce')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-cash-coin"></i> Penarikan Dana</h5>
                <a href="{{ route('seller.balance') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali ke Saldo
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                <!-- Info Saldo -->
                <div class="alert alert-info mb-4">
                    <div class="d-flex">
                        <i class="bi bi-info-circle fs-4 me-3"></i>
                        <div>
                            <h6 class="mb-1">Informasi Penarikan</h6>
                            <p class="mb-0">
                                Saldo tersedia: <strong>Rp {{ number_format($storeBalance->balance ?? 0) }}</strong> | 
                                Minimal penarikan: <strong>Rp 50.000</strong> | 
                                Proses: <strong>1-3 hari kerja</strong>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Form Penarikan -->
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0">Ajukan Penarikan Baru</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('seller.withdrawals.store') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jumlah Penarikan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="amount" 
                                               min="50000" max="{{ $storeBalance->balance ?? 0 }}" 
                                               step="1000" required placeholder="50000">
                                    </div>
                                    <small class="text-muted">
                                        Minimal Rp 50.000, maksimal Rp {{ number_format($storeBalance->balance ?? 0) }}
                                    </small>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Catatan (Opsional)</label>
                                    <input type="text" class="form-control" name="notes" 
                                           placeholder="Contoh: Penarikan dana bulanan">
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">Rekening Tujuan</label>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1">{{ $store->bank_name ?? 'Belum diatur' }}</h6>
                                                <p class="mb-1 text-muted">{{ $store->account_number ?? '-' }}</p>
                                                <p class="mb-0">a/n {{ $store->account_holder_name ?? '-' }}</p>
                                            </div>
                                            <a href="{{ route('seller.profile') }}" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i> Ubah
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-send-check"></i> Ajukan Penarikan
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Riwayat Penarikan -->
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0">Riwayat Penarikan</h6>
                    </div>
                    <div class="card-body">
                        @if($withdrawals->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID Penarikan</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Rekening Tujuan</th>
                                        <th>Status</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($withdrawals as $withdrawal)
                                    <tr>
                                        <td>#{{ str_pad($withdrawal->id, 6, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $withdrawal->created_at->format('d/m/Y H:i') }}</td>
                                        <td>Rp {{ number_format($withdrawal->amount) }}</td>
                                        <td>
                                            <small>
                                                {{ $withdrawal->bank_name }}<br>
                                                {{ $withdrawal->account_number }}
                                            </small>
                                        </td>
                                        <td>
                                            @if($withdrawal->status === 'pending')
                                                <span class="badge bg-warning">Menunggu</span>
                                            @elseif($withdrawal->status === 'processed')
                                                <span class="badge bg-info">Diproses</span>
                                            @elseif($withdrawal->status === 'completed')
                                                <span class="badge bg-success">Selesai</span>
                                            @elseif($withdrawal->status === 'rejected')
                                                <span class="badge bg-danger">Ditolak</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $withdrawal->status }}</span>
                                            @endif
                                            
                                            @if($withdrawal->processed_at)
                                                <br>
                                                <small class="text-muted">
                                                    {{ $withdrawal->processed_at->format('d/m/Y') }}
                                                </small>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $withdrawal->notes ?? '-' }}
                                            @if($withdrawal->rejection_reason)
                                                <br>
                                                <small class="text-danger">
                                                    <strong>Alasan ditolak:</strong> {{ $withdrawal->rejection_reason }}
                                                </small>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-3">
                            {{ $withdrawals->links() }}
                        </div>
                        @else
                        <div class="text-center py-4">
                            <i class="bi bi-cash-stack display-4 text-muted"></i>
                            <p class="mt-3 text-muted">Belum ada riwayat penarikan.</p>
                            <p class="mb-0">Ajukan penarikan pertama Anda di form di atas.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection