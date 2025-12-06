<!-- resources/views/pages/admin/verification.blade.php -->
@extends('layouts.app')

@section('title', 'Verifikasi Toko - Admin Panel')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-shield-check"></i> Verifikasi Toko</h5>
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
                
                <!-- Statistik -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center py-3">
                                <h6 class="card-subtitle mb-1">Menunggu Verifikasi</h6>
                                <h3 class="card-title">{{ $pendingStores->count() }}</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center py-3">
                                <h6 class="card-subtitle mb-1">Terverifikasi</h6>
                                <h3 class="card-title">{{ $verifiedCount }}</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card bg-danger text-white">
                            <div class="card-body text-center py-3">
                                <h6 class="card-subtitle mb-1">Ditolak</h6>
                                <h3 class="card-title">{{ $rejectedCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Daftar Toko Menunggu Verifikasi -->
                <h5 class="mb-3">Toko Menunggu Verifikasi</h5>
                
                @if($pendingStores->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID Toko</th>
                                    <th>Nama Toko</th>
                                    <th>Pemilik</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Dokumen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingStores as $store)
                                <tr>
                                    <td>#{{ str_pad($store->id, 6, '0', STR_PAD_LEFT) }}</td>
                                    <td>
                                        <strong>{{ $store->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $store->email }}</small>
                                    </td>
                                    <td>{{ $store->user->name }}</td>
                                    <td>{{ $store->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-info" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#storeModal{{ $store->id }}">
                                            <i class="bi bi-eye"></i> Lihat Detail
                                        </button>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <form action="{{ route('admin.verification.approve', $store->id) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success">
                                                    <i class="bi bi-check-circle"></i> Terima
                                                </button>
                                            </form>
                                            
                                            <button type="button" class="btn btn-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#rejectModal{{ $store->id }}">
                                                <i class="bi bi-x-circle"></i> Tolak
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Modal Detail Toko -->
                                <div class="modal fade" id="storeModal{{ $store->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Detail Toko: {{ $store->name }}</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-4 text-center">
                                                        @if($store->logo)
                                                            <img src="{{ asset('storage/' . $store->logo) }}" 
                                                                 class="img-fluid rounded mb-3" 
                                                                 alt="{{ $store->name }}"
                                                                 style="max-height: 200px;">
                                                        @else
                                                            <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" 
                                                                 style="height: 200px;">
                                                                <i class="bi bi-shop fs-1 text-muted"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h5>{{ $store->name }}</h5>
                                                        <p class="text-muted">{{ $store->description }}</p>
                                                        
                                                        <table class="table table-sm table-borderless">
                                                            <tr>
                                                                <th width="150">Pemilik</th>
                                                                <td>{{ $store->user->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Email</th>
                                                                <td>{{ $store->user->email }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Telepon</th>
                                                                <td>{{ $store->phone }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Alamat</th>
                                                                <td>{{ $store->address }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Tanggal Daftar</th>
                                                                <td>{{ $store->created_at->format('d F Y') }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                
                                                <hr>
                                                
                                                <h6>Informasi Rekening Bank</h6>
                                                <table class="table table-sm table-bordered">
                                                    <tr>
                                                        <th width="150">Nama Bank</th>
                                                        <td>{{ $store->bank_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nomor Rekening</th>
                                                        <td>{{ $store->account_number }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nama Pemilik</th>
                                                        <td>{{ $store->account_holder_name }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Modal Penolakan -->
                                <div class="modal fade" id="rejectModal{{ $store->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">Tolak Pendaftaran Toko</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.verification.reject', $store->id) }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="form-label">Alasan Penolakan</label>
                                                        <textarea class="form-control" name="rejection_reason" rows="3" required 
                                                                  placeholder="Berikan alasan penolakan pendaftaran toko..."></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-danger w-100">
                                                        <i class="bi bi-x-circle"></i> Tolak Pendaftaran
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        {{ $pendingStores->links() }}
                    </div>
                @else
                    <div class="alert alert-success text-center py-4">
                        <i class="bi bi-check-circle display-4"></i>
                        <h4 class="mt-3">Tidak ada toko yang menunggu verifikasi</h4>
                        <p class="mb-0">Semua toko sudah diverifikasi.</p>
                    </div>
                @endif
                
                <!-- Riwayat Verifikasi -->
                <div class="mt-5">
                    <h5 class="mb-3">Riwayat Verifikasi</h5>
                    
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.verification') }}" method="GET" class="row g-3 mb-4">
                                <div class="col-md-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" name="status">
                                        <option value="">Semua Status</option>
                                        <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label">Nama Toko</label>
                                    <input type="text" class="form-control" name="search" 
                                           value="{{ request('search') }}" placeholder="Cari toko...">
                                </div>
                                
                                <div class="col-md-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" name="date" 
                                           value="{{ request('date') }}">
                                </div>
                                
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                                </div>
                            </form>
                            
                            @if($storeHistory->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Toko</th>
                                            <th>Pemilik</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Diverifikasi Oleh</th>
                                            <th>Alasan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($storeHistory as $history)
                                        <tr>
                                            <td>{{ $history->store->name }}</td>
                                            <td>{{ $history->store->user->name }}</td>
                                            <td>{{ $history->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                @if($history->is_verified)
                                                    <span class="badge bg-success">Terverifikasi</span>
                                                @else
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td>{{ $history->admin->name ?? 'System' }}</td>
                                            <td>{{ $history->rejection_reason ?? '-' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="mt-3">
                                {{ $storeHistory->links() }}
                            </div>
                            @else
                            <div class="text-center py-3">
                                <p class="text-muted mb-0">Belum ada riwayat verifikasi.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection