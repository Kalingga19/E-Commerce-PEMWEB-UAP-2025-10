<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-10">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <a href="{{ route('seller.products.index') }}" 
                           class="mr-4 p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Detail Produk</h1>
                            <p class="text-gray-600 mt-1">Kelola dan pantau informasi produk Anda</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                            ID: PROD-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>
                </div>

                <!-- Product Header Card -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6 mb-8">
                    <div class="flex items-center">
                        <div class="p-4 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg mr-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h2>
                            <div class="flex items-center space-x-4 mt-2">
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                    {{ $product->category->name ?? 'Tanpa Kategori' }}
                                </span>
                                <span class="text-gray-600">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Dibuat: {{ $product->created_at->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Product Images -->
                <div class="lg:col-span-2">
                    <!-- Image Gallery -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden mb-8">
                        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-xl font-semibold text-gray-900">Galeri Produk</h3>
                        </div>
                        
                        <div class="p-6">
                            @if($product->productImages->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @foreach($product->productImages as $img)
                                    <div class="relative group">
                                        <div class="aspect-w-4 aspect-h-3 bg-gray-100 rounded-xl overflow-hidden">
                                            <img src="{{ asset('storage/' . $img->image) }}" 
                                                 alt="{{ $product->name }}"
                                                 class="w-full h-64 object-cover rounded-xl transform group-hover:scale-105 transition-transform duration-300">
                                        </div>
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 
                                                    transition-all duration-300 rounded-xl"></div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <div class="p-4 bg-gray-100 rounded-full inline-flex mb-4">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Gambar</h4>
                                    <p class="text-gray-600 max-w-md mx-auto mb-8">
                                        Produk ini belum memiliki gambar. Tambahkan gambar untuk meningkatkan daya tarik produk.
                                    </p>
                                    <a href="{{ route('seller.products.edit', $product->id) }}" 
                                       class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 
                                              text-white font-medium rounded-lg hover:from-blue-700 hover:to-indigo-700 
                                              transition-all duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Tambah Gambar
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Product Description -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-xl font-semibold text-gray-900">Deskripsi Produk</h3>
                        </div>
                        
                        <div class="p-6">
                            @if($product->description)
                                <div class="prose max-w-none">
                                    <p class="text-gray-700 whitespace-pre-line text-lg leading-relaxed">
                                        {{ $product->description }}
                                    </p>
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <div class="p-4 bg-gray-100 rounded-full inline-flex mb-4">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Deskripsi</h4>
                                    <p class="text-gray-600 max-w-md mx-auto mb-8">
                                        Tambahkan deskripsi produk untuk membantu pelanggan memahami produk Anda dengan lebih baik.
                                    </p>
                                    <a href="{{ route('seller.products.edit', $product->id) }}" 
                                       class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 
                                              text-white font-medium rounded-lg hover:from-blue-700 hover:to-indigo-700 
                                              transition-all duration-200">
                                        Tambah Deskripsi
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column - Product Details & Actions -->
                <div class="space-y-8">
                    <!-- Product Stats -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900">Statistik Produk</h3>
                        </div>
                        
                        <div class="p-6">
                            <div class="space-y-6">
                                <!-- Price -->
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <p class="text-sm font-medium text-gray-600">Harga</p>
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-3xl font-bold text-gray-900">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                </div>
                                
                                <!-- Stock -->
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <p class="text-sm font-medium text-gray-600">Stok Tersedia</p>
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                        </svg>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 mr-3">
                                            @php
                                                $stockPercentage = min(100, ($product->stock / 100) * 100);
                                                $stockColor = $product->stock > 50 ? 'bg-green-500' : ($product->stock > 10 ? 'bg-yellow-500' : 'bg-red-500');
                                            @endphp
                                            <div class="h-2.5 rounded-full {{ $stockColor }}" 
                                                 style="width: {{ $stockPercentage }}%"></div>
                                        </div>
                                        <span class="text-2xl font-bold text-gray-900 {{ $product->stock == 0 ? 'text-red-600' : '' }}">
                                            {{ $product->stock }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">
                                        @if($product->stock > 50)
                                            <span class="text-green-600">✓ Stok melimpah</span>
                                        @elseif($product->stock > 10)
                                            <span class="text-yellow-600">⚠ Stok sedang</span>
                                        @elseif($product->stock > 0)
                                            <span class="text-red-600">⏳ Stok menipis</span>
                                        @else
                                            <span class="text-red-600">✗ Stok habis</span>
                                        @endif
                                    </p>
                                </div>
                                
                                <!-- Views -->
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <p class="text-sm font-medium text-gray-600">Total Dilihat</p>
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-2xl font-bold text-gray-900">1.2K</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category & Details -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Detail</h3>
                        </div>
                        
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-600 mb-1">Kategori</p>
                                    <div class="flex items-center">
                                        <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                            </svg>
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $product->category->name ?? 'Tanpa Kategori' }}</span>
                                    </div>
                                </div>
                                
                                <div>
                                    <p class="text-sm font-medium text-gray-600 mb-1">Tanggal Dibuat</p>
                                    <div class="flex items-center">
                                        <div class="p-2 bg-gray-100 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $product->created_at->format('d F Y') }}</span>
                                    </div>
                                </div>
                                
                                <div>
                                    <p class="text-sm font-medium text-gray-600 mb-1">Terakhir Diupdate</p>
                                    <div class="flex items-center">
                                        <div class="p-2 bg-green-100 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $product->updated_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900">Aksi Cepat</h3>
                        </div>
                        
                        <div class="p-6">
                            <div class="space-y-4">
                                <a href="{{ route('seller.products.edit', $product->id) }}" 
                                   class="flex items-center p-3 border border-blue-200 rounded-lg hover:bg-blue-50 
                                          transition-colors duration-200 group">
                                    <div class="p-2 bg-blue-100 rounded-lg mr-3 group-hover:bg-blue-200">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-900">Edit Produk</span>
                                </a>
                                
                                <form action="{{ route('seller.products.destroy', $product->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
                                      class="inline w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full flex items-center p-3 border border-red-200 rounded-lg 
                                                   hover:bg-red-50 transition-colors duration-200 group">
                                        <div class="p-2 bg-red-100 rounded-lg mr-3 group-hover:bg-red-200">
                                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </div>
                                        <span class="font-medium text-red-600">Hapus Produk</span>
                                    </button>
                                </form>
                                
                                <a href="{{ route('seller.products.index') }}" 
                                   class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 
                                          transition-colors duration-200 group">
                                    <div class="p-2 bg-gray-100 rounded-lg mr-3 group-hover:bg-gray-200">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-900">Kembali ke Daftar</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Status Info -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 p-2 bg-blue-100 rounded-lg mr-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Status Produk</h4>
                                <p class="text-sm text-gray-700">
                                    @if($product->is_active ?? true)
                                        Produk ini <span class="font-medium text-green-600">aktif</span> dan dapat dilihat oleh pelanggan di toko Anda.
                                    @else
                                        Produk ini <span class="font-medium text-red-600">nonaktif</span> dan tidak terlihat oleh pelanggan.
                                    @endif
                                </p>
                                <a href="{{ route('seller.products.edit', $product->id) }}" 
                                   class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 mt-2">
                                    Ubah status
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>