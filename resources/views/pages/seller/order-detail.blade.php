@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-receipt"></i> Detail Pesanan #{{ $order->id }}
                </h5>
            </div>

            <div class="card-body">

                {{-- STATUS PESANAN --}}
                <div class="mb-4">
                    <h6>Status Pesanan:</h6>

                    @if($order->order_status === 'pending')
                        <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
                    @elseif($order->order_status === 'processing')
                        <span class="badge bg-info">Diproses</span>
                    @elseif($order->order_status === 'shipped')
                        <span class="badge bg-primary">Dikirim</span>
                    @elseif($order->order_status === 'completed')
                        <span class="badge bg-success">Selesai</span>
                    @else
                        <span class="badge bg-danger">Dibatalkan</span>
                    @endif
                </div>

                {{-- INFORMASI PEMBELI --}}
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <strong>Informasi Pembeli</strong>
                    </div>
                    <div class="card-body">

                        <p><strong>Nama:</strong> {{ $order->buyer->name }}</p>
                        <p><strong>Email:</strong> {{ $order->buyer->email }}</p>

                        <p><strong>Telepon:</strong> {{ $order->phone }}</p>

                        <p>
                            <strong>Alamat:</strong><br>
                            {{ $order->address }}<br>
                            {{ $order->city }}, {{ $order->postal_code }}
                        </p>

                    </div>
                </div>

                {{-- DETAIL PRODUK --}}
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <strong>Produk Dipesan</strong>
                    </div>

                    <div class="card-body">

                        <table class="table table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Harga Satuan</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($order->details as $detail)
                                <tr>
                                    <td>
                                        {{ $detail->product->name }}
                                    </td>
                                    <td>{{ $detail->qty }}</td>
                                    <td>Rp {{ number_format($detail->product->price) }}</td>
                                    <td>Rp {{ number_format($detail->subtotal) }}</td>
                                </tr>
                                @endforeach

                                <tr class="table-light">
                                    <td colspan="3" class="text-end"><strong>Ongkir</strong></td>
                                    <td>Rp {{ number_format($order->shipping_cost) }}</td>
                                </tr>

                                <tr class="table-primary">
                                    <td colspan="3" class="text-end"><strong>Total</strong></td>
                                    <td><strong>Rp {{ number_format($order->grand_total) }}</strong></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>

                {{-- INFORMASI PENGIRIMAN (JIKA ADA) --}}
                @if($order->order_status === 'shipped' || $order->order_status === 'completed')
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <strong>Informasi Pengiriman</strong>
                    </div>
                    <div class="card-body">
                        <p><strong>Kurir:</strong> {{ $order->shipping }}</p>
                        <p><strong>Nomor Resi:</strong> {{ $order->tracking_number }}</p>
                    </div>
                </div>
                @endif

                {{-- TOMBOL AKSI --}}
                <div class="d-flex justify-content-between">

                    <a href="{{ route('seller.orders.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    {{-- Tombol "Pesanan Dikirim" --}}
                    @if($order->order_status === 'processing')
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#shipModal">
                        <i class="bi bi-truck"></i> Kirim Pesanan
                    </button>
                    @endif

                </div>

            </div>
        </div>

    </div>
</div>


{{-- MODAL PENGIRIMAN --}}
@if($order->order_status === 'processing')
<div class="modal fade" id="shipModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Konfirmasi Pengiriman</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <form action="{{ route('seller.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="order_status" value="shipped">

                    <div class="mb-3">
                        <label class="form-label">Kurir</label>
                        <select name="courier" class="form-select" required>
                            <option value="">Pilih kurir</option>
                            <option value="JNE">JNE</option>
                            <option value="TIKI">TIKI</option>
                            <option value="POS">POS Indonesia</option>
                            <option value="SICEPAT">SiCepat</option>
                            <option value="JNT">J&T Express</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Resi</label>
                        <input type="text" name="tracking_number" class="form-control" required>
                    </div>

                    <button class="btn btn-success w-100">
                        <i class="bi bi-check-circle"></i> Konfirmasi Pengiriman
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>
@endif

@endsection
