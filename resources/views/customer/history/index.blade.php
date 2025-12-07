<x-app-layout>
<h2 class="text-xl font-bold mb-4">Riwayat Transaksi</h2>

@foreach($transactions as $trx)
<div class="bg-white p-4 rounded shadow mb-4">
    <h3 class="font-semibold">Kode: {{ $trx->code }}</h3>
    <p>Status: {{ $trx->payment_status }}</p>
    <p>Total: Rp {{ number_format($trx->grand_total) }}</p>

    <strong>Produk:</strong>
    <ul class="ml-4">
        @foreach($trx->transactionDetails as $item)
            <li>{{ $item->product->name }} (x{{ $item->qty }})</li>
        @endforeach
    </ul>
</div>
@endforeach
</x-app-layout>