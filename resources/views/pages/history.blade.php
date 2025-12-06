<!-- resources/views/pages/history.blade.php -->
@extends('layouts.app')

@section('title', 'Riwayat Transaksi - Laravel E-Commerce')

@section('content')
<h2 class="mb-4">Riwayat Transaksi</h2>

@if($transactions->count() > 0)
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>#{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @foreach($transaction->details as $detail)
                            <div class="mb-1">
                                <small>{{ $detail->product->name }} ({{ $detail->quantity }})</small>
                            </div>
                            @endforeach
                        </td>
                        <td>Rp {{ number_format($transaction->total_amount) }}</td>
                        <td>
                            @if($transaction->payment_status === 'paid')
                                <span class="badge bg-success">Lunas</span>
                            @elseif($transaction->payment_status === 'pending')
                                <span class="badge bg-warning">Menunggu</span>
                            @else
                                <span class="badge bg-danger">Gagal</span>
                            @endif
                            
                            @if($transaction->shipping_status === 'shipped')
                                <br><span class="badge bg-info mt-1">Dikirim</span>
                            @elseif($transaction->shipping_status === 'delivered')
                                <br><span class="badge bg-success mt-1">Sampai</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" 
                                    data-bs-target="#detailModal{{ $transaction->id }}">
                                <i class="bi bi-eye"></i> Detail
                            </button>
                            
                            @if($transaction->payment_status === 'pending')
                            <a href="{{ route('payment.page', $transaction->id) }}" 
                               class="btn btn-sm btn-warning">
                                <i class="bi bi-credit-card"></i> Bayar
                            </a>
                            @endif
                        </td>
                    </tr>
                    
                    <!-- Detail Modal -->
                    <div class="modal fade" id="detailModal{{ $transaction->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Detail Transaksi #{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <h6>Informasi Pengiriman</h6>
                                            <p><strong>Nama:</strong> {{ $transaction->receiver_name }}</p>
                                            <p><strong>Alamat:</strong> {{ $transaction->shipping_address }}</p>
                                            <p><strong>Telepon:</strong> {{ $transaction->phone }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Detail Pembayaran</h6>
                                            <p><strong>Metode:</strong> 
                                                {{ $transaction->payment_method === 'wallet' ? 'Saldo' : 'Virtual Account' }}
                                            </p>
                                            <p><strong>Status:</strong> 
                                                @if($transaction->payment_status === 'paid')
                                                    <span class="badge bg-success">Lunas</span>
                                                @elseif($transaction->payment_status === 'pending')
                                                    <span class="badge bg-warning">Menunggu</span>
                                                @else
                                                    <span class="badge bg-danger">Gagal</span>
                                                @endif
                                            </p>
                                            <p><strong>Total:</strong> Rp {{ number_format($transaction->total_amount) }}</p>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    
                                    <h6>Produk yang Dibeli</h6>
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Produk</th>
                                                <th>Harga</th>
                                                <th>Qty</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($transaction->details as $detail)
                                            <tr>
                                                <td>{{ $detail->product->name }}</td>
                                                <td>Rp {{ number_format($detail->price) }}</td>
                                                <td>{{ $detail->quantity }}</td>
                                                <td>Rp {{ number_format($detail->price * $detail->quantity) }}</td>
                                            </tr>
                                            @endforeach
                                            <tr class="table-light">
                                                <td colspan="3" class="text-end"><strong>Subtotal</strong></td>
                                                <td><strong>Rp {{ number_format($transaction->details->sum(function($detail) { return $detail->price * $detail->quantity; })) }}</strong></td>
                                            </tr>
                                            <tr class="table-light">
                                                <td colspan="3" class="text-end"><strong>Ongkir</strong></td>
                                                <td><strong>Rp {{ number_format($transaction->shipping_cost) }}</strong></td>
                                            </tr>
                                            <tr class="table-primary">
                                                <td colspan="3" class="text-end"><strong>Total</strong></td>
                                                <td><strong>Rp {{ number_format($transaction->total_amount) }}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@else
<div class="card">
    <div class="card-body text-center py-5">
        <i class="bi bi-clock-history display-4 text-muted"></i>
        <h4 class="mt-3 text-muted">Belum ada riwayat transaksi</h4>
        <p class="mb-0">Mulai belanja sekarang untuk melihat riwayat transaksi</p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Mulai Belanja</a>
    </div>
</div>
@endif
@endsection