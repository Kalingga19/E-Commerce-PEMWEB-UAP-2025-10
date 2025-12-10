<x-app-layout>
<div class="container mt-4">

    <h3>Detail Transaksi #{{ $transaction->id }}</h3>

    <div class="card mt-3">
        <div class="card-body">

            <h5>Informasi Pembeli</h5>
            <p>Nama: {{ $transaction->buyer->name }}</p>
            <p>Email: {{ $transaction->buyer->email }}</p>

            <h5 class="mt-3">Informasi Penjual</h5>
            <p>Toko: {{ $transaction->seller->store_name }}</p>
            <p>Owner: {{ $transaction->seller->owner->name ?? '-' }}</p>

            <h5 class="mt-3">Produk</h5>
            <p>Nama Produk: {{ $transaction->product->name }}</p>
            <p>Harga: Rp {{ number_format($transaction->product->price, 0, ',', '.') }}</p>

            <h5 class="mt-3">Transaksi</h5>
            <p>Status: <span class="badge bg-primary">{{ ucfirst($transaction->status) }}</span></p>

            @if($transaction->reject_reason)
                <p>Alasan Ditolak: {{ $transaction->reject_reason }}</p>
            @endif

            <hr>

            {{-- ACTIONS --}}
            <div class="mt-3">

                @if($transaction->status === 'pending')
                    <form action="{{ route('admin.transactions.approve', $transaction->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-success">Approve</button>
                    </form>

                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                        Tolak
                    </button>
                @endif

                @if($transaction->status === 'approved' || $transaction->status === 'processing')
                    <form action="{{ route('admin.transactions.updateStatus', $transaction->id) }}" method="POST" class="d-inline">
                        @csrf
                        <select name="status" class="form-select d-inline w-auto">
                            <option value="processing">Processing</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        <button class="btn btn-primary">Update</button>
                    </form>
                @endif

            </div>

        </div>
    </div>
</div>

{{-- REJECT MODAL --}}
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.transactions.reject', $transaction->id) }}" method="POST">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tolak Transaksi</h5>
                </div>
                <div class="modal-body">
                    <label>Alasan Penolakan</label>
                    <textarea name="reason" class="form-control" required></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-danger">Tolak</button>
                </div>
            </div>

        </form>
    </div>
</div>
<x-app-layout>