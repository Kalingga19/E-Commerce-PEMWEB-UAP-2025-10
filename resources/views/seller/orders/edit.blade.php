<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="mb-10">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <a href="{{ route('seller.orders.index') }}" 
                           class="mr-4 p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Update Status Pesanan</h1>
                            <p class="text-gray-600 mt-1">Perbarui status untuk pesanan #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>

                <!-- Order Info Card -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6 mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                        <div class="flex items-center">
                            <div class="p-4 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg mr-6">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">Pesanan #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h2>
                                <div class="flex flex-wrap items-center gap-4 mt-2">
                                    <span class="text-gray-600">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </span>
                                    <span class="text-gray-600">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="md:text-right">
                            <div class="text-sm font-medium text-gray-600 mb-1">Pembeli</div>
                            <div class="text-lg font-semibold text-gray-900">{{ $order->customer_name ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Status Update -->
                <div class="lg:col-span-2">
                    <!-- Status Update Card -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                        <div class="px-8 py-6 border-b border-gray-200 bg-gray-50">
                            <h2 class="text-xl font-semibold text-gray-900">Update Status Pesanan</h2>
                            <p class="text-sm text-gray-500 mt-1">Perbarui status sesuai perkembangan pesanan</p>
                        </div>

                        <form action="{{ route('seller.orders.update', $order->id) }}" method="POST" class="px-8 py-8">
                            @csrf
                            @method('PUT')

                            <div class="space-y-8">
                                <!-- Current Status -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">
                                        <span class="flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Status Saat Ini
                                        </span>
                                    </label>
                                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-xl">
                                        <div class="flex items-center">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                                    'processing' => 'bg-blue-100 text-blue-800',
                                                    'shipped' => 'bg-indigo-100 text-indigo-800',
                                                    'completed' => 'bg-green-100 text-green-800',
                                                    'cancelled' => 'bg-red-100 text-red-800'
                                                ];
                                                $statusIcons = [
                                                    'pending' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                                                    'processing' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15',
                                                    'shipped' => 'M5 13l4 4L19 7',
                                                    'completed' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                                                    'cancelled' => 'M6 18L18 6M6 6l12 12'
                                                ];
                                            @endphp
                                            <div class="p-2 {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }} rounded-lg mr-3">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="{{ $statusIcons[$order->status] ?? 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' }}"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="text-lg font-semibold capitalize">{{ $order->status }}</span>
                                                <p class="text-sm text-gray-600 mt-1">Terakhir diupdate: {{ $order->updated_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- New Status Selection -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">
                                        <span class="flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                            </svg>
                                            Status Baru
                                            <span class="text-red-500 ml-1">*</span>
                                        </span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                            </svg>
                                        </div>
                                        <select name="status" 
                                                class="block w-full pl-12 pr-10 py-4 border border-gray-300 rounded-xl
                                                       focus:ring-3 focus:ring-blue-500 focus:border-blue-500 
                                                       focus:outline-none transition duration-200
                                                       appearance-none bg-white text-lg font-medium
                                                       @error('status') border-red-500 @enderror">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }} class="py-2">Pending</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }} class="py-2">Diproses</option>
                                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }} class="py-2">Dikirim</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }} class="py-2">Selesai</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    @error('status')
                                        <div class="mt-2 flex items-center text-sm text-red-600">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Status Descriptions -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="border border-blue-200 rounded-xl p-4 hover:bg-blue-50 transition-colors duration-200">
                                        <div class="flex items-center mb-2">
                                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-2">
                                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-600">Menunggu konfirmasi pembayaran</p>
                                    </div>
                                    
                                    <div class="border border-indigo-200 rounded-xl p-4 hover:bg-indigo-50 transition-colors duration-200">
                                        <div class="flex items-center mb-2">
                                            <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-2">
                                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                </svg>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">Diproses</span>
                                        </div>
                                        <p class="text-xs text-gray-600">Sedang dipersiapkan untuk dikirim</p>
                                    </div>
                                    
                                    <div class="border border-purple-200 rounded-xl p-4 hover:bg-purple-50 transition-colors duration-200">
                                        <div class="flex items-center mb-2">
                                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-2">
                                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">Dikirim</span>
                                        </div>
                                        <p class="text-xs text-gray-600">Sudah dikirim ke kurir/pembeli</p>
                                    </div>
                                    
                                    <div class="border border-green-200 rounded-xl p-4 hover:bg-green-50 transition-colors duration-200">
                                        <div class="flex items-center mb-2">
                                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-2">
                                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">Selesai</span>
                                        </div>
                                        <p class="text-xs text-gray-600">Pesanan sudah diterima pembeli</p>
                                    </div>
                                </div>

                                <!-- Additional Notes -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">
                                        <span class="flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                            </svg>
                                            Catatan Update (Opsional)
                                        </span>
                                    </label>
                                    <textarea name="notes" 
                                              rows="3"
                                              placeholder="Tambahkan catatan untuk pembaruan status ini, misal: nomor resi, estimasi pengiriman, atau informasi penting lainnya..."
                                              class="block w-full px-4 py-3 border border-gray-300 rounded-lg
                                                     focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                                     focus:outline-none transition duration-200 resize-none
                                                     placeholder-gray-400"></textarea>
                                    <p class="mt-1 text-xs text-gray-500">Catatan akan dikirim ke pembeli sebagai notifikasi</p>
                                </div>

                                <!-- Form Actions -->
                                <div class="pt-4">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                        <div class="text-sm text-gray-600">
                                            <p class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Update status akan dikirimkan ke pembeli
                                            </p>
                                        </div>
                                        <div class="flex space-x-4">
                                            <a href="{{ route('seller.orders.index') }}"
                                               class="px-8 py-3.5 border border-gray-300 text-gray-700 font-medium rounded-xl 
                                                      hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 
                                                      focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200">
                                                Batal
                                            </a>
                                            <button type="submit"
                                                    class="px-8 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 
                                                           text-white font-semibold rounded-xl shadow-lg 
                                                           hover:from-blue-700 hover:to-indigo-700 
                                                           focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 
                                                           transform hover:-translate-y-0.5 transition-all duration-200">
                                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                                </svg>
                                                Simpan Perubahan Status
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Column - Order Details & Timeline -->
                <div class="space-y-8">
                    <!-- Order Details -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900">Detail Pesanan</h3>
                        </div>
                        
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-600 mb-1">Total Pesanan</p>
                                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm font-medium text-gray-600 mb-1">Jumlah Item</p>
                                    <p class="text-lg font-medium text-gray-900">{{ $order->items_count ?? 1 }} produk</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm font-medium text-gray-600 mb-1">Metode Pembayaran</p>
                                    <p class="text-lg font-medium text-gray-900">{{ $order->payment_method ?? 'Transfer Bank' }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm font-medium text-gray-600 mb-1">Alamat Pengiriman</p>
                                    <p class="text-sm text-gray-900">{{ $order->shipping_address ?? 'Belum diatur' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Timeline -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900">Linimasa Status</h3>
                        </div>
                        
                        <div class="p-6">
                            <div class="space-y-6">
                                <!-- Timeline Item -->
                                <div class="relative">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">Pesanan Dibuat</p>
                                            <p class="text-xs text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Timeline Item -->
                                <div class="relative">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">Menunggu Pembayaran</p>
                                            <p class="text-xs text-gray-500">{{ $order->created_at->addHours(1)->format('d M Y, H:i') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Current Status -->
                                <div class="relative">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-indigo-100 border-2 border-indigo-500 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">Status Saat Ini</p>
                                            <p class="text-xs text-gray-500">{{ $order->updated_at->format('d M Y, H:i') }}</p>
                                            <p class="text-sm text-indigo-600 font-medium mt-1 capitalize">{{ $order->status }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 p-2 bg-blue-100 rounded-lg mr-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Panduan Update</h4>
                                <ul class="space-y-2 text-sm text-gray-700">
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Update status secara berkala</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Tambahkan catatan untuk kejelasan</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>