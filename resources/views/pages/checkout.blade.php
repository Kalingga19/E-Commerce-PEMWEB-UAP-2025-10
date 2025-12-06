<!-- resources/views/pages/checkout.blade.php -->
@extends('layouts.app')

@section('title', 'Checkout - Laravel E-Commerce')

@section('content')
<h2 class="mb-4">Checkout</h2>

@if($cartItems->count() > 0)
<form action="{{ route('checkout.process') }}" method="POST">
    @csrf
    
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Informasi Pengiriman</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Penerima</label>
                        <input type="text" class="form-control" name="receiver_name" 
                               value="{{ auth()->user()->name }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control" name="address" rows="3" required 
                                  placeholder="Jl. Contoh No. 123, RT/RW, Kelurahan, Kecamatan"></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kota</label>
                            <input type="text" class="form-control" name="city" required placeholder="Jakarta">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" name="postal_code" required placeholder="12345">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="tel" class="form-control" name="phone" required placeholder="081234567890">
                    </div>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Metode Pengiriman</h5>
                </div>
                <div class="card-body">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="shipping_method" 
                               id="shipping-standard" value="standard" checked>
                        <label class="form-check-label" for="shipping-standard">
                            <strong>Standard Delivery</strong> - Rp 15.000 (3-5 hari kerja)
                        </label>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="shipping_method" 
                               id="shipping-express" value="express">
                        <label class="form-check-label" for="shipping-express">
                            <strong>Express Delivery</strong> - Rp 30.000 (1-2 hari kerja)
                        </label>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Ringkasan Pesanan</h5>
                </div>
                <div class="card-body">
                    @foreach($cartItems as $item)
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <small>{{ $item->product->name }}</small>
                            <br>
                            <small class="text-muted">{{ $item->quantity }} x Rp {{ number_format($item->product->price) }}</small>
                        </div>
                        <small>Rp {{ number_format($item->quantity * $item->product->price) }}</small>
                    </div>
                    @endforeach
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($subtotal) }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Ongkir</span>
                        <span id="shipping-cost-display">Rp 15.000</span>
                        <input type="hidden" name="shipping_cost" id="shipping-cost-input" value="15000">
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total</span>
                        <span id="total-price-display">Rp {{ number_format($subtotal + 15000) }}</span>
                        <input type="hidden" name="total_amount" id="total-amount-input" value="{{ $subtotal + 15000 }}">
                    </div>
                    
                    <div class="mt-4">
                        <h6>Metode Pembayaran</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" 
                                   id="payment-wallet" value="wallet" 
                                   {{ auth()->user()->balance >= ($subtotal + 15000) ? 'checked' : 'disabled' }}>
                            <label class="form-check-label" for="payment-wallet">
                                Saldo (Rp {{ number_format(auth()->user()->balance) }})
                                @if(auth()->user()->balance < ($subtotal + 15000))
                                    <span class="text-danger"> - Saldo tidak mencukupi</span>
                                @endif
                            </label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" 
                                   id="payment-va" value="va" 
                                   {{ auth()->user()->balance >= ($subtotal + 15000) ? '' : 'checked' }}>
                            <label class="form-check-label" for="payment-va">
                                Virtual Account
                            </label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success w-100 mt-3">
                        <i class="bi bi-credit-card"></i> Bayar Sekarang
                    </button>
                    
                    <div class="text-center mt-2">
                        <a href="{{ route('cart.index') }}" class="text-muted small">Kembali ke keranjang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@else
<div class="alert alert-warning text-center py-5">
    <i class="bi bi-cart-x display-4"></i>
    <h4 class="mt-3">Keranjang belanja kosong</h4>
    <p class="mb-0">Silakan tambah produk terlebih dahulu</p>
    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Belanja Sekarang</a>
</div>
@endif
@endsection