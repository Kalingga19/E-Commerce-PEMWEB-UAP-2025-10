<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl shadow-lg mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-3">Buat Pesanan Manual</h1>
                <p class="text-gray-600 max-w-lg mx-auto">
                    Buat pesanan secara manual untuk keperluan khusus
                </p>
            </div>

            <!-- Information Alert -->
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-2xl p-6 mb-8">
                <div class="flex items-start">
                    <div class="flex-shrink-0 p-2 bg-amber-100 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Catatan Penting</h3>
                        <p class="text-gray-700">
                            Biasanya seller tidak membuat pesanan manual. Form ini disediakan untuk kebutuhan khusus 
                            seperti pesanan offline, order via telepon, atau situasi darurat lainnya.
                        </p>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Untuk pesanan khusus</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Order via telepon/offline</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-xl font-semibold text-gray-900">Detail Pesanan</h2>
                    <p class="text-sm text-gray-500 mt-1">Isi informasi pesanan manual</p>
                </div>

                <form action="{{ route('seller.orders.store') }}" method="POST" class="px-8 py-8">
                    @csrf

                    <div class="space-y-8">
                        <!-- Buyer Information -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Nama Pembeli
                                </span>
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       name="buyer" 
                                       placeholder="Masukkan nama lengkap pembeli"
                                       class="block w-full pl-12 pr-4 py-4 border border-gray-300 rounded-xl
                                              focus:ring-3 focus:ring-blue-500 focus:border-blue-500 
                                              placeholder-gray-400 transition duration-200
                                              @error('buyer') border-red-500 @enderror">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('buyer')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Nama pembeli untuk identifikasi pesanan</p>
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    Nomor Telepon (Opsional)
                                </span>
                            </label>
                            <div class="relative">
                                <input type="tel" 
                                       name="phone" 
                                       placeholder="Contoh: 081234567890"
                                       class="block w-full pl-12 pr-4 py-4 border border-gray-300 rounded-xl
                                              focus:ring-3 focus:ring-blue-500 focus:border-blue-500 
                                              placeholder-gray-400 transition duration-200">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Untuk konfirmasi dan update pengiriman</p>
                        </div>

                        <!-- Order Items Section -->
                        <div class="border-t border-gray-200 pt-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6">Item Pesanan</h3>
                            
                            <div class="space-y-6">
                                <!-- Product Selection -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Pilih Produk</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                        <select class="block w-full pl-12 pr-10 py-4 border border-gray-300 rounded-xl
                                                       focus:ring-3 focus:ring-blue-500 focus:border-blue-500 
                                                       focus:outline-none transition duration-200
                                                       appearance-none bg-white">
                                            <option value="" selected disabled>Pilih produk dari katalog</option>
                                            <!-- Product options would be populated dynamically -->
                                            <option value="1">Produk 1 - Rp 100.000</option>
                                            <option value="2">Produk 2 - Rp 150.000</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quantity & Price -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-3">Jumlah</label>
                                        <div class="flex items-center border border-gray-300 rounded-xl">
                                            <button type="button" 
                                                    class="w-12 h-12 flex items-center justify-center text-gray-600 hover:bg-gray-100 rounded-l-xl">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                </svg>
                                            </button>
                                            <div class="flex-1 text-center">
                                                <input type="number" 
                                                       min="1" 
                                                       value="1"
                                                       class="w-full py-4 text-center border-0 focus:ring-0 text-lg font-medium">
                                            </div>
                                            <button type="button" 
                                                    class="w-12 h-12 flex items-center justify-center text-gray-600 hover:bg-gray-100 rounded-r-xl">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-3">Harga Satuan</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <span class="text-gray-500 font-medium">Rp</span>
                                            </div>
                                            <input type="number" 
                                                   min="0"
                                                   placeholder="0"
                                                   class="block w-full pl-12 pr-4 py-4 border border-gray-300 rounded-xl
                                                          focus:ring-3 focus:ring-blue-500 focus:border-blue-500 
                                                          placeholder-gray-400 transition duration-200">
                                        </div>
                                    </div>
                                </div>

                                <!-- Add More Products Button -->
                                <button type="button" 
                                        class="w-full p-4 border-2 border-dashed border-gray-300 rounded-xl 
                                               hover:border-blue-400 hover:bg-blue-50 transition-colors duration-200
                                               text-gray-600 hover:text-blue-600">
                                    <div class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        Tambah Produk Lainnya
                                    </div>
                                </button>
                            </div>
                        </div>

                        <!-- Notes Section -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                    </svg>
                                    Catatan Pesanan
                                </span>
                            </label>
                            <div class="relative">
                                <textarea name="note" 
                                          rows="4"
                                          placeholder="Tulis catatan khusus untuk pesanan ini, seperti preferensi pengiriman, waktu pengiriman, atau instruksi khusus lainnya..."
                                          class="block w-full px-4 py-4 border border-gray-300 rounded-xl
                                                 focus:ring-3 focus:ring-blue-500 focus:border-blue-500 
                                                 focus:outline-none transition duration-200 resize-none
                                                 placeholder-gray-400
                                                 @error('note') border-red-500 @enderror"></textarea>
                            </div>
                            @error('note')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Catatan akan ditampilkan di detail pesanan</p>
                        </div>

                        <!-- Order Summary -->
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Subtotal (1 item)</span>
                                    <span class="font-medium text-gray-900">Rp 100.000</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Biaya Pengiriman</span>
                                    <span class="font-medium text-gray-900">Rp 15.000</span>
                                </div>
                                <div class="border-t border-gray-200 pt-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-semibold text-gray-900">Total</span>
                                        <div class="text-right">
                                            <div class="text-2xl font-bold text-gray-900">Rp 115.000</div>
                                            <div class="text-sm text-gray-500">Termasuk PPN 11%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-2 bg-blue-100 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-blue-800">
                                        Dengan membuat pesanan manual, Anda menyetujui bahwa pesanan ini valid dan 
                                        telah disetujui oleh pembeli sesuai 
                                        <a href="#" class="font-medium underline hover:text-blue-900">ketentuan platform</a>.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="pt-4">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <div class="text-sm text-gray-600">
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        Pesanan manual akan tercatat dalam sistem
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
                                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Buat Pesanan Manual
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Usage Tips -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-green-100 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Kapan Digunakan</p>
                            <p class="text-sm text-gray-600">Untuk order via telepon atau offline</p>
                        </div>
                    </div>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Pesanan dari pelanggan offline</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Order via WhatsApp/Telepon</span>
                        </li>
                    </ul>
                </div>
                
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-amber-100 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Perhatian</p>
                            <p class="text-sm text-gray-600">Pastikan validitas pesanan</p>
                        </div>
                    </div>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-amber-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"></path>
                            </svg>
                            <span>Verifikasi dengan pembeli</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-amber-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"></path>
                            </svg>
                            <span>Pastikan pembayaran valid</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Quantity increment/decrement
        document.querySelectorAll('button[type="button"]').forEach(button => {
            if (button.textContent.includes('+') || button.textContent.includes('−')) {
                button.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('input[type="number"]');
                    if (this.textContent.includes('+')) {
                        input.value = parseInt(input.value) + 1;
                    } else {
                        if (parseInt(input.value) > 1) {
                            input.value = parseInt(input.value) - 1;
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>