<!-- resources/views/pages/payment/payment-page.blade.php -->
@extends('layouts.app')

@section('title', 'Pembayaran Virtual Account - Laravel E-Commerce')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-credit-card"></i> Pembayaran Virtual Account</h5>
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
                
                @if($payment)
                <div class="text-center mb-4">
                    <div class="display-6 mb-2">
                        @if($payment->type === 'transaction')
                            <i class="bi bi-cart-check text-primary"></i>
                        @else
                            <i class="bi bi-wallet2 text-success"></i>
                        @endif
                    </div>
                    <h3>Virtual Account Payment</h3>
                </div>
                
                <!-- Informasi Pembayaran -->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0">Detail Pembayaran</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <th width="150">Kode VA</th>
                                        <td>
                                            <div class="va-code bg-light p-2 rounded">
                                                <strong>{{ $payment->va_number }}</strong>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Bank</th>
                                        <td>
                                            @if(strpos($payment->bank_code, 'bca') !== false)
                                                <span class="badge bg-primary">BCA</span>
                                            @elseif(strpos($payment->bank_code, 'bni') !== false)
                                                <span class="badge bg-warning">BNI</span>
                                            @elseif(strpos($payment->bank_code, 'mandiri') !== false)
                                                <span class="badge bg-danger">Mandiri</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $payment->bank_code }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if($payment->status === 'paid')
                                                <span class="badge bg-success">Lunas</span>
                                            @elseif($payment->status === 'pending')
                                                <span class="badge bg-warning">Menunggu</span>
                                            @else
                                                <span class="badge bg-danger">Kadaluarsa</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <th width="150">Jumlah</th>
                                        <td class="fs-4 text-success">
                                            <strong>Rp {{ number_format($payment->amount) }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Buat</th>
                                        <td>{{ $payment->created_at->format('d F Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Batas Waktu</th>
                                        <td>
                                            @if($payment->expired_at)
                                                {{ $payment->expired_at->format('d F Y H:i') }}
                                                @if($payment->expired_at->isPast())
                                                    <br>
                                                    <span class="text-danger">(Kadaluarsa)</span>
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Detail Transaksi/Topup -->
                @if($payment->type === 'transaction')
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h6 class="mb-0">Detail Transaksi</h6>
                        </div>
                        <div class="card-body">
                            @if($payment->transaction)
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Produk yang Dibeli</h6>
                                    <ul class="list-unstyled">
                                        @foreach($payment->transaction->details as $detail)
                                        <li class="mb-2">
                                            {{ $detail->product->name }} 
                                            <span class="text-muted">({{ $detail->quantity }}x)</span>
                                            <br>
                                            <small>Rp {{ number_format($detail->price) }}</small>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>Informasi Pengiriman</h6>
                                    <p class="mb-1"><strong>Penerima:</strong> {{ $payment->transaction->receiver_name }}</p>
                                    <p class="mb-1"><strong>Alamat:</strong> {{ $payment->transaction->shipping_address }}</p>
                                    <p class="mb-1"><strong>Telepon:</strong> {{ $payment->transaction->phone }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="card mb-4">
                        <div class="card-header bg-warning text-white">
                            <h6 class="mb-0">Detail Topup</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <i class="bi bi-wallet2 display-4 text-warning mb-3"></i>
                                <h5>Topup Saldo</h5>
                                <p class="mb-0">Pembayaran ini untuk topup saldo pengguna.</p>
                            </div>
                        </div>
                    </div>
                @endif
                
                <!-- Instruksi Pembayaran -->
                <div class="card mb-4">
                    <div class="card-header bg-dark text-white">
                        <h6 class="mb-0">Instruksi Pembayaran</h6>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <h6><i class="bi bi-info-circle"></i> Cara Pembayaran:</h6>
                            <ol class="mb-0">
                                <li>Buka aplikasi mobile banking atau internet banking bank Anda</li>
                                <li>Pilih menu <strong>Transfer</strong> atau <strong>Bayar</strong></li>
                                <li>Masukkan nomor Virtual Account: <strong>{{ $payment->va_number }}</strong></li>
                                <li>Masukkan jumlah yang harus dibayar: <strong>Rp {{ number_format($payment->amount) }}</strong></li>
                                <li>Konfirmasi dan selesaikan pembayaran</li>
                                <li>Status akan otomatis berubah menjadi "Lunas" setelah pembayaran berhasil</li>
                            </ol>
                        </div>
                        
                        <!-- Tombol Simulasi Pembayaran (untuk testing) -->
                        @if($payment->status === 'pending' && $payment->expired_at && !$payment->expired_at->isPast())
                        <div class="text-center mt-4">
                            <form action="{{ route('payment.simulate') }}" method="POST">
                                @csrf
                                <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="bi bi-check-circle"></i> Simulasi Pembayaran Berhasil
                                </button>
                                <small class="d-block text-muted mt-2">
                                    *Tombol ini hanya untuk testing/demo
                                </small>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Tombol Navigasi -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-house"></i> Kembali ke Beranda
                    </a>
                    
                    @if($payment->type === 'transaction')
                        <a href="{{ route('history') }}" class="btn btn-outline-primary">
                            <i class="bi bi-clock-history"></i> Lihat Riwayat
                        </a>
                    @else
                        <a href="{{ route('wallet.topup') }}" class="btn btn-outline-success">
                            <i class="bi bi-wallet2"></i> Topup Lagi
                        </a>
                    @endif
                </div>
                
                @else
                <!-- Form Input Kode VA -->
                <div class="text-center py-5">
                    <i class="bi bi-credit-card-2-front display-4 text-muted"></i>
                    <h3 class="mt-3 text-muted">Masukkan Kode Virtual Account</h3>
                    <p class="mb-4">Silakan masukkan kode Virtual Account yang Anda dapatkan</p>
                    
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <form action="{{ route('payment.verify') }}" method="POST">
                                @csrf
                                <div class="input-group input-group-lg mb-3">
                                    <span class="input-group-text">
                                        <i class="bi bi-key"></i>
                                    </span>
                                    <input type="text" class="form-control" name="va_code" 
                                           placeholder="Contoh: 8888801234567890" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="bi bi-search"></i> Cari Pembayaran
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <p class="text-muted">
                            <i class="bi bi-info-circle"></i>
                            Kode Virtual Account biasanya dikirimkan via email atau WhatsApp
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection