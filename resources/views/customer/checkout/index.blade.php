<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section -->
            @if (session('success'))
                <div class="mb-4 rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-green-800 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-red-800 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
                        <p class="text-gray-600 mt-2">Lengkapi informasi untuk menyelesaikan pembelian</p>
                    </div>
                    <div class="flex items-center">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">
                                1
                            </div>
                            <div class="w-24 h-1 bg-blue-600"></div>
                            <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">
                                2
                            </div>
                            <div class="w-24 h-1 bg-gray-300"></div>
                            <div class="w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold">
                                3
                            </div>
                        </div>
                        <div class="ml-8 text-sm">
                            <span class="text-blue-600 font-medium">Pengiriman</span> → Pembayaran → Konfirmasi
                        </div>
                    </div>
                </div>

                <!-- Progress Info -->
                <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            <span class="font-medium text-gray-800">
                                Pesanan #ORD-{{ date('Ymd') }}-{{ rand(1000, 9999) }}
                            </span>
                            • Tanggal: {{ date('d M Y') }}
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-sm text-green-600">Stok tersedia</span>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="/checkout" class="space-y-8">
                @csrf
                <!-- hidden product & qty -->
                @if(isset($product))
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="qty" value="{{ $qty }}">
                @endif
                @if(isset($cart))
                    <input type="hidden" name="cart_mode" value="1">
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column - Shipping Address -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Shipping Address Card -->
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                            <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-100">
                                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                    <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Alamat Pengiriman
                                </h3>
                            </div>

                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Address Field -->
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                            Alamat Lengkap
                                            <span class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Required</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </div>
                                            <input type="text"
                                                   name="address"
                                                   class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                                   placeholder="Contoh: Jl. Sudirman No. 123, RT 01/RW 02"
                                                   required>
                                        </div>
                                    </div>

                                    <!-- City Field -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                            Kota
                                            <span class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Required</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                            </div>
                                            <input type="text"
                                                   name="city"
                                                   class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                                   placeholder="Contoh: Jakarta Selatan"
                                                   required>
                                        </div>
                                    </div>

                                    <!-- Postal Code Field -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                            Kode Pos
                                            <span class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Required</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                                                </svg>
                                            </div>
                                            <input type="text"
                                                   name="postal_code"
                                                   class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                                   placeholder="Contoh: 12190"
                                                   required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Shipping Type -->
                                <div class="mt-8">
                                    <h4 class="text-sm font-medium text-gray-700 mb-4">Jenis Pengiriman</h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                        <div class="relative">
                                            <input type="radio"
                                                   name="shipping_type"
                                                   id="shipping_reg"
                                                   value="REG"
                                                   class="sr-only"
                                                   checked>
                                            <label for="shipping_reg"
                                                   class="flex flex-col p-4 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-blue-500 transition duration-200">
                                                <div class="flex items-center justify-between">
                                                    <span class="font-medium text-gray-800">REG</span>
                                                </div>
                                                <span class="text-sm text-gray-600 mt-1">Reguler</span>
                                                <span class="text-lg font-bold text-blue-600 mt-2">Rp 20.000</span>
                                            </label>
                                        </div>

                                        <div class="relative">
                                            <input type="radio"
                                                   name="shipping_type"
                                                   id="shipping_exp"
                                                   value="EXP"
                                                   class="sr-only">
                                            <label for="shipping_exp"
                                                   class="flex flex-col p-4 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-blue-500 transition duration-200">
                                                <div class="flex items-center justify-between">
                                                    <span class="font-medium text-gray-800">EXP</span>
                                                </div>
                                                <span class="text-sm text-gray-600 mt-1">Express</span>
                                                <span class="text-lg font-bold text-blue-600 mt-2">Rp 35.000</span>
                                            </label>
                                        </div>

                                        <div class="relative">
                                            <input type="radio"
                                                   name="shipping_type"
                                                   id="shipping_sds"
                                                   value="SDS"
                                                   class="sr-only">
                                            <label for="shipping_sds"
                                                   class="flex flex-col p-4 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-blue-500 transition duration-200">
                                                <div class="flex items-center justify-between">
                                                    <span class="font-medium text-gray-800">SDS</span>
                                                </div>
                                                <span class="text-sm text-gray-600 mt-1">Same Day</span>
                                                <span class="text-lg font-bold text-blue-600 mt-2">Rp 50.000</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden inputs -->
                        <input type="hidden" name="shipping_cost" id="shipping_cost_input" value="20000">
                        <input type="hidden" name="service_fee" id="service_fee_input" value="5000">

                        <!-- Order Summary -->
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                            <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100">
                                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                    <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    Ringkasan Pesanan
                                </h3>
                            </div>
                            <div class="p-6">

                            <!-- Ringkasan Produk -->
                            @if($product)
                                {{-- MODE BUY NOW --}}
                                <div class="flex items-center mb-4">
                                    <div class="w-16 h-16 bg-gray-100 rounded-lg mr-4">
                                        <img src="{{ asset('storage/' . $product->productImages->first()->image) }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h4 class="font-medium">{{ $product->name }}</h4>
                                        <p class="text-sm text-gray-500">
                                            Qty: {{ $qty }} • Harga: Rp {{ number_format($product->price) }}
                                        </p>
                                    </div>
                                </div>
                            @elseif($cart)
                                {{-- MODE CHECKOUT DARI CART --}}
                                @foreach($cart as $item)
                                    <div class="flex items-center mb-4">
                                        <div class="w-16 h-16 bg-gray-100 rounded-lg mr-4"></div>
                                        <div>
                                            <h4 class="font-medium">{{ $item->product->name }}</h4>
                                            <p class="text-sm text-gray-500">
                                                Qty: {{ $item->qty }} • Harga: Rp {{ number_format($item->product->price) }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            @php
                                if (isset($product)) {
                                    // Mode Buy Now
                                    $totalProduk = $subtotal;
                                } else {
                                    // Mode Cart
                                    $totalProduk = array_sum(
                                        array_map(fn($i) => $i->product->price * $i->qty, $cart->toArray())
                                    );
                                }
                            @endphp
                                <div class="space-y-4 mt-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Subtotal Produk</span>
                                        <span class="font-medium text-gray-800" id="subtotal_text">
                                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Biaya Pengiriman</span>
                                        <span class="font-medium text-gray-800" id="shipping_text">
                                            Rp 20.000
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Biaya Layanan</span>
                                        <span class="font-medium text-gray-800" id="service_text">
                                            Rp 5.000
                                        </span>
                                    </div>
                                    <div class="border-t pt-4">
                                        <div class="flex justify-between items-center">
                                            <span class="text-lg font-bold text-gray-800">Total Pembayaran</span>
                                            <span class="text-2xl font-bold text-green-600" id="total_text">
                                                Rp {{ number_format($subtotal + 20000 + 5000, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Payment Method -->
                    <div class="space-y-8">
                        <!-- Payment Method Card -->
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                            <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-purple-100">
                                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                    <svg class="w-6 h-6 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    Metode Pembayaran
                                </h3>
                            </div>

                            <div class="p-6">
                                <div class="space-y-4">
                                    <!-- Wallet Option -->
                                    <div class="relative">
                                        <input type="radio" name="payment_method" id="wallet" value="wallet" class="peer sr-only">
                                        <label for="wallet"
                                            class="flex items-center p-4 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-purple-500 transition duration-200">
                                            <div class="flex-shrink-0 mr-4">
                                                <div class="w-12 h-12 bg-gradient-to-r from-green-100 to-emerald-100 rounded-xl flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between">
                                                    <span class="font-medium text-gray-800">Saldo Dompet</span>
                                                </div>
                                                <p class="text-sm text-gray-600 mt-1">
                                                    Saldo tersedia:
                                                    <span class="font-bold text-green-600">
                                                        Rp {{ number_format($balance, 0, ',', '.') }}
                                                    </span>
                                                </p>
                                            </div>
                                        </label>
                                    </div>

                                    <!-- Virtual Account Option -->
                                    <div class="relative">
                                        <input type="radio"
                                            name="payment_method"
                                            id="va"
                                            value="va"
                                            class="sr-only">
                                        <label for="va"
                                            class="flex items-center p-4 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-purple-500 transition duration-200">
                                            <div class="flex-shrink-0 mr-4">
                                                <div class="w-12 h-12 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-xl flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between">
                                                    <span class="font-medium text-gray-800">Virtual Account</span>
                                                </div>
                                                <p class="text-sm text-gray-600 mt-1">Transfer via BCA, Mandiri, BRI, dll.</p>
                                            </div>
                                        </label>
                                    </div>

                                    <!-- QRIS Option -->
                                    <div class="relative">
                                        <input type="radio"
                                            name="payment_method"
                                            id="qris"
                                            value="qris"
                                            class="sr-only">
                                        <label for="qris"
                                            class="flex items-center p-4 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-purple-500 transition duration-200">
                                            <div class="flex-shrink-0 mr-4">
                                                <div class="w-12 h-12 bg-gradient-to-r from-yellow-100 to-orange-100 rounded-xl flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between">
                                                    <span class="font-medium text-gray-800">QRIS</span>
                                                </div>
                                                <p class="text-sm text-gray-600 mt-1">Scan QR Code untuk pembayaran</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Terms and Conditions -->
                                <div class="mt-8 p-4 bg-gray-50 rounded-xl">
                                    <div class="flex items-start">
                                        <input type="checkbox"
                                               id="terms"
                                               class="mt-1 mr-3 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                               required>
                                        <label for="terms" class="text-sm text-gray-600">
                                            Saya menyetujui <a href="#" class="text-blue-600 hover:underline">Syarat & Ketentuan</a> serta
                                            <a href="#" class="text-blue-600 hover:underline">Kebijakan Privasi</a> yang berlaku.
                                        </label>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit"
                                        class="w-full mt-6 py-4 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold text-lg rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-0.5 flex items-center justify-center">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Proses Checkout
                                </button>

                                <!-- Security Notice -->
                                <div class="mt-6 p-4 bg-blue-50 border border-blue-100 rounded-xl">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        <span class="text-sm text-blue-700">Transaksi Anda aman dan terenkripsi</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Help Section -->
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                    <svg class="w-5 h-5 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Butuh Bantuan?
                                </h3>
                            </div>
                            <div class="p-6">
                                <p class="text-sm text-gray-600 mb-4">Hubungi customer service kami untuk bantuan lebih lanjut:</p>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-700">+62 812-3456-7890</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-700">help@ecommerce.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPT UNTUK HITUNG TOTAL DINAMIS --}}
    <script>
        let subtotal   = { $subtotal };
        let shipping   = 20000;
        let serviceFee = 5000;

        function formatRupiah(num) {
            return 'Rp ' + num.toLocaleString('id-ID');
        }

        function updateSummary() {
            document.getElementById('shipping_text').textContent = formatRupiah(shipping);
            document.getElementById('service_text').textContent  = formatRupiah(serviceFee);
            document.getElementById('total_text').textContent    = formatRupiah(subtotal + shipping + serviceFee);

            document.getElementById('shipping_cost_input').value = shipping;
            document.getElementById('service_fee_input').value   = serviceFee;
        }

        document.getElementById('shipping_reg').addEventListener('click', function () {
            shipping = 20000;
            updateSummary();
        });

        document.getElementById('shipping_exp').addEventListener('click', function () {
            shipping = 35000;
            updateSummary();
        });

        document.getElementById('shipping_sds').addEventListener('click', function () {
            shipping = 50000;
            updateSummary();
        });

        // init pertama
        updateSummary();
    </script>
</x-app-layout>
