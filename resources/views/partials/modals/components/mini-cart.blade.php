<!-- resources/views/partials/components/mini-cart.blade.php -->
<div class="card">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">
            <i class="bi bi-cart"></i> Keranjang Belanja
            @if($cartItems->count() > 0)
                <span class="badge bg-light text-dark ms-2">{{ $cartItems->count() }}</span>
            @endif
        </h5>
    </div>
    <div class="card-body">
        @if($cartItems->count() > 0)
            <div class="mb-3" style="max-height: 300px; overflow-y: auto;">
                @foreach($cartItems as $item)
                <div class="cart-item mb-2 pb-2 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                        <div style="width: 70%;">
                            <small class="fw-bold">{{ Str::limit($item->product->name, 30) }}</small>
                            <br>
                            <small class="text-muted">
                                {{ $item->quantity }} x Rp {{ number_format($item->product->price) }}
                            </small>
                        </div>
                        <div class="text-end" style="width: 30%;">
                            <small class="fw-bold">Rp {{ number_format($item->quantity * $item->product->price) }}</small>
                            <br>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger p-0" 
                                        style="width: 20px; height: 20px; font-size: 10px;">
                                    <i class="bi bi-x"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mb-3">
                <div class="d-flex justify-content-between mb-1">
                    <small>Subtotal</small>
                    <small class="fw-bold">Rp {{ number_format($cartTotal) }}</small>
                </div>
                <div class="d-flex justify-content-between">
                    <small>Ongkir (estimasi)</small>
                    <small class="fw-bold">Rp 15.000</small>
                </div>
                <hr class="my-2">
                <div class="d-flex justify-content-between">
                    <strong>Total</strong>
                    <strong class="text-success">Rp {{ number_format($cartTotal + 15000) }}</strong>
                </div>
            </div>
            
            <div class="d-grid gap-2">
                <a href="{{ route('cart.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-cart"></i> Lihat Keranjang
                </a>
                <a href="{{ route('checkout') }}" class="btn btn-success">
                    <i class="bi bi-credit-card"></i> Checkout
                </a>
            </div>
        @else
            <div class="text-center py-4">
                <i class="bi bi-cart display-4 text-muted"></i>
                <p class="mt-3 text-muted mb-0">Keranjang belanja kosong</p>
                <a href="{{ route('home') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-bag"></i> Mulai Belanja
                </a>
            </div>
        @endif
    </div>
</div>