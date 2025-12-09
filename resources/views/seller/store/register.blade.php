<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <!-- Header Card -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-lg mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-3">Mulai Toko Online Anda</h1>
                <p class="text-gray-600 max-w-lg mx-auto">
                    Isi informasi toko Anda untuk memulai perjalanan bisnis online bersama kami
                </p>
            </div>
            @if(isset($store))
                <p class="text-blue-600 font-medium text-center mb-6">
                    Anda sedang mengedit informasi toko: <b>{{ $store->name }}</b>
                </p>
            @endif

            <!-- Progress Steps -->
            <div class="mb-8">
                <div class="flex items-center justify-center mb-6">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 bg-blue-600 text-white rounded-full">
                            1
                        </div>
                        <div class="h-1 w-20 bg-blue-600"></div>
                    </div>
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 bg-blue-600 text-white rounded-full">
                            2
                        </div>
                        <div class="h-1 w-20 bg-gray-300"></div>
                    </div>
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 bg-gray-300 text-gray-500 rounded-full">
                            3
                        </div>
                    </div>
                </div>
                <div class="flex justify-between text-sm text-gray-600 max-w-md mx-auto">
                    <span class="font-medium text-blue-600">Informasi Toko</span>
                    <span>Verifikasi</span>
                    <span>Selesai</span>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Informasi Toko</h2>
                    <p class="text-sm text-gray-500 mt-1">Isi detail toko Anda dengan lengkap</p>
                </div>

                <form action="{{ isset($store) ? route('seller.store.update') : route('store.register.store') }}" method="POST" class="px-8 py-6">
                    @csrf
                    @if(isset($store))
                        @method('PUT')
                    @endif

                    <div class="space-y-6">
                        <!-- Nama Toko -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Toko
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="name" requiredvalue="{{ old('name', $store->name ?? '') }}"
                                    placeholder="Contoh: Toko Maju Jaya"
                                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg 
                                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                            placeholder-gray-400 transition duration-200
                                            @error('name') border-red-500 @enderror">
                            </div>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Nama toko akan menjadi identitas utama Anda</p>
                        </div>

                        <!-- No. HP -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nomor Telepon
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="phone" 
                                       value="{{ old('phone', $store->phone ?? '') }}"
                                       required
                                       placeholder="Contoh: 081234567890"
                                       class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg 
                                              focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                              placeholder-gray-400 transition duration-200
                                              @error('phone') border-red-500 @enderror">
                            </div>
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Untuk verifikasi dan notifikasi penting</p>
                        </div>

                        <!-- Kota -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Kota
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="city" 
                                       value="{{ old('city', $store->city ?? '') }}"
                                       required
                                       placeholder="Contoh: Jakarta Selatan"
                                       class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg 
                                              focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                              placeholder-gray-400 transition duration-200
                                              @error('city') border-red-500 @enderror">
                            </div>
                            @error('city')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Lokasi utama toko Anda</p>
                        </div>

                        <!-- Alamat Lengkap -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Alamat Lengkap
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute top-3 left-3 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    </svg>
                                </div>
                                <textarea name="address" 
                                          required
                                          rows="4"
                                          placeholder="Tulis alamat lengkap termasuk nomor rumah, RT/RW, dan kode pos"
                                          class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg 
                                                 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                                 placeholder-gray-400 transition duration-200 resize-none
                                                 @error('address') border-red-500 @enderror">{{ old('address', $store->address ?? '') }}</textarea>
                            </div>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Pastikan alamat sesuai untuk pengiriman produk</p>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-0.5">
                                    <svg class="h-5 w-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" 
                                              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" 
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-800">
                                        Dengan mendaftarkan toko, Anda menyetujui 
                                        <a href="#" class="font-medium underline hover:text-blue-900">Syarat dan Ketentuan</a> 
                                        serta 
                                        <a href="#" class="font-medium underline hover:text-blue-900">Kebijakan Privasi</a> kami.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit"
                                    class="w-full flex justify-center items-center px-6 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 
                                        text-white font-semibold rounded-lg shadow-lg hover:from-blue-700 hover:to-indigo-700 
                                        focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 
                                        transform hover:-translate-y-0.5 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                {{ isset($store) ? 'Perbarui Informasi Toko' : 'Daftarkan Toko Sekarang' }}
                            </button>
                            
                            <p class="mt-4 text-center text-sm text-gray-600">
                                Sudah punya toko? 
                                <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                                    Masuk ke akun Anda
                                </a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Features Section -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-2 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Aman & Terpercaya</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-2 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Proses Cepat</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-2 bg-orange-100 rounded-lg">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Dukungan 24/7</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>