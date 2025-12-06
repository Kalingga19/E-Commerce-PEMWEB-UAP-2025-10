<!-- resources/views/pages/admin/users.blade.php -->
@extends('layouts.app')

@section('title', 'Manajemen User - Admin Panel')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-people"></i> Manajemen User & Toko</h5>
                <div class="btn-group">
                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" 
                            data-bs-target="#addUserModal">
                        <i class="bi bi-person-plus"></i> Tambah User
                    </button>
                </div>
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
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body text-center py-3">
                                <h6 class="card-subtitle mb-1">Total User</h6>
                                <h3 class="card-title">{{ $totalUsers }}</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center py-3">
                                <h6 class="card-subtitle mb-1">Admin</h6>
                                <h3 class="card-title">{{ $adminCount }}</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center py-3">
                                <h6 class="card-subtitle mb-1">Seller</h6>
                                <h3 class="card-title">{{ $sellerCount }}</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center py-3">
                                <h6 class="card-subtitle mb-1">Member</h6>
                                <h3 class="card-title">{{ $memberCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Filter dan Pencarian -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('admin.users.index') }}" method="GET" class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Cari User</label>
                                <input type="text" class="form-control" name="search" 
                                       value="{{ request('search') }}" placeholder="Nama atau email...">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label">Role</label>
                                <select class="form-select" name="role">
                                    <option value="">Semua Role</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="seller" {{ request('role') == 'seller' ? 'selected' : '' }}>Seller</option>
                                    <option value="member" {{ request('role') == 'member' ? 'selected' : '' }}>Member</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="">Semua Status</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                                    <option value="banned" {{ request('status') == 'banned' ? 'selected' : '' }}>Diblokir</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Tabs untuk User dan Toko -->
                <ul class="nav nav-tabs mb-4" id="userTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="users-tab" data-bs-toggle="tab" 
                                data-bs-target="#users" type="button" role="tab">
                            <i class="bi bi-people"></i> Daftar User
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="stores-tab" data-bs-toggle="tab" 
                                data-bs-target="#stores" type="button" role="tab">
                            <i class="bi bi-shop"></i> Daftar Toko
                        </button>
                    </li>
                </ul>
                
                <div class="tab-content" id="userTabContent">
                    <!-- Tab User -->
                    <div class="tab-pane fade show active" id="users" role="tabpanel">
                        @if($users->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>#{{ str_pad($user->id, 6, '0', STR_PAD_LEFT) }}</td>
                                        <td>
                                            <strong>{{ $user->name }}</strong>
                                            @if($user->store)
                                                <br>
                                                <small class="text-muted">
                                                    <i class="bi bi-shop"></i> {{ $user->store->name }}
                                                </small>
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->role === 'admin')
                                                <span class="badge bg-success">Admin</span>
                                            @elseif($user->role === 'seller')
                                                <span class="badge bg-info">Seller</span>
                                            @else
                                                <span class="badge bg-warning">Member</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->is_active)
                                                <span class="badge bg-success">Aktif</span>
                                            @elseif($user->is_banned)
                                                <span class="badge bg-danger">Diblokir</span>
                                            @else
                                                <span class="badge bg-secondary">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-outline-info"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#userModal{{ $user->id }}">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                
                                                <button type="button" class="btn btn-outline-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editUserModal{{ $user->id }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                
                                                @if($user->id !== auth()->id())
                                                    @if($user->is_banned)
                                                        <form action="{{ route('admin.users.unban', $user->id) }}" 
                                                              method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-success">
                                                                <i class="bi bi-check-circle"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button type="button" class="btn btn-outline-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#banUserModal{{ $user->id }}">
                                                            <i class="bi bi-slash-circle"></i>
                                                        </button>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal Detail User -->
                                    <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title">Detail User: {{ $user->name }}</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <table class="table table-sm table-borderless">
                                                                <tr>
                                                                    <th width="150">ID User</th>
                                                                    <td>#{{ str_pad($user->id, 6, '0', STR_PAD_LEFT) }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Nama Lengkap</th>
                                                                    <td>{{ $user->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Email</th>
                                                                    <td>{{ $user->email }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Role</th>
                                                                    <td>
                                                                        @if($user->role === 'admin')
                                                                            <span class="badge bg-success">Admin</span>
                                                                        @elseif($user->role === 'seller')
                                                                            <span class="badge bg-info">Seller</span>
                                                                        @else
                                                                            <span class="badge bg-warning">Member</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Status</th>
                                                                    <td>
                                                                        @if($user->is_active)
                                                                            <span class="badge bg-success">Aktif</span>
                                                                        @elseif($user->is_banned)
                                                                            <span class="badge bg-danger">Diblokir</span>
                                                                        @else
                                                                            <span class="badge bg-secondary">Nonaktif</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Tanggal Daftar</th>
                                                                    <td>{{ $user->created_at->format('d F Y H:i') }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Terakhir Login</th>
                                                                    <td>{{ $user->last_login_at ? $user->last_login_at->format('d F Y H:i') : 'Belum pernah login' }}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    
                                                    @if($user->store)
                                                    <hr>
                                                    <h6>Informasi Toko</h6>
                                                    <table class="table table-sm table-bordered">
                                                        <tr>
                                                            <th width="150">Nama Toko</th>
                                                            <td>{{ $user->store->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status Toko</th>
                                                            <td>
                                                                @if($user->store->is_verified)
                                                                    <span class="badge bg-success">Terverifikasi</span>
                                                                @else
                                                                    <span class="badge bg-warning">Menunggu</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Alamat Toko</th>
                                                            <td>{{ $user->store->address }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Telepon Toko</th>
                                                            <td>{{ $user->store->phone }}</td>
                                                        </tr>
                                                    </table>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Modal Edit User -->
                                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning text-white">
                                                    <h5 class="modal-title">Edit User: {{ $user->name }}</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Lengkap</label>
                                                            <input type="text" class="form-control" name="name" 
                                                                   value="{{ $user->name }}" required>
                                                        </div>
                                                        
                                                        <div class="mb-3">
                                                            <label class="form-label">Email</label>
                                                            <input type="email" class="form-control" name="email" 
                                                                   value="{{ $user->email }}" required>
                                                        </div>
                                                        
                                                        <div class="mb-3">
                                                            <label class="form-label">Role</label>
                                                            <select class="form-select" name="role" required>
                                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                                <option value="seller" {{ $user->role == 'seller' ? 'selected' : '' }}>Seller</option>
                                                                <option value="member" {{ $user->role == 'member' ? 'selected' : '' }}>Member</option>
                                                            </select>
                                                        </div>
                                                        
                                                        <div class="mb-3">
                                                            <label class="form-label">Status</label>
                                                            <select class="form-select" name="is_active">
                                                                <option value="1" {{ $user->is_active ? 'selected' : '' }}>Aktif</option>
                                                                <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Nonaktif</option>
                                                            </select>
                                                        </div>
                                                        
                                                        <button type="submit" class="btn btn-warning w-100">
                                                            <i class="bi bi-check-circle"></i> Update User
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Modal Ban User -->
                                    @if($user->id !== auth()->id())
                                    <div class="modal fade" id="banUserModal{{ $user->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title">Blokir User</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.users.ban', $user->id) }}" method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label class="form-label">Alasan Pemblokiran</label>
                                                            <textarea class="form-control" name="ban_reason" rows="3" required 
                                                                      placeholder="Berikan alasan pemblokiran user..."></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-danger w-100">
                                                            <i class="bi bi-slash-circle"></i> Blokir User
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-3">
                            {{ $users->links() }}
                        </div>
                        @else
                        <div class="text-center py-4">
                            <i class="bi bi-people display-4 text-muted"></i>
                            <p class="mt-3 text-muted">Tidak ada user yang ditemukan.</p>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Tab Toko -->
                    <div class="tab-pane fade" id="stores" role="tabpanel">
                        @if($stores->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID Toko</th>
                                        <th>Nama Toko</th>
                                        <th>Pemilik</th>
                                        <th>Status</th>
                                        <th>Total Produk</th>
                                        <th>Total Penjualan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stores as $store)
                                    <tr>
                                        <td>#{{ str_pad($store->id, 6, '0', STR_PAD_LEFT) }}</td>
                                        <td>
                                            <strong>{{ $store->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $store->email }}</small>
                                        </td>
                                        <td>{{ $store->user->name }}</td>
                                        <td>
                                            @if($store->is_verified)
                                                <span class="badge bg-success">Terverifikasi</span>
                                            @else
                                                <span class="badge bg-warning">Menunggu</span>
                                            @endif
                                            
                                            @if(!$store->is_active)
                                                <br>
                                                <span class="badge bg-secondary">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>{{ $store->products_count }}</td>
                                        <td>{{ $store->orders_count }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('store.show', $store->slug) }}" 
                                                   class="btn btn-outline-primary" target="_blank">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                
                                                @if($store->is_verified)
                                                    <form action="{{ route('admin.stores.deactivate', $store->id) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-warning">
                                                            <i class="bi bi-pause"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.stores.verify', $store->id) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-success">
                                                            <i class="bi bi-check"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                
                                                <form action="{{ route('admin.stores.destroy', $store->id) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Hapus toko ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-3">
                            {{ $stores->links() }}
                        </div>
                        @else
                        <div class="text-center py-4">
                            <i class="bi bi-shop display-4 text-muted"></i>
                            <p class="mt-3 text-muted">Tidak ada toko yang ditemukan.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Tambah User Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" required 
                               placeholder="Nama user...">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required 
                               placeholder="email@example.com">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required 
                               placeholder="Password minimal 8 karakter">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="password_confirmation" required 
                               placeholder="Ulangi password">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" name="role" required>
                            <option value="">Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="seller">Seller</option>
                            <option value="member">Member</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-person-plus"></i> Tambah User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection