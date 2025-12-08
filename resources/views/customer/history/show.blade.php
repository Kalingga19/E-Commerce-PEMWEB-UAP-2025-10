<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-10 px-4">
        <div class="max-w-4xl mx-auto">

            <!-- Breadcrumb -->
            <div class="mb-6">
                <a href="{{ route('history') }}" class="text-blue-600 hover:underline text-sm">
                    ← Kembali ke Riwayat
                </a>
            </div>

            <!-- Header -->
            <div class="bg-white shadow-xl rounded-2xl p-6 mb-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-3">
                    Detail Transaksi – {{ $transaction->code }}
                </h1>

                <div class="flex items-center space-x-4 mt-2">
                    <span class="text-gray-500 text-sm">
                        Tanggal: {{ $transaction->created_at->format('d M Y, H:i') }}
                    </span>

                    @if($transaction->payment_status == 'paid')
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Berhasil</span>
                    @elseif($transaction->payment_status == 'pending')
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">Pending</span>
                    @else
                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">Gagal</span>
                    @endif
                </div>
            </div>

            <!-- Product List -->
            <div class="bg-white rounded-2xl shadow-xl p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Produk Dipesan</h2>

                @foreach(($transaction->details ?? []) as $detail)
                <div class="flex items-center mb-4 p-4 bg-gray-50 rounded-xl">
                    
                    <div class="w-20 h-20 bg-gray-200 rounded-xl overflow-hidden mr-4">
                        @if($detail->product->productImages->first())
                            <img src="{{ asset('storage/'.$detail->product->productImages->first()->image) }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center w-full h-full text-gray-400">No Image</div>
                        @endif
                    </div>

                    <div class="flex-1">
                        <h3 class="font-medium text-gray-800">{{ $detail->product->name }}</h3>
                        <p class="text-sm text-gray-500">Jumlah: x{{ $detail->qty }}</p>
                    </div>

                    <div class="font-bold text-gray-900">
                        Rp {{ number_format($detail->price * $detail->qty, 0, ',', '.') }}
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Payment and Shipping -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                <div class="bg-white p-6 rounded-2xl shadow-xl">
                    <h3 class="font-semibold text-gray-800 mb-2">Metode Pembayaran</h3>
                    <p class="text-gray-600">{{ ucfirst($transaction->payment_method) }}</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-xl">
                    <h3 class="font-semibold text-gray-800 mb-2">Alamat Pengiriman</h3>
                    <p class="text-gray-600">
                        {{ $transaction->address }} <br>
                        {{ $transaction->city }}
                    </p>
                </div>
            </div>

            <!-- Total -->
            <div class="bg-white p-6 rounded-2xl shadow-xl">
                <h3 class="font-semibold text-gray-800 mb-3">Ringkasan Pembayaran</h3>

                <div class="flex justify-between py-2 text-gray-700">
                    <span>Total Produk:</span>
                    <span>Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</span>
                </div>

                <div class="flex justify-between py-2 text-gray-700">
                    <span>Ongkos Kirim:</span>
                    <span>Rp {{ number_format($transaction->shipping_cost, 0, ',', '.') }}</span>
                </div>

                <div class="flex justify-between py-3 border-t mt-3 font-bold text-gray-900">
                    <span>Grand Total:</span>
                    <span>Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</span>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
