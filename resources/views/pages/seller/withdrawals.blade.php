@extends('layouts.app')

@section('title', 'Penarikan Dana')

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-cash-coin"></i> Penarikan Dana</h5>
                <a href="{{ route('seller.balance.index') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali ke Saldo
                </a>
            </div>

            <div class="card-body">

                {{-- Alerts --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                {{-- Saldo Info --}}
                <div class="alert alert-info mb-4">
                    <i class="bi bi-info-circle fs-4 me-2"></i>
                    Saldo tersedia: 
                    <strong>Rp {{ number_format($balance->balance) }}</strong> — 
                    Minimal penarikan: <strong>Rp 50.000</strong>
                </div>


                {{-- Form Penarikan --}}
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0">Ajukan Penarikan</h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('seller.withdraw.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                {{-- Amount --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jumlah Penarikan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control"
                                               name="amount"
                                               required
                                               min="50000"
                                               max="{{ $balance->balance }}"
                                               placeholder="50000">
                                    </div>
                                </div>

                                {{-- Rekening --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Rekening Tujuan</label>
                                    <div class="card">
                                        <div class="card-body">
                                            <strong>{{ $store->bank_name }}</strong><br>
                                            {{ $store->bank_account_number }}<br>
                                            a/n {{ $store->bank_account_name }}
                                        </div>
                                    </div>
                                    <small>
                                        <a href="{{ route('seller.profile') }}">Ubah rekening</a>
                                    </small>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-send-check"></i> Ajukan Penarikan
                            </button>
                        </form>
                    </div>
                </div>


                {{-- RIWAYAT PENARIKAN --}}
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
                                        <th>ID</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Rekening</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($withdrawals as $wd)
                                    <tr>
                                        <td>#{{ str_pad($wd->id, 6, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $wd->created_at->format('d/m/Y H:i') }}</td>
                                        <td>Rp {{ number_format($wd->amount) }}</td>

                                        <td>
                                            <small>
                                                {{ $wd->bank_name }}<br>
                                                {{ $wd->bank_account_number }}<br>
                                                a/n {{ $wd->bank_account_name }}
                                            </small>
                                        </td>

                                        <td>
                                            @if($wd->status == 'pending')
                                                <span class="badge bg-warning">Menunggu</span>
                                            @elseif($wd->status == 'approved')
                                                <span class="badge bg-success">Disetujui</span>
                                            @else
                                                <span class="badge bg-danger">Ditolak</span>
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
                        </div>
                        @endif

                    </div>
                </div>


            </div>
        </div>

    </div>
</div>
@endsection
