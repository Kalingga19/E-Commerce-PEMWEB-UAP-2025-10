<x-app-layout>
<h2 class="text-xl font-bold mb-4">Daftar Pesanan Masuk</h2>

@foreach($orders as $order)
<div class="bg-white p-4 rounded shadow mb-4">

    <h3 class="font-semibold text-lg">
        Order #{{ $order->code }}
    </h3>

    <p>Status Pembayaran: {{ $order->payment_status }}</p>
    <p>Total: Rp {{ number_format($order->grand_total) }}</p>

    <a href="{{ route('seller.orders.show', $order) }}" class="text-blue-600">Detail</a>
</div>
@endforeach
</x-app-layout>