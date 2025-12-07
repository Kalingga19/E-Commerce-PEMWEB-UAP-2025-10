<x-app-layout>

<h2 class="text-xl font-bold mb-4">Detail Pesanan</h2>

<div class="bg-white p-4 rounded shadow">

    <p><strong>Kode Transaksi:</strong> {{ $order->code }}</p>
    <p><strong>Status:</strong> {{ $order->payment_status }}</p>

    <h3 class="font-semibold mt-4">Produk Dipesan:</h3>
    <ul class="ml-4">
        @foreach($order->transactionDetails as $item)
            <li>{{ $item->product->name }} (x{{ $item->qty }})</li>
        @endforeach
    </ul>

    <form method="POST" action="{{ route('seller.orders.update', $order) }}">
        @csrf
        @method('PUT')

        <label class="block mt-4">Tracking Number:</label>
        <input type="text" name="tracking_number" 
            class="border p-2 w-full mb-3" 
            value="{{ $order->tracking_number }}">

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Update Order
        </button>
    </form>

</div>
</x-app-layout>