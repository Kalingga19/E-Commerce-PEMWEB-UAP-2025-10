<!-- resources/views/partials/components/product-card.blade.php -->
<div class="col-md-4 col-lg-3 mb-4">
    <div class="card product-card h-100">
        @if($product->images->count() > 0)
            <img src="{{ asset('storage/' . $product->images->first()->path) }}" 
                 class="card-img-top product-img" 
                 alt="{{ $product->name }}"
                 style="height: 200px; object-fit: cover;">
        @else
            <div class="product-img bg-light d-flex align-items-center justify-content-center">
                <i class="bi bi-image text-muted fs-1"></i>
            </div>
        @endif
        
        <div class="card-body d-flex flex-column">
            <h6 class="card-title">{{ Str::limit($product->name, 50) }}</h6>
            <p class="product-price mt-auto mb-2">Rp {{ number_format($product->price) }}</p>
            
            <p class="product-store small text-muted mb-2">
                <i class="bi bi-shop"></i> {{ $product->store->name }}
            </p>
            
            <div class="d-flex justify-content-between align-items-center mt-2">
                <span class="badge bg-info">{{ $product->category->name }}</span>
                
                @if($product->stock > 0)
                    <span class="badge bg-success">Stok: {{ $product->stock }}</span>
                @else
                    <span class="badge bg-danger">Habis</span>
                @endif
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-3">
                <a href="{{ route('product.show', $product->slug) }}" 
                   class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-eye"></i> Detail
                </a>
                
                @auth
                    @if(auth()->user()->role === 'member' && $product->stock > 0)
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="bi bi-cart-plus"></i> Beli
                        </button>
                    </form>
                    @endif
                @else
                    <button type="button" class="btn btn-sm btn-success" 
                            data-bs-toggle="modal" data-bs-target="#loginModal">
                        <i class="bi bi-cart-plus"></i> Beli
                    </button>
                @endauth
            </div>
        </div>
    </div>
</div>