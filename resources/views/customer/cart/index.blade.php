<x-app-layout>
    @php
    $cart = $cart ?? null;
    $product = $product ?? null;
    @endphp

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="mb-10">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg mr-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 
                                    2.293c-.63.63-.184 1.707.707 1.707H17m0 
                                    0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Keranjang Belanja</h1>
                            <p class="text-gray-600 mt-1">Review dan lanjutkan pembelian Anda</p>
                        </div>
                    </div>
                </div>

                {{-- ALERT --}}
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-xl p-4 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 text-red-700">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            {{-- EMPTY CART --}}
            @if(empty($cart))
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Keranjang Kosong</h3>
                    <p class="text-gray-600 mb-6">Mulai belanja untuk menambahkan produk ke keranjang.</p>
                    <a href="{{ route('home') }}"
                    class="px-6 py-3 bg-blue-600 text-white rounded-xl shadow-md">Belanja Sekarang</a>
                </div>

            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- CART ITEMS --}}
                    <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg border border-gray-200">
                        <div class="px-6 py-5 border-b bg-gray-50">
                            <h2 class="text-xl font-semibold text-gray-900">
                                Item dalam Keranjang ({{ count($cart) }})
                            </h2>
                        </div>

                        <div class="divide-y">
                        @foreach($cart as $id => $item)
                            <div class="p-6 hover:bg-gray-50 transition">
                                <div class="flex flex-col sm:flex-row">

                                    {{-- IMAGE --}}
                                    <div class="sm:w-32 sm:h-32 bg-gray-100 rounded-lg flex items-center justify-center mr-5">
                                        <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 
                                                12H4L5 9z"></path>
                                        </svg>
                                    </div>

                                    {{-- PRODUCT --}}
                                    <div class="flex-1">
                                        <div class="flex flex-col lg:flex-row lg:justify-between">

                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900">{{ $item['name'] }}</h3>
                                                <p class="text-gray-600 text-sm">
                                                    Rp {{ number_format($item['price'],0,',','.') }} / item
                                                </p>

                                                <div class="flex items-center mt-4 space-x-2">

                                                {{-- BUTTON MIN --}}
                                                <form action="{{ route('cart.updateQty', $id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="qty" value="{{ $item['qty'] - 1 }}">

                                                    <button class="w-10 h-10 bg-gray-100 rounded-lg flex justify-center items-center">
                                                        –
                                                    </button>
                                                </form>

                                                {{-- CURRENT QTY --}}
                                                <div class="w-16 text-center border rounded-lg py-2">
                                                    {{ $item['qty'] }}
                                                </div>

                                                {{-- BUTTON PLUS --}}
                                                <form action="{{ route('cart.updateQty', $id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="qty" value="{{ $item['qty'] + 1 }}">

                                                    <button class="w-10 h-10 bg-gray-100 rounded-lg flex justify-center items-center">
                                                        +
                                                    </button>
                                                </form>

                                                {{-- DELETE --}}
                                                <a href="#"
                                                    onclick="event.preventDefault(); document.getElementById('del{{ $id }}').submit();"
                                                    class="text-red-600 font-medium ml-3">
                                                    Hapus
                                                </a>
                                                <form id="del{{ $id }}"
                                                    action="{{ route('cart.remove', $id) }}"
                                                    method="POST" class="hidden">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>

                                            </div>

                                            {{-- SUBTOTAL --}}
                                            <div class="text-right mt-3">
                                                <div class="text-sm text-gray-600">Subtotal</div>
                                                <div class="text-2xl font-bold">
                                                    Rp {{ number_format($item['price'] * $item['qty'],0,',','.') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>

                        {{-- ACTION BUTTONS --}}
                        <div class="px-6 py-5 bg-gray-50 border-t flex justify-between">
                            <a href="{{ route('home') }}" class="text-blue-600 font-semibold">
                                ← Lanjutkan Belanja
                            </a>

                            <div class="flex space-x-4">
                                {{-- CLEAR CART --}}
                                <button type="button"
                                        onclick="event.preventDefault(); document.getElementById('clearCart').submit();"
                                        class="px-6 py-3 bg-red-600 text-white rounded-lg">
                                    Kosongkan Keranjang
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- ORDER SUMMARY --}}
                    <div>
                        <div class="bg-white rounded-2xl shadow-lg border p-6">
                            <h3 class="text-xl font-semibold mb-4">Ringkasan Pesanan</h3>

                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span>Subtotal</span>
                                    <span>
                                        Rp {{ number_format(array_sum(array_map(fn($i)=>$i['price']*$i['qty'],$cart)),0,',','.') }}
                                    </span>
                                </div>

                                <div class="flex justify-between">
                                    <span>Pengiriman</span>
                                    <span class="text-green-600">Gratis</span>
                                </div>

                                <hr>

                                <div class="flex justify-between text-lg font-bold">
                                    <span>Total</span>
                                    <span>
                                        Rp {{ number_format(array_sum(array_map(fn($i)=>$i['price']*$i['qty'],$cart)),0,',','.') }}
                                    </span>
                                </div>
                            </div>

                            <a href="{{ route('checkout') }}"
                            class="mt-6 block text-center py-4 bg-blue-600 text-white rounded-xl font-semibold">
                            Lanjut ke Pembayaran
                            </a>
                        </div>
                    </div>
                </div>

            {{-- CLEAR CART FORM --}}
            <form id="clearCart" action="{{ route('cart.clear') }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>

            @endif
        </div>
    </div>

    {{-- QTY BUTTONS --}}
    <script>
        function increase(id) {
            let el = document.getElementById('qty_' + id);
            el.value = parseInt(el.value) + 1;
        }
        function decrease(id) {
            let el = document.getElementById('qty_' + id);
            if (parseInt(el.value) > 1) el.value = parseInt(el.value) - 1;
        }
    </script>

</x-app-layout>
