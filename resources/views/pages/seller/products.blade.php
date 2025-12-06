@extends('layouts.app')

@section('title', 'Manajemen Produk')

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-box-seam"></i> Manajemen Produk</h5>
                <a href="{{ route('seller.products.create') }}" class="btn btn-light">
                    <i class="bi bi-plus-circle"></i> Tambah Produk
                </a>
            </div>

            <div class="card-body">

                {{-- Alerts --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif


                {{-- FILTER --}}
                <div class="card mb-4">
                    <div class="card-body">

                        <form action="{{ route('seller.products.index') }}" method="GET" class="row g-3">

                            <div class="col-md-4">
                                <label class="form-label">Cari Produk</label>
                                <input type="text" class="form-control" name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Nama produk...">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Kategori</label>
                                <select class="form-select" name="category">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" 
                                            {{ request('category') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="">Semua</option>
                                    <option value="active" {{ request('status')=='active' ? 'selected':'' }}>Aktif</option>
                                    <option value="inactive" {{ request('status')=='inactive' ? 'selected':'' }}>Nonaktif</option>
                                    <option value="out_of_stock" {{ request('status')=='out_of_stock' ? 'selected':'' }}>Habis</option>
                                </select>
                            </div>

                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">Filter</button>
                            </div>

                        </form>

                    </div>
                </div>


                {{-- PRODUCT LIST --}}
                @if($products->count() > 0)

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Terjual</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                        @foreach($products as $product)
                        <tr>

                            {{-- Gambar --}}
                            <td>
                                @if($product->images->count() > 0)
                                    <img src="{{ asset('storage/' . $product->images->first()->image) }}"
                                         class="rounded"
                                         style="width:50px;height:50px;object-fit:cover;">
                                @else
                                    <div style="width:50px;height:50px;background:#f8f9fa;border-radius:5px;display:flex;justify-content:center;align-items:center;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>

                            {{-- Nama + SKU --}}
                            <td>
                                <strong>{{ Str::limit($product->name, 30) }}</strong><br>
                                <small class="text-muted">SKU: {{ $product->sku ?? '-' }}</small>
                            </td>

                            {{-- Kategori --}}
                            <td>{{ $product->category->name ?? '-' }}</td>

                            {{-- Harga --}}
                            <td>Rp {{ number_format($product->price) }}</td>

                            {{-- Stok --}}
                            <td>
                                @if($product->stock > 10)
                                    <span class="badge bg-success">{{ $product->stock }}</span>
                                @elseif($product->stock > 0)
                                    <span class="badge bg-warning">{{ $product->stock }}</span>
                                @else
                                    <span class="badge bg-danger">Habis</span>
                                @endif
                            </td>

                            {{-- Status Produk --}}
                            <td>
                                @if($product->stock > 0)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>

                            {{-- Terjual --}}
                            <td>{{ $product->sold_count ?? 0 }}</td>

                            {{-- ACTION --}}
                            <td>
                                <div class="btn-group btn-group-sm">

                                    <a href="{{ route('products.show', $product->slug) }}"
                                       class="btn btn-outline-primary" target="_blank">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('seller.products.edit', $product->id) }}"
                                       class="btn btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('seller.products.destroy', $product->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger">
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

                <div class="mt-3">{{ $products->links() }}</div>

                @else

                {{-- EMPTY STATE --}}
                <div class="text-center py-5">
                    <i class="bi bi-box display-4 text-muted"></i>
                    <h4 class="mt-3 text-muted">Belum ada produk</h4>
                    <p class="mb-0">Mulai tambahkan produk pertama Anda.</p>

                    <a href="{{ route('seller.products.create') }}" class="btn btn-primary mt-3">
                        <i class="bi bi-plus-circle"></i> Tambah Produk
                    </a>
                </div>

                @endif

            </div>
        </div>

    </div>
</div>
@endsection
