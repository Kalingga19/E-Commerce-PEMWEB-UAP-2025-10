@extends('layouts.app')

@section('title', 'Profil Toko')

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

                <form action="{{ route('seller.profile.update') }}" 
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- ALERTS --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
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

                        {{-- LOGO TOKO --}}
                        <div class="col-md-4 text-center mb-4">

                            @if($store->logo)
                                <img src="{{ asset('storage/' . $store->logo) }}"
                                     id="logo-preview"
                                     class="img-fluid rounded-circle border"
                                     style="width:200px;height:200px;object-fit:cover;">
                            @else
                                <div id="logo-preview"
                                     class="rounded-circle border bg-light d-flex align-items-center justify-content-center"
                                     style="width:200px;height:200px;">
                                    <i class="bi bi-shop fs-1 text-muted"></i>
                                </div>
                            @endif

                            <div class="mt-3">
                                <label class="form-label">Ganti Logo Toko</label>
                                <input type="file" name="logo" class="form-control"
                                       accept="image/*"
                                       onchange="previewImage(this, 'logo-preview')">
                                <small class="text-muted">JPG/PNG maks 2MB</small>
                            </div>
                        </div>


                        {{-- DATA TOKO --}}
                        <div class="col-md-8">

                            {{-- NAMA TOKO --}}
                            <div class="mb-3">
                                <label class="form-label">Nama Toko <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" 
                                       name="name"
                                       value="{{ old('name', $store->name) }}"
                                       required>
                            </div>

                            {{-- ABOUT TOKO --}}
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Toko</label>
                                <textarea class="form-control" name="about" rows="3">{{ old('about', $store->about) }}</textarea>
                                <small class="text-muted">Maksimal 500 karakter</small>
                            </div>

                            {{-- ADDRESS --}}
                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" rows="2" required>{{ old('address', $store->address) }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kota <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"
                                           name="city"
                                           value="{{ old('city', $store->city) }}"
                                           required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kode Pos <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"
                                           name="postal_code"
                                           value="{{ old('postal_code', $store->postal_code) }}"
                                           required>
                                </div>
                            </div>

                            {{-- PHONE --}}
                            <div class="mb-3">
                                <label class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control"
                                       name="phone"
                                       value="{{ old('phone', $store->phone) }}"
                                       required>
                            </div>

                        </div>
                    </div>

                    <hr class="my-4">

                    {{-- BANK INFO --}}
                    <h5 class="mb-3">Informasi Rekening Bank</h5>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Bank <span class="text-danger">*</span></label>
                            <select name="bank_name" class="form-select" required>
                                <option value="" disabled>Pilih Bank</option>
                                @foreach(['BCA','BNI','BRI','Mandiri','BSI'] as $bank)
                                    <option value="{{ $bank }}"
                                        {{ old('bank_name', $store->bank_name) == $bank ? 'selected' : '' }}>
                                        {{ $bank }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nomor Rekening <span class="text-danger">*</span></label>
                            <input type="text" name="bank_account_number" class="form-control"
                                   value="{{ old('bank_account_number', $store->bank_account_number) }}"
                                   required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Nama Pemilik Rekening <span class="text-danger">*</span></label>
                        <input type="text" name="bank_account_name" class="form-control"
                               value="{{ old('bank_account_name', $store->bank_account_name) }}"
                               required>
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

{{-- PREVIEW IMAGE SCRIPT --}}
<script>
function previewImage(input, previewId) {
    const file = input.files[0];
    if (file) {
        document.getElementById(previewId).src = URL.createObjectURL(file);
    }
}
</script>

@endsection
