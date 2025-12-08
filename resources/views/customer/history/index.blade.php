<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-10 px-4">
        <div class="max-w-4xl mx-auto">

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Riwayat Transaksi</h1>
                <p class="text-gray-600 mt-1">Lihat semua pesanan yang pernah kamu buat</p>
            </div>

            <!-- Jika tidak ada transaksi -->
            @if($transactions->isEmpty())
                <div class="bg-white shadow-xl rounded-2xl p-10 text-center">
                    <h2 class="text-xl font-semibold text-gray-800 mb-3">Belum ada transaksi</h2>
                    <p class="text-gray-600 mb-6">Ayo mulai belanja sekarang!</p>
                    <a href="/" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl">
                        Mulai Belanja
                    </a>
                </div>
            @else

            <!-- LIST TRANSAKSI -->
            @foreach($transactions as $trx)
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden mb-6">

                <!-- HEADER TRANSAKSI -->
                <div class="px-6 py-4 bg-gray-50 border-b flex justify-between items-center">
                    <div>
                        <h2 class="font-bold text-gray-900 text-lg">{{ $trx->code }}</h2>
                        <p class="text-sm text-gray-500">
                            Tanggal: {{ $trx->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>

                    <!-- STATUS -->
                    @if($trx->payment_status == 'paid')
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                            Berhasil
                        </span>
                    @elseif($trx->payment_status == 'pending')
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">
                            Pending
                        </span>
                    @else
                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">
                            Gagal
                        </span>
                    @endif
                </div>

                <!-- PRODUK DALAM TRANSAKSI -->
                <div class="p-6">
                    <h3 class="text-sm font-semibold text-gray-700 mb-3">Produk Dipesan</h3>

                    @foreach($trx->details as $detail)
                        @php
                            $product = optional($detail->product);
                            $image = optional($product->productImages)->first();
                        @endphp

                        <div class="flex items-center p-3 mb-3 bg-gray-50 rounded-xl">

                            <!-- GAMBAR -->
                            <div class="w-16 h-16 rounded-xl overflow-hidden bg-gray-200 mr-4 flex items-center justify-center">
                                @if($image)
                                    <img src="{{ asset('storage/'.$image->image) }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-gray-500 text-xs">No Image</span>
                                @endif
                            </div>

                            <!-- INFO PRODUK -->
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">{{ $product->name ?? 'Produk telah dihapus' }}</p>
                                <p class="text-sm text-gray-500">x{{ $detail->qty }}</p>
                            </div>

                            <!-- TOTAL PER PRODUK -->
                            <div class="font-bold text-gray-900">
                                Rp {{ number_format($detail->price * $detail->qty, 0, ',', '.') }}
                            </div>

                        </div>
                    @endforeach

                    <!-- FOOTER INFORMASI -->
                    <div class="border-t pt-4 mt-4">

                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                            <span>Metode Pembayaran</span>
                            <span>{{ ucfirst($trx->payment_method) }}</span>
                        </div>

                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                            <span>Alamat Pengiriman</span>
                            <span class="text-right">{{ $trx->address }}, {{ $trx->city }}</span>
                        </div>

                        <div class="flex justify-between font-bold text-gray-900 text-lg mt-3">
                            <span>Total</span>
                            <span>Rp {{ number_format($trx->grand_total, 0, ',', '.') }}</span>
                        </div>

                        <div class="mt-4 flex justify-end">
                            <a href="{{ route('history.show', $trx->id) }}"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                                Lihat Detail
                            </a>
                        </div>

                    </div>

                </div>

            </div>
            @endforeach

            @endif

        </div>
    </div>
</x-app-layout>
