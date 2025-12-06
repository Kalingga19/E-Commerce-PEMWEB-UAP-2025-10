<!-- resources/views/pages/store-register.blade.php -->
@extends('layouts.app')

@section('title', 'Daftar Toko - Laravel E-Commerce')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-shop"></i> Pendaftaran Toko</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('store.register.process') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div class="mb-4">
                        <h6 class="border-bottom pb-2 mb-3">Informasi Toko</h6>
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Toko <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" 
                                   value="{{ old('name') }}" required
                                   placeholder="Contoh: Toko Elektronik Maju">
                            <small class="text-muted">Nama toko akan ditampilkan di halaman produk</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Toko</label>
                            <textarea class="form-control" name="description" rows="3"
                                      placeholder="Deskripsikan toko Anda">{{ old('description') }}</textarea>
                            <small class="text-muted">Maksimal 500 karakter</small>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Logo Toko</label>
                                <input type="file" class="form-control" name="logo" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Banner Toko</label>
                                <input type="file" class="form-control" name="banner" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG. Maksimal 5MB</small>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Alamat Toko <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address" rows="2" required
                                      placeholder="Jl. Contoh No. 123, Kota">{{ old('address') }}</textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" name="phone" 
                                       value="{{ old('phone') }}" required
                                       placeholder="081234567890">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Toko</label>
                                <input type="email" class="form-control" name="email" 
                                       value="{{ old('email') }}"
                                       placeholder="toko@example.com">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="border-bottom pb-2 mb-3">Informasi Rekening Bank</h6>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Bank <span class="text-danger">*</span></label>
                                <select class="form-select" name="bank_name" required>
                                    <option value="" selected disabled>Pilih Bank</option>
                                    <option value="BCA" {{ old('bank_name') == 'BCA' ? 'selected' : '' }}>BCA</option>
                                    <option value="BNI" {{ old('bank_name') == 'BNI' ? 'selected' : '' }}>BNI</option>
                                    <option value="BRI" {{ old('bank_name') == 'BRI' ? 'selected' : '' }}>BRI</option>
                                    <option value="Mandiri" {{ old('bank_name') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                                    <option value="BSI" {{ old('bank_name') == 'BSI' ? 'selected' : '' }}>BSI</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Rekening <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="account_number" 
                                       value="{{ old('account_number') }}" required
                                       placeholder="1234567890">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Pemilik Rekening <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="account_holder_name" 
                                   value="{{ old('account_holder_name', auth()->user()->name) }}" required
                                   placeholder="Nama sesuai rekening">
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <div class="d-flex">
                            <i class="bi bi-info-circle-fill fs-5 me-3"></i>
                            <div>
                                <h6 class="mb-1">Informasi Pendaftaran</h6>
                                <ul class="mb-0">
                                    <li>Toko Anda akan diverifikasi oleh admin dalam 1-2 hari kerja</li>
                                    <li>Setelah diverifikasi, Anda dapat mulai menjual produk</li>
                                    <li>Pastikan informasi yang Anda berikan benar dan valid</li>
                                    <li>Anda akan menerima notifikasi via email saat toko sudah aktif</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg py-3">
                            <i class="bi bi-check-circle"></i> Daftarkan Toko
                        </button>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection