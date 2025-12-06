<!-- resources/views/pages/seller/profile.blade.php -->
@extends('layouts.app')

@section('title', 'Profil Toko - Laravel E-Commerce')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-shop"></i> Profil Toko</h5>
                <span class="badge bg-{{ $store->is_verified ? 'success' : 'warning' }}">
                    {{ $store->is_verified ? 'Terverifikasi' : 'Menunggu Verifikasi' }}
                </span>
            </div>
            <div class="card-body">
                <form action="{{ route('seller.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            <div class="mb-3">
                                @if($store->logo)
                                    <img src="{{ asset('storage/' . $store->logo) }}" 
                                         id="logo-preview" 
                                         class="img-fluid rounded-circle border" 
                                         alt="Logo Toko" 
                                         style="width: 200px; height: 200px; object-fit: cover;">
                                @else
                                    <div id="logo-preview" 
                                         class="rounded-circle border d-flex align-items-center justify-content-center mx-auto bg-light" 
                                         style="width: 200px; height: 200px;">
                                        <i class="bi bi-shop fs-1 text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ganti Logo Toko</label>
                                <input type="file" class="form-control" name="logo" accept="image/*" 
                                       onchange="previewImage(this, 'logo-preview')">
                                <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Nama Toko <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" 
                                       value="{{ old('name', $store->name) }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Toko</label>
                                <textarea class="form-control" name="description" rows="3">{{ old('description', $store->description) }}</textarea>
                                <small class="text-muted">Maksimal 500 karakter</small>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Alamat Toko <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" rows="2" required>{{ old('address', $store->address) }}</textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="phone" 
                                           value="{{ old('phone', $store->phone) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Toko</label>
                                    <input type="email" class="form-control" name="email" 
                                           value="{{ old('email', $store->email) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <h5 class="mb-3">Informasi Rekening Bank</h5>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Bank <span class="text-danger">*</span></label>
                            <select class="form-select" name="bank_name" required>
                                <option value="" {{ !$store->bank_name ? 'selected' : '' }} disabled>Pilih Bank</option>
                                <option value="BCA" {{ old('bank_name', $store->bank_name) == 'BCA' ? 'selected' : '' }}>BCA</option>
                                <option value="BNI" {{ old('bank_name', $store->bank_name) == 'BNI' ? 'selected' : '' }}>BNI</option>
                                <option value="BRI" {{ old('bank_name', $store->bank_name) == 'BRI' ? 'selected' : '' }}>BRI</option>
                                <option value="Mandiri" {{ old('bank_name', $store->bank_name) == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                                <option value="BSI" {{ old('bank_name', $store->bank_name) == 'BSI' ? 'selected' : '' }}>BSI</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nomor Rekening <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="account_number" 
                                   value="{{ old('account_number', $store->account_number) }}" required>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Nama Pemilik Rekening <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="account_holder_name" 
                               value="{{ old('account_holder_name', $store->account_holder_name) }}" required>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('seller.dashboard') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
