<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-10">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg mr-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Manajemen Produk</h1>
                            <p class="text-gray-600 mt-1">Kelola semua produk dari berbagai toko</p>
                        </div>
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="flex flex-wrap gap-4">
                        <div class="bg-white border border-gray-200 rounded-xl p-4 min-w-[180px]">
                            <p class="text-sm font-medium text-gray-600 mb-1">Total Produk</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $products->total() }}</p>
                        </div>
                        <div class="bg-white border border-gray-200 rounded-xl p-4 min-w-[180px]">
                            <p class="text-sm font-medium text-gray-600 mb-1">Produk Aktif</p>
                            <p class="text-2xl font-bold text-green-600">
                                {{ $products->where('status', 'active')->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="mb-8">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Filter Produk</h3>
                            <p class="text-sm text-gray-600">Saring berdasarkan status dan kategori</p>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ request()->fullUrlWithQuery(['status' => null]) }}" 
                               class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 
                                      transition duration-200 {{ !request('status') ? 'bg-blue-50 border-blue-300 text-blue-700' : '' }}">
                                Semua Status
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" 
                               class="px-4 py-2 border border-green-300 text-green-700 rounded-lg hover:bg-green-50 
                                      transition duration-200 {{ request('status') == 'active' ? 'bg-green-50 border-green-400' : '' }}">
                                Aktif
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['status' => 'suspended']) }}" 
                               class="px-4 py-2 border border-red-300 text-red-700 rounded-lg hover:bg-red-50 
                                      transition duration-200 {{ request('status') == 'suspended' ? 'bg-red-50 border-red-400' : '' }}">
                                Ditangguhkan
                            </a>
                        </div>
                    </div>
                    
                    <!-- Search & Additional Filters -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cari Produk</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" 
                                       placeholder="Cari nama produk..." 
                                       class="block w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg 
                                              focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                              focus:outline-none transition duration-200">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg 
                                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                          focus:outline-none transition duration-200">
                                <option value="">Semua Kategori</option>
                                <!-- Category options would go here -->
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Toko</label>
                            <select class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg 
                                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                          focus:outline-none transition duration-200">
                                <option value="">Semua Toko</option>
                                <!-- Store options would go here -->
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Table -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Daftar Produk</h2>
                            <p class="text-sm text-gray-500 mt-1">
                                Menampilkan {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} produk
                            </p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="px-4 py-2.5 border border-gray-300 text-gray-700 font-medium rounded-lg 
                                          hover:bg-gray-50 transition-colors duration-200">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Export
                            </button>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        Produk
                                        <svg class="w-4 h-4 ml-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Toko
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Harga
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Stok
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($products as $product)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <!-- Product Column -->
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12 bg-gradient-to-br from-blue-100 to-indigo-100 
                                                    rounded-lg flex items-center justify-center mr-4">
                                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $product->name }}</div>
                                            <div class="text-sm text-gray-500">ID: PROD-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</div>
                                            <div class="text-xs text-gray-400 mt-1">
                                                Dibuat: {{ $product->created_at->format('d M Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Store Column -->
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($product->store)
                                            <div class="flex-shrink-0 h-8 w-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                                <svg class="h-4 w-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $product->store->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $product->store->city ?? '' }}</div>
                                            </div>
                                        @else
                                            <span class="text-gray-400 italic">-</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Category Column -->
                                <td class="px-6 py-5 whitespace-nowrap">
                                    @if($product->category)
                                        <span class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-medium rounded-full">
                                            {{ $product->category->name }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 italic">-</span>
                                    @endif
                                </td>

                                <!-- Price Column -->
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="text-lg font-bold text-gray-900">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </div>
                                </td>

                                <!-- Stock Column -->
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-24 bg-gray-200 rounded-full h-2.5 mr-3">
                                            @php
                                                $stockPercentage = min(100, ($product->stock / 100) * 100);
                                                $stockColor = $product->stock > 50 ? 'bg-green-500' : ($product->stock > 10 ? 'bg-yellow-500' : 'bg-red-500');
                                            @endphp
                                            <div class="h-2.5 rounded-full {{ $stockColor }}" 
                                                 style="width: {{ $stockPercentage }}%"></div>
                                        </div>
                                        <span class="font-medium text-gray-900 {{ $product->stock == 0 ? 'text-red-600' : '' }}">
                                            {{ $product->stock }}
                                        </span>
                                    </div>
                                </td>

                                <!-- Status Column -->
                                <td class="px-6 py-5 whitespace-nowrap">
                                    @if($product->status == 'active')
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                            <span class="px-3 py-1.5 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                                Aktif
                                            </span>
                                        </div>
                                    @else
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                                            <span class="px-3 py-1.5 bg-red-100 text-red-800 text-xs font-medium rounded-full">
                                                Ditangguhkan
                                            </span>
                                        </div>
                                    @endif
                                </td>

                                <!-- Actions Column -->
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center space-x-3">
                                        <!-- View Button -->
                                        <a href="{{ route('admin.products.show', $product) }}"
                                           class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg 
                                                  transition-colors duration-200"
                                           title="Lihat Detail">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                           class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg 
                                                  transition-colors duration-200"
                                           title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>

                                        <!-- Status Toggle Button -->
                                        @if($product->status == 'active')
                                            <form method="POST"
                                                  action="{{ route('admin.products.suspend', $product) }}"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menangguhkan produk ini?')"
                                                  class="inline">
                                                @csrf @method('PATCH')
                                                <button type="submit"
                                                        class="p-2 text-gray-600 hover:text-orange-600 hover:bg-orange-50 rounded-lg 
                                                               transition-colors duration-200"
                                                        title="Tangguhkan">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                              d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST"
                                                  action="{{ route('admin.products.activate', $product) }}"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin mengaktifkan kembali produk ini?')"
                                                  class="inline">
                                                @csrf @method('PATCH')
                                                <button type="submit"
                                                        class="p-2 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg 
                                                               transition-colors duration-200"
                                                        title="Aktifkan">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Delete Button -->
                                        <form method="POST"
                                              action="{{ route('admin.products.destroy', $product) }}"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
                                              class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    class="p-2 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg 
                                                           transition-colors duration-200"
                                                    title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Empty State -->
                @if($products->count() == 0)
                <div class="text-center py-16">
                    <div class="p-4 bg-gray-100 rounded-full inline-flex mb-6">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Produk</h3>
                    <p class="text-gray-600 max-w-md mx-auto mb-8">
                        Tidak ada produk yang terdaftar di sistem. Seller belum menambahkan produk apapun.
                    </p>
                </div>
                @endif

                <!-- Pagination -->
                @if($products->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }} dari {{ $products->total() }} produk
                        </div>
                        <div class="flex space-x-2">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Information Card -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 p-3 bg-blue-100 rounded-xl mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Tips Manajemen Produk</h4>
                            <ul class="space-y-2 text-sm text-gray-700">
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Tinjau produk secara berkala untuk memastikan kualitas</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Tangguhkan produk yang melanggar ketentuan platform</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 p-3 bg-green-100 rounded-xl mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Peran Admin</h4>
                            <p class="text-sm text-gray-700">
                                Sebagai admin, Anda memiliki tanggung jawab untuk menjaga kualitas produk di platform. 
                                Pastikan semua produk memenuhi standar dan ketentuan yang berlaku.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>