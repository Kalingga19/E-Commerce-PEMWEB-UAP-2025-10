<!-- resources/views/partials/components/order-list.blade.php -->
@foreach($orders as $order)
<div class="card mb-3">
    <div class="card-body">
        <div class="row align-items-center">
            <!-- Order Info -->
            <div class="col-md-8">
                <div class="d-flex align-items-start">
                    <div class="me-3">
                        <div class="bg-light rounded p-2">
                            <i class="bi bi-bag-check fs-4"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="mb-1">
                            Pesanan #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                        </h6>
                        <p class="text-muted mb-1 small">
                            {{ $order->created_at->format('d F Y H:i') }}
                        </p>
                        <p class="mb-0 small">
                            @foreach($order->details as $detail)
                            <span class="badge bg-light text-dark me-1">
                                {{ $detail->product->name }} ({{ $detail->quantity }})
                            </span>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Status & Actions -->
            <div class="col-md-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-end">
                        <p class="mb-1 fw-bold">Rp {{ number_format($order->total_amount) }}</p>
                        <div class="mb-2">
                            @if($order->payment_status === 'paid')
                                <span class="badge bg-success">Lunas</span>
                            @elseif($order->payment_status === 'pending')
                                <span class="badge bg-warning">Menunggu</span>
                            @else
                                <span class="badge bg-danger">Gagal</span>
                            @endif
                            
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
                        </div>
                    </div>
                    <div class="ms-3">
                        <a href="{{ route('customer.orders.detail', $order->id) }}" 
                           class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@if($orders->count() > 5)
<div class="mt-3">
    {{ $orders->links() }}
</div>
@endif