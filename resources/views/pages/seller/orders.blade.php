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
                                <h4>{{ $stats['waiting'] }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center py-3">
                                <h6>Diproses</h6>
                                <h4>{{ $stats['processed'] }}</h4>
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
                                <th>Status</th>
                                <th>Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                            <td>{{ $order->user->name }}</td>

                            <td>
                                @foreach($order->details as $d)
                                    <small>{{ $d->product->name }} ({{ $d->qty }})</small><br>
                                @endforeach
                            </td>

                            <td>Rp {{ number_format($order->total_price) }}</td>

                            <td>{{ ucfirst($order->status) }}</td>

                            <td>
                                <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('seller.orders.show', $order->id) }}"
                                   class="btn btn-sm btn-primary">
                                   <i class="bi bi-eye"></i>
                                </a>

                                {{-- Update status --}}
                                @if($order->payment_status == 'paid')
                                <form action="{{ route('seller.orders.updateStatus', $order->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="processed">

                                    <button class="btn btn-sm btn-success">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                </form>
                                @endif

                            </td>
                        </tr>
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
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>
@endsection
