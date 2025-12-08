<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="/" class="inline-flex items-center text-sm text-gray-500 hover:text-blue-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                @if($product->category)
                                <a href="#" class="ml-1 text-sm text-gray-500 hover:text-blue-600 md:ml-2">{{ $product->category->name }}</a>
                                @endif
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-800 md:ml-2 truncate">{{ $product->name }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
                    <!-- Left Column - Product Images -->
                    <div>
                        <!-- Main Image -->
                        @php
                            $thumb = $product->productImages->where('is_thumbnail', true)->first() ?? $product->productImages->first();
                        @endphp

                        @if($thumb)
                        <div class="relative overflow-hidden rounded-2xl bg-gray-100 mb-4">
                            <img src="{{ asset('storage/'.$thumb->image) }}" 
                                 class="w-full h-96 object-contain transform hover:scale-105 transition duration-500"
                                 alt="{{ $product->name }}">
                            <!-- Badges -->
                            @if($product->stock < 10)
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-red-500 text-white text-xs font-bold rounded-full">
                                    Hampir Habis
                                </span>
                            </div>
                            @endif
                            @if($product->original_price > $product->price)
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 bg-green-500 text-white text-xs font-bold rounded-full">
                                    {{ round((($product->original_price - $product->price) / $product->original_price) * 100) }}% OFF
                                </span>
                            </div>
                            @endif
                        </div>
                        @else
                        <div class="w-full h-96 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mb-4">
                            <div class="text-center">
                                <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-gray-500 mt-2">Tidak ada gambar</p>
                            </div>
                        </div>
                        @endif

                        <!-- Thumbnail Images -->
                        @if($product->productImages->count() > 1)
                        <div class="grid grid-cols-5 gap-3">
                            @foreach($product->productImages as $img)
                            <button class="relative overflow-hidden border-2 border-gray-200 rounded-xl hover:border-blue-500 transition duration-200 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                <img src="{{ asset('storage/'.$img->image) }}" 
                                     class="w-full h-20 object-cover hover:scale-110 transition duration-300"
                                     alt="Product thumbnail">
                                @if($img->is_thumbnail)
                                <div class="absolute inset-0 bg-blue-500/20 border-2 border-blue-500 rounded-xl"></div>
                                @endif
                            </button>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Right Column - Product Info -->
                    <div>
                        <!-- Product Header -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-3">
                                <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                                <button class="p-2 rounded-full hover:bg-gray-100 transition duration-200">
                                    <svg class="w-6 h-6 text-gray-600 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>
                            
                            <!-- Rating -->
                            <div class="flex items-center mb-4">
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    @endfor
                                </div>
                                <span class="ml-2 text-gray-600">4.8 • 128 reviews</span>
                            </div>

                            <!-- Price Section -->
                            <div class="mb-6">
                                <div class="flex items-center mb-2">
                                    <span class="text-3xl font-bold text-green-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @if($product->original_price > $product->price)
                                    <span class="ml-3 text-xl text-gray-400 line-through">Rp {{ number_format($product->original_price, 0, ',', '.') }}</span>
                                    <span class="ml-3 px-2 py-1 bg-green-100 text-green-800 text-sm font-bold rounded">
                                        Hemat Rp {{ number_format($product->original_price - $product->price, 0, ',', '.') }}
                                    </span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-500">Termasuk PPN 11%</p>
                            </div>
                        </div>

                        <!-- Store Info -->
                        <div class="bg-gray-50 rounded-xl p-4 mb-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-medium text-gray-800">{{ $product->store->name ?? 'Toko' }}</h3>
                                    <div class="flex items-center mt-1">
                                        <svg class="w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-600">{{ $product->store->city ?? 'Kota' }}</span>
                                        <span class="mx-2 text-gray-300">•</span>
                                        <span class="text-sm text-green-600 font-medium">⭐ 4.8/5 (320 rating)</span>
                                    </div>
                                </div>
                                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Kunjungi Toko
                                </a>
                            </div>
                        </div>

                        <!-- Product Details -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Deskripsi Produk</h3>
                            <div class="prose max-w-none">
                                <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                            </div>
                        </div>

                        <!-- Order Form -->
                        <form method="POST" action="/checkout" class="bg-gray-50 rounded-2xl p-6">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <!-- Stock Info -->
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <span class="text-gray-700 font-medium">Stok Tersedia:</span>
                                    <span class="ml-2 font-bold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $product->stock > 0 ? $product->stock . ' unit' : 'Stok Habis' }}
                                    </span>
                                </div>
                                @if($product->stock > 0)
                                <div class="text-sm text-gray-500">
                                    Sisa {{ $product->stock }} unit lagi
                                </div>
                                @endif
                            </div>

                            <!-- Quantity Selector -->
                            <div class="mb-8">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Jumlah:</label>
                                <div class="flex items-center">
                                    <button type="button" onclick="decreaseQty()" class="w-12 h-12 bg-white border border-gray-300 rounded-l-xl flex items-center justify-center hover:bg-gray-50 transition duration-200">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <input type="number" 
                                           name="qty" 
                                           id="quantity" 
                                           value="1" 
                                           min="1" 
                                           max="{{ $product->stock }}"
                                           class="w-20 h-12 text-center border-y border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg font-medium">
                                    <button type="button" onclick="increaseQty()" class="w-12 h-12 bg-white border border-gray-300 rounded-r-xl flex items-center justify-center hover:bg-gray-50 transition duration-200">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </button>
                                    <div class="ml-4 text-sm text-gray-500">
                                        Maks: {{ $product->stock }} unit
                                    </div>
                                </div>
                            </div>

                            <!-- Total Price -->
                            <div class="mb-8">
                                <div class="flex items-center justify-between py-4 border-t border-b border-gray-200">
                                    <span class="text-lg font-medium text-gray-800">Total Harga:</span>
                                    <span id="totalPrice" class="text-2xl font-bold text-green-600">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <button type="button" 
                                        class="py-4 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition duration-300 flex items-center justify-center group">
                                    <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Tambah ke Keranjang
                                </button>
                                
                                <button type="submit" 
                                        class="py-4 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-0.5 flex items-center justify-center group"
                                        {{ $product->stock < 1 ? 'disabled' : '' }}>
                                    <svg class="w-6 h-6 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    Beli Sekarang
                                </button>
                            </div>

                            <!-- Security Notice -->
                            <div class="mt-6 p-4 bg-blue-50 border border-blue-100 rounded-xl">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    <span class="text-sm text-blue-700">Pembelian Anda 100% aman dan terjamin</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Serupa</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Product Cards will be populated here -->
                    @for($i = 1; $i <= 4; $i++)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                        <div class="h-48 bg-gray-100"></div>
                        <div class="p-4">
                            <h3 class="font-medium text-gray-800 mb-2">Produk {{ $i }}</h3>
                            <p class="text-green-600 font-bold">Rp 999.000</p>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Ulasan Pembeli</h2>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Rating Summary -->
                    <div class="lg:col-span-1">
                        <div class="text-center">
                            <div class="text-5xl font-bold text-gray-900 mb-2">4.8</div>
                            <div class="flex justify-center mb-4">
                                @for($i = 1; $i <= 5; $i++)
                                <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                @endfor
                            </div>
                            <p class="text-gray-600">Berdasarkan 128 ulasan</p>
                        </div>
                    </div>
                    
                    <!-- Reviews List -->
                    <div class="lg:col-span-2">
                        <div class="space-y-6">
                            <!-- Sample Review -->
                            <div class="border-b border-gray-200 pb-6">
                                <div class="flex items-center mb-3">
                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-full flex items-center justify-center mr-3">
                                        <span class="font-bold text-blue-600">AB</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800">Ahmad Budi</h4>
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            @endfor
                                        </div>
                                    </div>
                                    <span class="ml-auto text-sm text-gray-500">2 hari lalu</span>
                                </div>
                                <p class="text-gray-600">Produk sangat bagus, sesuai dengan deskripsi. Pengiriman cepat dan aman. Recommended!</p>
                            </div>
                        </div>
                        
                        <button class="mt-6 w-full py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition duration-200">
                            Lihat Semua Ulasan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const price = {{ $product->price }};
        const maxStock = {{ $product->stock }};
        
        function updateTotalPrice() {
            const quantity = parseInt(document.getElementById('quantity').value);
            const total = price * quantity;
            document.getElementById('totalPrice').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }
        
        function increaseQty() {
            const input = document.getElementById('quantity');
            let value = parseInt(input.value);
            if (value < maxStock) {
                input.value = value + 1;
                updateTotalPrice();
            }
        }
        
        function decreaseQty() {
            const input = document.getElementById('quantity');
            let value = parseInt(input.value);
            if (value > 1) {
                input.value = value - 1;
                updateTotalPrice();
            }
        }
        
        document.getElementById('quantity').addEventListener('input', function() {
            let value = parseInt(this.value);
            if (value < 1) this.value = 1;
            if (value > maxStock) this.value = maxStock;
            updateTotalPrice();
        });
        
        // Initialize total price
        updateTotalPrice();
    </script>
</x-app-layout>