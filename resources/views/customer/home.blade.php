<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-blue-50/30 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-10">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8">
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Katalog Produk</h1>
                        </div>
                        <p class="text-gray-600 text-lg">Temukan produk berkualitas dari berbagai toko terpercaya</p>
                    </div>
                    
                    <!-- Search and Filter -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="relative flex-1 max-w-md">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <form action="{{ route('search') }}" method="GET">
                                <input type="text" 
                                    placeholder="Cari produk berdasarkan nama, kategori, atau toko..." 
                                    class="pl-12 pr-4 py-3.5 bg-white border-2 border-gray-200 rounded-2xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 shadow-sm hover:border-gray-300 transition-all duration-300 w-full">
                            </form>
                        </div>
                        <button class="px-6 py-3.5 bg-white border-2 border-gray-200 rounded-2xl hover:border-blue-500 hover:bg-blue-50 transition-all duration-300 flex items-center justify-center gap-2 font-medium text-gray-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            Filter
                        </button>
                    </div>
                </div>

                <!-- Categories Filter -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Kategori Produk</h3>
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center gap-1 lg:hidden">
                            Lihat semua
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="flex gap-3 overflow-x-auto pb-4 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                        <!-- All Products Button -->
                        <a href="{{ route('home') }}" class="flex-shrink-0">
                            <div class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl font-medium shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105 whitespace-nowrap flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                Semua Produk
                            </div>
                        </a>

                        <!-- Category Buttons -->
                        @foreach($categories as $category)
                            <a href="{{ route('category.filter', $category->slug) }}" class="flex-shrink-0">
                                <div class="px-6 py-3 bg-white border-2 border-gray-200 text-gray-700 rounded-xl font-medium shadow-sm hover:shadow-md hover:border-blue-400 hover:scale-105 transition-all duration-300 whitespace-nowrap flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    {{ $category->name }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Stats and Sort Bar -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2">
                                <div class="p-2 bg-blue-100 rounded-lg">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Total Produk</p>
                                    <p class="text-xl font-bold text-gray-900">{{ $products->total() }}</p>
                                </div>
                            </div>
                            <div class="h-8 w-px bg-gray-200 hidden md:block"></div>
                            <div class="text-sm text-gray-600">
                                Menampilkan <span class="font-bold text-gray-900">{{ $products->count() }}</span> produk
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <select onchange="location.href='/?sort='+this.value" class="border-2 border-gray-200 rounded-xl px-4 py-3 text-sm font-medium focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300 bg-white cursor-pointer">
                                <option value="latest">📅 Terbaru</option>
                                <option value="price_asc">💰 Harga: Rendah → Tinggi</option>
                                <option value="price_desc">💰 Harga: Tinggi → Rendah</option>
                                <option value="name_asc">🔤 Nama: A-Z</option>
                                <option value="popular">🔥 Terpopuler</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($products as $product)
                <div class="group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">
                    <!-- Product Image Container -->
                    <div class="relative overflow-hidden bg-gradient-to-br from-gray-50 to-gray-100">
                        @php
                            $thumb = $product->productImages->where('is_thumbnail', true)->first();
                            if (!$thumb) $thumb = $product->productImages->first();
                        @endphp

                        <div class="relative h-72 overflow-hidden">
                            @if($thumb)
                            <a href="/product/{{ $product->slug }}">
                                <img src="{{ asset('storage/'.$thumb->image) }}" 
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                    alt="{{ $product->name }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            </a>
                            @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                <div class="text-center p-6">
                                    <div class="w-16 h-16 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 font-medium">Gambar Tidak Tersedia</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="absolute top-4 right-4 flex flex-col gap-2">
                            <button class="p-3 bg-white/90 backdrop-blur-sm rounded-2xl hover:bg-white hover:scale-110 hover:shadow-lg transition-all duration-300 group/wishlist">
                                <svg class="w-5 h-5 text-gray-600 group-hover/wishlist:text-red-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                            <button class="p-3 bg-white/90 backdrop-blur-sm rounded-2xl hover:bg-white hover:scale-110 hover:shadow-lg transition-all duration-300 group/share">
                                <svg class="w-5 h-5 text-gray-600 group-hover/share:text-blue-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Category Badge -->
                        @if($product->category)
                        <div class="absolute top-4 left-4">
                            <span class="px-4 py-2 bg-gradient-to-r from-blue-600/90 to-indigo-600/90 backdrop-blur-sm text-white text-sm font-medium rounded-xl shadow-md">
                                {{ $product->category->name }}
                            </span>
                        </div>
                        @endif

                        <!-- Discount Badge -->
                        @if($product->original_price > $product->price)
                        <div class="absolute bottom-4 left-4">
                            <span class="px-4 py-2 bg-gradient-to-r from-red-500 to-pink-500 text-white text-sm font-bold rounded-xl shadow-md">
                                {{ round((($product->original_price - $product->price) / $product->original_price) * 100) }}% OFF
                            </span>
                        </div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="p-6">
                        <a href="/product/{{ $product->slug }}" class="block group/link">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover/link:text-blue-600 transition-colors duration-300 line-clamp-2 min-h-[3.5rem]">
                                {{ $product->name }}
                            </h3>
                        </a>
                        
                        <!-- Price Section -->
                        <div class="mb-6">
                            <div class="flex items-end gap-2 mb-1">
                                <p class="text-2xl font-bold text-green-600">
                                    Rp {{ number_format($product->price,0,',','.') }}
                                </p>
                                @if($product->original_price > $product->price)
                                <p class="text-sm text-gray-400 line-through mb-1">
                                    Rp {{ number_format($product->original_price,0,',','.') }}
                                </p>
                                @endif
                            </div>
                            
                            <!-- Rating and Sold -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="flex">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= 4.8 ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">4.8</span>
                                    <span class="text-gray-400">•</span>
                                    <span class="text-sm text-gray-500">Terjual 120</span>
                                </div>
                                <div class="text-xs text-gray-500">
                                    Stok: <span class="font-bold text-green-600">{{ rand(10, 100) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Store Info -->
                        @if($product->store)
                        <div class="flex items-center pt-5 border-t border-gray-100 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-2xl flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-800">{{ $product->store->name }}</p>
                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $product->store->city }}
                                </div>
                            </div>
                            <div class="p-2 bg-green-50 rounded-lg">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        @endif

                        <!-- Action Button -->
                        <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="qty" value="1">
                            <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 active:scale-95 flex items-center justify-center group/button">
                                <svg class="w-5 h-5 mr-3 group-hover/button:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Empty State -->
            @if($products->isEmpty())
            <div class="text-center py-20 px-4">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-3xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Produk Tidak Ditemukan</h3>
                    <p class="text-gray-600 mb-8">Coba gunakan kata kunci lain atau filter yang berbeda untuk menemukan produk yang Anda cari.</p>
                    <button onclick="window.location.reload()" class="px-8 py-3.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                        Reset Pencarian
                    </button>
                </div>
            </div>
            @endif

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="mt-16">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-100 p-8">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                        <div class="text-gray-700">
                            <p class="font-medium">Menampilkan <span class="text-blue-600 font-bold">{{ $products->firstItem() }}</span> - 
                            <span class="text-blue-600 font-bold">{{ $products->lastItem() }}</span> dari 
                            <span class="text-blue-600 font-bold">{{ $products->total() }}</span> produk</p>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <!-- Previous Button -->
                            @if($products->onFirstPage())
                            <span class="px-5 py-3 bg-gray-100 text-gray-400 rounded-xl font-medium cursor-not-allowed flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Sebelumnya
                            </span>
                            @else
                            <a href="{{ $products->previousPageUrl() }}" class="px-5 py-3 bg-white border-2 border-gray-200 text-gray-700 rounded-xl font-medium hover:border-blue-500 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Sebelumnya
                            </a>
                            @endif

                            <!-- Page Numbers -->
                            <div class="flex items-center gap-2">
                                @php
                                    $current = $products->currentPage();
                                    $last = $products->lastPage();
                                    $start = max($current - 2, 1);
                                    $end = min($current + 2, $last);
                                @endphp
                                
                                @if($start > 1)
                                    <a href="{{ $products->url(1) }}" class="px-4 py-3 bg-white border-2 border-gray-200 text-gray-700 rounded-xl font-medium hover:border-blue-500 hover:bg-blue-50 transition-all duration-300">
                                        1
                                    </a>
                                    @if($start > 2)
                                        <span class="px-2 text-gray-400">...</span>
                                    @endif
                                @endif
                                
                                @for($page = $start; $page <= $end; $page++)
                                    @if($page == $current)
                                    <span class="px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl font-bold shadow-md">
                                        {{ $page }}
                                    </span>
                                    @else
                                    <a href="{{ $products->url($page) }}" class="px-4 py-3 bg-white border-2 border-gray-200 text-gray-700 rounded-xl font-medium hover:border-blue-500 hover:bg-blue-50 transition-all duration-300">
                                        {{ $page }}
                                    </a>
                                    @endif
                                @endfor
                                
                                @if($end < $last)
                                    @if($end < $last - 1)
                                        <span class="px-2 text-gray-400">...</span>
                                    @endif
                                    <a href="{{ $products->url($last) }}" class="px-4 py-3 bg-white border-2 border-gray-200 text-gray-700 rounded-xl font-medium hover:border-blue-500 hover:bg-blue-50 transition-all duration-300">
                                        {{ $last }}
                                    </a>
                                @endif
                            </div>

                            <!-- Next Button -->
                            @if($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}" class="px-5 py-3 bg-white border-2 border-gray-200 text-gray-700 rounded-xl font-medium hover:border-blue-500 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 flex items-center gap-2">
                                Selanjutnya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                            @else
                            <span class="px-5 py-3 bg-gray-100 text-gray-400 rounded-xl font-medium cursor-not-allowed flex items-center gap-2">
                                Selanjutnya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Newsletter Section -->
            <div class="mt-20 bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-8 md:p-12 text-center text-white overflow-hidden relative">
                <div class="absolute -right-12 -top-12 w-48 h-48 bg-white/10 rounded-full"></div>
                <div class="absolute -left-12 -bottom-12 w-48 h-48 bg-white/10 rounded-full"></div>
                
                <div class="relative z-10 max-w-2xl mx-auto">
                    <h2 class="text-3xl font-bold mb-4">Tetap Update dengan Produk Terbaru</h2>
                    <p class="text-blue-100 mb-8">Dapatkan notifikasi untuk produk baru, promo eksklusif, dan rekomendasi spesial untuk Anda.</p>
                    <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                        <input type="email" 
                            placeholder="Masukkan email Anda" 
                            class="flex-1 px-6 py-4 rounded-2xl text-gray-900 focus:outline-none focus:ring-4 focus:ring-white/30">
                        <button type="submit" class="px-8 py-4 bg-white text-blue-600 font-semibold rounded-2xl hover:bg-blue-50 transition-all duration-300 shadow-lg">
                            Berlangganan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .scrollbar-thin::-webkit-scrollbar {
            height: 6px;
        }
        .scrollbar-thin::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-app-layout>