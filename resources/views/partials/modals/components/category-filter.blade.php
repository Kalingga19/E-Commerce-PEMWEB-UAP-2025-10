<!-- resources/views/partials/components/category-filter.blade.php -->
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">
            <i class="bi bi-filter"></i> Filter Kategori
        </h5>
    </div>
    <div class="card-body">
        <form action="{{ route('products.index') }}" method="GET">
            <!-- Search -->
            <div class="mb-3">
                <label class="form-label">Cari Produk</label>
                <input type="text" class="form-control" name="search" 
                       value="{{ request('search') }}" placeholder="Nama produk...">
            </div>
            
            <!-- Price Range -->
            <div class="mb-3">
                <label class="form-label">Rentang Harga</label>
                <div class="row g-2">
                    <div class="col">
                        <input type="number" class="form-control" name="min_price" 
                               value="{{ request('min_price') }}" placeholder="Min">
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" name="max_price" 
                               value="{{ request('max_price') }}" placeholder="Max">
                    </div>
                </div>
            </div>
            
            <!-- Categories -->
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                @foreach($categories as $category)
                <div class="form-check mb-2">
                    <input class="form-check-input category-filter" 
                           type="checkbox" 
                           name="categories[]" 
                           value="{{ $category->id }}"
                           id="cat-{{ $category->id }}"
                           {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="cat-{{ $category->id }}">
                        {{ $category->name }}
                    </label>
                </div>
                @endforeach
            </div>
            
            <!-- Sort -->
            <div class="mb-3">
                <label class="form-label">Urutkan</label>
                <select class="form-select" name="sort">
                    <option value="">Default</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terlaris</option>
                </select>
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-funnel"></i> Terapkan Filter
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle"></i> Reset Filter
                </a>
            </div>
        </form>
    </div>
</div>