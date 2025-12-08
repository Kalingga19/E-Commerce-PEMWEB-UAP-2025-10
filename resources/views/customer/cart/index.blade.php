<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-10">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg mr-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Keranjang Belanja</h1>
                            <p class="text-gray-600 mt-1">Review dan lanjutkan pembelian Anda</p>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="flex items-center space-x-2 text-sm">
                            <div class="flex items-center text-blue-600">
                                <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center">1</div>
                                <div class="w-12 h-1 bg-blue-600"></div>
                            </div>
                            <div class="flex items-center text-gray-400">
                                <div class="w-8 h-8 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center">2</div>
                                <div class="w-12 h-1 bg-gray-200"></div>
                            </div>
                            <div class="flex items-center text-gray-400">
                                <div class="w-8 h-8 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center">3</div>
                            </div>
                        </div>
                        <div class="flex justify-between text-xs text-gray-500 mt-2 max-w-48">
                            <span class="text-blue-600 font-medium">Keranjang</span>
                            <span>Pengiriman</span>
                            <span>Pembayaran</span>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-4 flex items-start">
                        <div class="flex-shrink-0 p-2 bg-green-100 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-green-800 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 rounded-xl p-4 flex items-start">
                        <div class="flex-shrink-0 p-2 bg-red-100 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-red-800 font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif
            </div>

            @if(empty($cart))
                <!-- Empty Cart State -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                    <div class="text-center py-16 px-6">
                        <div class="p-4 bg-gray-100 rounded-full inline-flex mb-6">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Keranjang Belanja Kosong</h3>
                        <p class="text-gray-600 max-w-md mx-auto mb-8">
                            Belum ada produk di keranjang Anda. Mulai berbelanja dan temukan produk menarik!
                        </p>
                        <a href="{{ route('products.index') }}" 
                           class="inline-flex items-center px-6 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 
                                  text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-indigo-700 
                                  focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 
                                  transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Mulai Belanja Sekarang
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items Section -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                            <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                                <h2 class="text-xl font-semibold text-gray-900">
                                    Item dalam Keranjang ({{ count($cart) }})
                                </h2>
                            </div>
                            
                            <div class="divide-y divide-gray-200">
                                @foreach($cart as $id => $item)
                                    <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                                        <div class="flex flex-col sm:flex-row">
                                            <!-- Product Image -->
                                            <div class="sm:w-32 sm:h-32 w-full h-48 bg-gray-100 rounded-lg mb-4 sm:mb-0 sm:mr-6 flex items-center justify-center">
                                                <div class="p-6 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-lg">
                                                    <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            
                                            <!-- Product Details -->
                                            <div class="flex-1">
                                                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between">
                                                    <div class="flex-1">
                                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                                            {{ $item['name'] }}
                                                        </h3>
                                                        <div class="flex items-center space-x-4 text-sm text-gray-600 mb-4">
                                                            <div class="flex items-center">
                                                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                </svg>
                                                                <span>Rp {{ number_format($item['price'], 0, ',', '.') }} /item</span>
                                                            </div>
                                                            <div class="flex items-center">
                                                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                                </svg>
                                                                <span>Stok: {{ $item['stock'] ?? 'Tersedia' }}</span>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Quantity Controls -->
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center space-x-3">
                                                                <div class="flex items-center border border-gray-300 rounded-lg">
                                                                    <button type="button" 
                                                                            class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-100 rounded-l-lg">
                                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                                        </svg>
                                                                    </button>
                                                                    <div class="w-12 text-center">
                                                                        <span class="font-medium text-gray-900">{{ $item['qty'] }}</span>
                                                                    </div>
                                                                    <button type="button" 
                                                                            class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-100 rounded-r-lg">
                                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                                <button type="button" 
                                                                        class="text-red-600 hover:text-red-800 text-sm font-medium">
                                                                    <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                    </svg>
                                                                    Hapus
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Price Summary -->
                                                    <div class="mt-4 lg:mt-0 lg:text-right">
                                                        <div class="text-sm text-gray-600 mb-1">Subtotal</div>
                                                        <div class="text-2xl font-bold text-gray-900">
                                                            Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Cart Actions -->
                            <div class="px-6 py-5 border-t border-gray-200 bg-gray-50">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                    <a href="{{ route('products.index') }}" 
                                       class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                        </svg>
                                        Lanjutkan Belanja
                                    </a>
                                    <div class="flex space-x-4">
                                        <button type="button" 
                                                class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg 
                                                       hover:bg-gray-50 transition-colors duration-200">
                                            Update Keranjang
                                        </button>
                                        <button type="button" 
                                                class="px-6 py-3 bg-red-600 text-white font-medium rounded-lg 
                                                       hover:bg-red-700 transition-colors duration-200">
                                            Kosongkan Keranjang
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Promo Section -->
                        <div class="mt-8 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-3 bg-green-100 rounded-xl mr-4">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 mb-2">Gunakan Kode Promo</h4>
                                    <div class="flex flex-col sm:flex-row gap-3">
                                        <div class="flex-1">
                                            <input type="text" 
                                                   placeholder="Masukkan kode promo"
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg 
                                                          focus:ring-2 focus:ring-green-500 focus:border-green-500 
                                                          focus:outline-none">
                                        </div>
                                        <button type="button" 
                                                class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg 
                                                       hover:bg-green-700 transition-colors duration-200 whitespace-nowrap">
                                            Terapkan Kode
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="sticky top-6">
                            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                                    <h2 class="text-xl font-semibold text-gray-900">Ringkasan Pesanan</h2>
                                </div>
                                
                                <div class="p-6">
                                    <!-- Order Details -->
                                    <div class="space-y-4 mb-6">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Subtotal ({{ array_sum(array_column($cart, 'qty')) }} item)</span>
                                            <span class="font-medium text-gray-900">
                                                Rp {{ number_format(array_sum(array_map(function($item) { 
                                                    return $item['price'] * $item['qty']; 
                                                }, $cart)), 0, ',', '.') }}
                                            </span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Biaya Pengiriman</span>
                                            <span class="font-medium text-green-600">Gratis</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Diskon</span>
                                            <span class="font-medium text-red-600">- Rp 0</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Divider -->
                                    <div class="border-t border-gray-200 pt-4 mb-6">
                                        <div class="flex justify-between items-center">
                                            <span class="text-lg font-semibold text-gray-900">Total</span>
                                            <div class="text-right">
                                                <div class="text-3xl font-bold text-gray-900">
                                                    Rp {{ number_format(array_sum(array_map(function($item) { 
                                                        return $item['price'] * $item['qty']; 
                                                    }, $cart)), 0, ',', '.') }}
                                                </div>
                                                <div class="text-sm text-gray-500">Termasuk PPN 11%</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Checkout Button -->
                                    <a href="{{ route('checkout') }}"
                                       class="w-full flex justify-center items-center px-6 py-4 
                                              bg-gradient-to-r from-blue-600 to-indigo-600 
                                              text-white font-semibold rounded-xl shadow-lg 
                                              hover:from-blue-700 hover:to-indigo-700 
                                              focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 
                                              transform hover:-translate-y-0.5 transition-all duration-200 mb-4">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                        Lanjut ke Pembayaran
                                    </a>
                                    
                                    <p class="text-center text-sm text-gray-600 mb-6">
                                        Pembayaran aman dan terenkripsi
                                    </p>
                                    
                                    <!-- Payment Methods -->
                                    <div class="border-t border-gray-200 pt-6">
                                        <h4 class="text-sm font-medium text-gray-900 mb-3">Metode Pembayaran</h4>
                                        <div class="grid grid-cols-3 gap-2">
                                            <div class="p-2 border border-gray-200 rounded-lg flex items-center justify-center">
                                                <span class="text-xs font-medium">BCA</span>
                                            </div>
                                            <div class="p-2 border border-gray-200 rounded-lg flex items-center justify-center">
                                                <span class="text-xs font-medium">Mandiri</span>
                                            </div>
                                            <div class="p-2 border border-gray-200 rounded-lg flex items-center justify-center">
                                                <span class="text-xs font-medium">BNI</span>
                                            </div>
                                            <div class="p-2 border border-gray-200 rounded-lg flex items-center justify-center">
                                                <span class="text-xs font-medium">QRIS</span>
                                            </div>
                                            <div class="p-2 border border-gray-200 rounded-lg flex items-center justify-center">
                                                <span class="text-xs font-medium">OVO</span>
                                            </div>
                                            <div class="p-2 border border-gray-200 rounded-lg flex items-center justify-center">
                                                <span class="text-xs font-medium">DANA</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Security Info -->
                            <div class="mt-6 bg-gray-50 border border-gray-200 rounded-xl p-5">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 p-2 bg-green-100 rounded-lg mr-3">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900 mb-1">Belanja Aman</h4>
                                        <p class="text-xs text-gray-600">
                                            Transaksi Anda dilindungi dengan enkripsi SSL. Data pribadi Anda aman bersama kami.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>