<x-app-layout>
<div class="container mt-4">

    <h2 class="mb-3">Manajemen Transaksi</h2>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Buyer</th>
                <th>Seller</th>
                <th>Produk</th>
                <th>Total</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($transactions as $tx)
                <tr>
                    <td>{{ $tx->id }}</td>
                    <td>{{ $tx->buyer->name ?? '-' }}</td>
                    <td>{{ $tx->store->name ?? '-' }}</td>
                    <td>{{ $tx->product->name ?? '-' }}</td>
                    <td>Rp {{ number_format($tx->grand_total, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge bg-primary">{{ ucfirst($tx->payment_status) }}</span>
                    </td>
                    <td>
                        <a href="{{ route('admin.transactions.show', $tx->id) }}" class="btn btn-sm btn-info">
                            Detail
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    {{ $transactions->links() }}

</div>
</x-app-layout>
