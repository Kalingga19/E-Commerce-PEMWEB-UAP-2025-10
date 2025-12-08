<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-3xl font-bold mb-6">Keranjang Belanja</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(empty($cart))
            <p class="text-gray-600">Keranjang kosong.</p>
        @else
            @foreach($cart as $item)
                <div class="p-4 bg-white rounded shadow mb-3 flex justify-between">
                    <div>
                        <h2 class="font-bold">{{ $item['name'] }}</h2>
                        <p>Qty: {{ $item['qty'] }}</p>
                        <p>Harga: Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</x-app-layout>
