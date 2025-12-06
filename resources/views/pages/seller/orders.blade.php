@extends('layouts.app')

@section('title', 'Manajemen Pesanan')

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-cart-check"></i> Manajemen Pesanan</h5>
            </div>

            <div class="card-body">

                {{-- Statistik Pesanan --}}
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center py-3">
                                <h6>Menunggu</h6>
                                <h4>{{ $stats['pending'] }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center py-3">
                                <h6>Diproses</h6>
                                <h4>{{ $stats['processing'] }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body text-center py-3">
                                <h6>Dikirim</h6>
                                <h4>{{ $stats['shipped'] }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center py-3">
                                <h6>Selesai</h6>
                                <h4>{{ $stats['completed'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Daftar Pesanan --}}
                @if($orders->count() > 0)

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Pembeli</th>
                                <th>Produk</th>
                                <th>Total</th>
                                <th>Status Pesanan</th>
                                <th>Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>

                            <td>{{ $order->created_at->format('d/m/Y') }}</td>

                            <td>{{ $order->buyer->name }}</td>

                            <td>
                                @foreach($order->details as $d)
                                    <small>{{ $d->product->name }} ({{ $d->qty }})</small><br>
                                @endforeach
                            </td>

                            <td>Rp {{ number_format($order->grand_total) }}</td>

                            <td>
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
                            </td>

                            <td>
                                <span class="badge bg-{{ $order->payment_status === 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('seller.orders.show', $order->id) }}"
                                    class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye"></i>
                                </a>

                                {{-- PROSES PESANAN --}}
                                @if($order->payment_status === 'paid' && $order->order_status === 'pending')
                                <form action="{{ route('seller.orders.updateStatus', $order->id) }}" 
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="order_status" value="processing">
                                    <button type="submit" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-gear"></i> Proses
                                    </button>
                                </form>
                                @endif

                                {{-- KIRIM PESANAN --}}
                                @if($order->order_status === 'processing')
                                <button class="btn btn-outline-warning btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#shipModal{{ $order->id }}">
                                    <i class="bi bi-truck"></i> Kirim
                                </button>
                                @endif

                            </td>

                            @if($order->status === 'processing')
                            <button class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#shipModal{{ $order->id }}">
                                <i class="bi bi-truck"></i> Kirim
                            </button>
                            @endif

                        </tr>

                        {{-- MODAL PENGIRIMAN --}}
                        @if($order->order_status === 'processing')
                        <div class="modal fade" id="shipModal{{ $order->id }}" tabindex="-1">
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
                                                <select class="form-select" name="courier" required>
                                                    <option value="">Pilih Kurir</option>
                                                    <option value="JNE">JNE</option>
                                                    <option value="TIKI">TIKI</option>
                                                    <option value="POS">POS Indonesia</option>
                                                    <option value="SICEPAT">SiCepat</option>
                                                    <option value="JNT">J&T Express</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Nomor Resi</label>
                                                <input type="text" class="form-control" name="tracking_number" 
                                                    placeholder="123456789012" required>
                                            </div>

                                            <button type="submit" class="btn btn-success w-100">
                                                <i class="bi bi-check-circle"></i> Konfirmasi Pengiriman
                                            </button>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endif

                        @endforeach
                        </tbody>
                    </table>
                    <div class="modal fade" id="shipModal{{ $order->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('seller.orders.updateStatus', $order->id) }}" class="modal-content">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="order_status" value="shipped">

                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title">Konfirmasi Pengiriman</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <label class="form-label">Kurir</label>
                                    <select name="courier" class="form-select mb-3" required>
                                        <option value="">— Pilih Kurir —</option>
                                        <option value="jne">JNE</option>
                                        <option value="pos">POS Indonesia</option>
                                        <option value="tiki">TIKI</option>
                                        <option value="sicepat">SiCepat</option>
                                        <option value="jnt">J&T</option>
                                    </select>

                                    <label class="form-label">Nomor Resi</label>
                                    <input type="text" name="tracking_number" class="form-control" required>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-success w-100">Kirim Pesanan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    {{ $orders->links() }}
                </div>

                @else
                    <div class="text-center py-5">
                        <i class="bi bi-cart-x display-4 text-muted"></i>
                        <h4 class="mt-3 text-muted">Belum ada pesanan</h4>
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>
@endsection
