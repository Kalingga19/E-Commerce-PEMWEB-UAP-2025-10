<!-- resources/views/pages/seller/orders.blade.php -->
@extends('layouts.app')

@section('title', 'Manajemen Pesanan - Laravel E-Commerce')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-cart-check"></i> Manajemen Pesanan</h5>
            </div>
            <div class="card-body">
                <!-- Filter Pesanan -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('seller.orders.index') }}" method="GET" class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Status Pesanan</label>
                                <select class="form-select" name="status">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Diproses</option>
                                    <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label">Status Pembayaran</label>
                                <select class="form-select" name="payment_status">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Lunas</option>
                                    <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Gagal</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" name="start_date" 
                                       value="{{ request('start_date') }}">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label">Tanggal Akhir</label>
                                <input type="date" class="form-control" name="end_date" 
                                       value="{{ request('end_date') }}">
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('seller.orders.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Statistik Pesanan -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center py-3">
                                <h6 class="card-subtitle mb-1">Menunggu</h6>
                                <h4 class="card-title">{{ $stats['pending'] }}</h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center py-3">
                                <h6 class="card-subtitle mb-1">Diproses</h6>
                                <h4 class="card-title">{{ $stats['processing'] }}</h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body text-center py-3">
                                <h6 class="card-subtitle mb-1">Dikirim</h6>
                                <h4 class="card-title">{{ $stats['shipped'] }}</h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center py-3">
                                <h6 class="card-subtitle mb-1">Selesai</h6>
                                <h4 class="card-title">{{ $stats['completed'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Daftar Pesanan -->
                @if($orders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Produk</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>
                                    @foreach($order->details as $detail)
                                    <div class="mb-1">
                                        <small>{{ $detail->product->name }} ({{ $detail->quantity }})</small>
                                    </div>
                                    @endforeach
                                </td>
                                <td>Rp {{ number_format($order->total_amount) }}</td>
                                <td>
                                    @if($order->status === 'pending')
                                        <span class="badge bg-warning">Menunggu</span>
                                    @elseif($order->status === 'processing')
                                        <span class="badge bg-info">Diproses</span>
                                    @elseif($order->status === 'shipped')
                                        <span class="badge bg-primary">Dikirim</span>
                                    @elseif($order->status === 'completed')
                                        <span class="badge bg-success">Selesai</span>
                                    @else
                                        <span class="badge bg-danger">Dibatalkan</span>
                                    @endif
                                </td>
                                <td>
                                    @if($order->payment_status === 'paid')
                                        <span class="badge bg-success">Lunas</span>
                                    @elseif($order->payment_status === 'pending')
                                        <span class="badge bg-warning">Menunggu</span>
                                    @else
                                        <span class="badge bg-danger">Gagal</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-outline-info" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#orderModal{{ $order->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        
                                        @if($order->status === 'pending' && $order->payment_status === 'paid')
                                        <form action="{{ route('seller.orders.update', $order->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="processing">
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-check"></i> Proses
                                            </button>
                                        </form>
                                        @endif
                                        
                                        @if($order->status === 'processing')
                                        <button type="button" class="btn btn-outline-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#shippingModal{{ $order->id }}">
                                            <i class="bi bi-truck"></i> Kirim
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Modal Detail Pesanan -->
                            <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Detail Pesanan #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <h6>Informasi Pelanggan</h6>
                                                    <p><strong>Nama:</strong> {{ $order->user->name }}</p>
                                                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                                                    <p><strong>Telepon:</strong> {{ $order->phone }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Informasi Pengiriman</h6>
                                                    <p><strong>Alamat:</strong> {{ $order->shipping_address }}</p>
                                                    <p><strong>Kota:</strong> {{ $order->city }}</p>
                                                    <p><strong>Kode Pos:</strong> {{ $order->postal_code }}</p>
                                                </div>
                                            </div>
                                            
                                            <hr>
                                            
                                            <h6>Detail Produk</h6>
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
                                                    @foreach($order->details as $detail)
                                                    <tr>
                                                        <td>{{ $detail->product->name }}</td>
                                                        <td>Rp {{ number_format($detail->price) }}</td>
                                                        <td>{{ $detail->quantity }}</td>
                                                        <td>Rp {{ number_format($detail->price * $detail->quantity) }}</td>
                                                    </tr>
                                                    @endforeach
                                                    <tr class="table-light">
                                                        <td colspan="3" class="text-end"><strong>Subtotal</strong></td>
                                                        <td><strong>Rp {{ number_format($order->details->sum(function($detail) { return $detail->price * $detail->quantity; })) }}</strong></td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td colspan="3" class="text-end"><strong>Ongkir</strong></td>
                                                        <td><strong>Rp {{ number_format($order->shipping_cost) }}</strong></td>
                                                    </tr>
                                                    <tr class="table-primary">
                                                        <td colspan="3" class="text-end"><strong>Total</strong></td>
                                                        <td><strong>Rp {{ number_format($order->total_amount) }}</strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Modal Pengiriman -->
                            @if($order->status === 'processing')
                            <div class="modal fade" id="shippingModal{{ $order->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-warning text-white">
                                            <h5 class="modal-title">Update Pengiriman</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('seller.orders.update', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="shipped">
                                                
                                                <div class="mb-3">
                                                    <label class="form-label">Kurir</label>
                                                    <select class="form-select" name="courier" required>
                                                        <option value="">Pilih Kurir</option>
                                                        <option value="jne">JNE</option>
                                                        <option value="tiki">TIKI</option>
                                                        <option value="pos">POS Indonesia</option>
                                                        <option value="sicepat">SiCepat</option>
                                                        <option value="jnt">J&T Express</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label class="form-label">Nomor Resi</label>
                                                    <input type="text" class="form-control" name="tracking_number" required 
                                                           placeholder="Contoh: 123456789012">
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
                </div>
                
                <div class="mt-3">
                    {{ $orders->links() }}
                </div>
                @else
                <div class="text-center py-5">
                    <i class="bi bi-cart-x display-4 text-muted"></i>
                    <h4 class="mt-3 text-muted">Belum ada pesanan</h4>
                    <p class="mb-0">Belum ada pesanan yang masuk ke toko Anda.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection