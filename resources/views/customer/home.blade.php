<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Semua Produk</h1>
                        <p class="text-gray-600 mt-2">Temukan produk terbaik dari berbagai kategori</p>
                    </div>
                    
                    <!-- Search and Filter -->
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <form action="{{ route('search') }}" method="GET">
                                <input type="text" 
                                    placeholder="Cari produk..." 
                                    class="pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-64">
                            </form>
                        </div>
                        <button class="p-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition duration-200">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Categories Filter -->
                <div class="mb-8 overflow-x-auto">
                    <div class="flex space-x-2 pb-4">

                        {{-- Tombol semua produk --}}
                        <a href="{{ route('home') }}">
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-full font-medium hover:bg-blue-700 transition duration-200 whitespace-nowrap">
                                Semua
                            </button>
                        </a>

                        {{-- Tombol kategori --}}
                        @foreach($categories as $category)
                            <a href="{{ route('category.filter', $category->slug) }}">
                                <button class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-full font-medium hover:bg-gray-50 transition duration-200 whitespace-nowrap">
                                    {{ $category->name }}
                                </button>
                            </a>
                        @endforeach

                    </div>
                </div>


                <!-- Stats Bar -->
                <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            Menampilkan <span class="font-bold text-gray-800">{{ $products->count() }}</span> produk
                        </div>
                        <div class="flex items-center space-x-4">
                            <select onchange="location.href='/?sort='+this.value" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="latest">Urutkan: Terbaru</option>
                                <option value="price_asc">Harga: Rendah → Tinggi</option>
                                <option value="price_desc">Harga: Tinggi → Rendah</option>
                                <option value="name_asc">Nama: A-Z</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <!-- Product Image -->
                    <div class="relative overflow-hidden bg-gray-100">
                        @php
                            $thumb = $product->productImages->where('is_thumbnail', true)->first();
                            if (!$thumb) $thumb = $product->productImages->first();
                        @endphp

                        @if($thumb)
                        <a href="/product/{{ $product->slug }}">
                            <img src="{{ asset('storage/'.$thumb->image) }}" 
                                class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300"
                                alt="{{ $product->name }}">
                        </a>
                        @else
                        <div class="w-full h-64 flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                            <div class="text-center">
                                <svg class="w-12 h-12 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-gray-500 text-sm mt-2">No Image</p>
                            </div>
                        </div>
                        @endif

                        <!-- Wishlist Button -->
                        <button class="absolute top-4 right-4 p-2 bg-white/90 backdrop-blur-sm rounded-full hover:bg-white transition duration-200 group">
                            <svg class="w-5 h-5 text-gray-600 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </button>

                        <!-- Category Badge -->
                        @if($product->category)
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-blue-600/90 backdrop-blur-sm text-white text-xs font-medium rounded-full">
                                {{ $product->category->name }}
                            </span>
                        </div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="p-5">
                        <a href="/product/{{ $product->slug }}" class="block">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2 group-hover:text-blue-600 transition duration-200 line-clamp-2">
                                {{ $product->name }}
                            </h3>
                        </a>
                        
                        <!-- Price -->
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-2xl font-bold text-green-600">
                                    Rp {{ number_format($product->price,0,',','.') }}
                                </p>
                                @if($product->original_price > $product->price)
                                <p class="text-sm text-gray-400 line-through">
                                    Rp {{ number_format($product->original_price,0,',','.') }}
                                </p>
                                @endif
                            </div>
                            <!-- Rating -->
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <span class="text-sm text-gray-600 ml-1">4.8</span>
                            </div>
                        </div>

                        <!-- Store Info -->
                        @if($product->store)
                        <div class="flex items-center pt-4 border-t border-gray-100">
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">{{ $product->store->name }}</p>
                                <p class="text-xs text-gray-500">{{ $product->store->city }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Action Button -->
                        <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                            <button type="submit" class="w-full mt-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium rounded-xl transition duration-200 flex items-center justify-center group">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="qty" id="qty_for_cart" value="1">
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Empty State -->
            @if($products->isEmpty())
            <div class="text-center py-16">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <h3 class="mt-6 text-xl font-medium text-gray-900">Belum ada produk</h3>
                <p class="mt-2 text-gray-500">Coba cari dengan kata kunci lain atau filter yang berbeda.</p>
            </div>
            @endif

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="mt-12">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                            Menampilkan <span class="font-medium">{{ $products->firstItem() }}</span> - 
                            <span class="font-medium">{{ $products->lastItem() }}</span> dari 
                            <span class="font-medium">{{ $products->total() }}</span> produk
                        </div>
                        <div class="flex items-center space-x-2">
                            <!-- Previous Button -->
                            @if($products->onFirstPage())
                            <span class="px-4 py-2 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed">
                                Sebelumnya
                            </span>
                            @else
                            <a href="{{ $products->previousPageUrl() }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                                Sebelumnya
                            </a>
                            @endif

                            <!-- Page Numbers -->
                            @foreach(range(1, min(5, $products->lastPage())) as $page)
                                @if($page == $products->currentPage())
                                <span class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium">
                                    {{ $page }}
                                </span>
                                @else
                                <a href="{{ $products->url($page) }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                                    {{ $page }}
                                </a>
                                @endif
                            @endforeach

                            <!-- Next Button -->
                            @if($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                                Selanjutnya
                            </a>
                            @else
                            <span class="px-4 py-2 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed">
                                Selanjutnya
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Featured Categories -->
            @if(isset($categories) && $categories->count() > 0)
            <div class="mt-16">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Kategori Unggulan</h2>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                        Lihat semua
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($categories->take(4) as $category)
                    <a href="#" class="group bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 rounded-2xl p-6 hover:from-blue-100 hover:to-indigo-100 transition duration-300 transform hover:-translate-y-1">
                        <div class="p-3 bg-white rounded-xl w-fit mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $category->products_count ?? 0 }} produk</p>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>