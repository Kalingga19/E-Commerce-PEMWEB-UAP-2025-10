<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-green-100 to-emerald-100 rounded-2xl mb-6">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Konfirmasi Pembayaran</h1>
                <p class="text-gray-600 mt-2">Masukkan kode Virtual Account untuk verifikasi pembayaran</p>
            </div>

            <!-- Progress Steps -->
            <div class="mb-12">
                <div class="flex items-center justify-center">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">
                            1
                        </div>
                        <div class="w-32 h-1 bg-blue-600"></div>
                        <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">
                            2
                        </div>
                        <div class="w-32 h-1 bg-gray-300"></div>
                        <div class="w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold">
                            3
                        </div>
                    </div>
                </div>
                <div class="flex justify-between mt-4 text-sm text-center">
                    <span class="text-blue-600 font-medium">Pesanan</span>
                    <span class="text-blue-600 font-medium">Pembayaran</span>
                    <span class="text-gray-500">Konfirmasi</span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Payment Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100">
                            <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Masukkan Kode Virtual Account
                            </h3>
                        </div>
                        @if($va)
                        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                            <p class="text-gray-700 text-sm mb-1">Kode Virtual Account Anda:</p>
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-lg font-bold text-blue-700">
                                    {{ $va->va_code }}
                                </span>
                                <button onclick="navigator.clipboard.writeText('{{ $va->va_code }}')"
                                        class="px-3 py-1 text-sm bg-blue-600 text-white rounded-md">
                                    Copy
                                </button>
                            </div>
                        </div>
                    @endif

                        <form method="POST" action="{{ route('payment.process') }}" class="p-6">
                            @csrf
                            
                            <!-- VA Code Input -->
                            <div class="mb-8">
                                <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                    Kode Virtual Account
                                    <span class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Required</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" 
                                        name="va_code" 
                                        value="{{ $va ? $va->va_code : '' }}"
                                        class="pl-10 w-full px-4 py-3 text-lg border border-gray-300 rounded-xl"
                                        required>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Masukkan 16-digit kode Virtual Account yang Anda terima</p>
                            </div>

                            <!-- Order Reference -->
                            <div class="mb-8">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pesanan (Opsional)</label>
                                <input type="text" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                       placeholder="Contoh: ORD-20231215-001">
                                <p class="mt-2 text-sm text-gray-500">Berguna untuk membantu identifikasi jika ada kendala</p>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" 
                                    class="w-full py-4 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold text-lg rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-0.5 flex items-center justify-center group">
                                <svg class="w-6 h-6 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Konfirmasi Pembayaran
                            </button>
                        </form>
                    </div>

                    <!-- Security Notice -->
                    <div class="mt-6 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-2xl p-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 p-2 bg-white rounded-lg shadow-sm mr-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 mb-2">Pembayaran Aman & Terenkripsi</h4>
                                <p class="text-sm text-gray-600">Data pembayaran Anda dilindungi dengan enkripsi SSL 256-bit. Kami tidak menyimpan informasi kartu kredit atau data sensitif lainnya.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Bank Information -->
                <div class="space-y-6">
                    <!-- Supported Banks -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-100">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                Bank yang Didukung
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-red-600 font-bold text-sm">BCA</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">BCA Virtual Account</p>
                                        <p class="text-xs text-gray-500">Kode: 88880</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-blue-600 font-bold text-sm">BNI</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">BNI Virtual Account</p>
                                        <p class="text-xs text-gray-500">Kode: 88881</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-green-600 font-bold text-sm">BRI</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">BRI Virtual Account</p>
                                        <p class="text-xs text-gray-500">Kode: 88882</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-yellow-600 font-bold text-sm">MDR</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Mandiri Virtual Account</p>
                                        <p class="text-xs text-gray-500">Kode: 88883</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Instructions -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-purple-100">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Cara Pembayaran
                            </h3>
                        </div>
                        <div class="p-6">
                            <ol class="space-y-3 text-sm text-gray-600">
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs font-bold mr-3">1</span>
                                    Masukkan 16-digit kode Virtual Account
                                </li>
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs font-bold mr-3">2</span>
                                    Sistem akan memverifikasi pembayaran
                                </li>
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs font-bold mr-3">3</span>
                                    Status pesanan akan berubah menjadi "Dibayar"
                                </li>
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs font-bold mr-3">4</span>
                                    Anda akan menerima notifikasi email
                                </li>
                            </ol>
                        </div>
                    </div>

                    <!-- FAQ -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Pertanyaan Umum
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <p class="font-medium text-gray-800 text-sm">Berapa lama proses verifikasi?</p>
                                    <p class="text-xs text-gray-600 mt-1">Biasanya 1-5 menit setelah konfirmasi.</p>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800 text-sm">Jika kode tidak ditemukan?</p>
                                    <p class="text-xs text-gray-600 mt-1">Pastikan kode VA sudah benar atau hubungi bank Anda.</p>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800 text-sm">Bagaimana jika pembayaran gagal?</p>
                                    <p class="text-xs text-gray-600 mt-1">Coba beberapa saat lagi atau gunakan metode pembayaran lain.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Support -->
            <div class="mt-8 bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-100 rounded-2xl p-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center">
                        <div class="p-2 bg-amber-100 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Butuh Bantuan?</h4>
                            <p class="text-sm text-gray-600">Tim support kami siap membantu 24/7</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="tel:+6281234567890" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200 flex items-center text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            0812-3456-7890
                        </a>
                        <a href="mailto:payment@ecommerce.com" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200 flex items-center text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            payment@ecommerce.com
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Transaksi Terakhir</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-white p-4 rounded-xl border border-gray-200">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-gray-600">TRX-001</span>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Berhasil</span>
                        </div>
                        <p class="text-lg font-bold text-gray-800">Rp 450.000</p>
                        <p class="text-xs text-gray-500">15 menit lalu</p>
                    </div>
                    
                    <div class="bg-white p-4 rounded-xl border border-gray-200">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-gray-600">TRX-002</span>
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Pending</span>
                        </div>
                        <p class="text-lg font-bold text-gray-800">Rp 325.000</p>
                        <p class="text-xs text-gray-500">2 jam lalu</p>
                    </div>
                    
                    <div class="bg-white p-4 rounded-xl border border-gray-200">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-gray-600">TRX-003</span>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Berhasil</span>
                        </div>
                        <p class="text-lg font-bold text-gray-800">Rp 780.000</p>
                        <p class="text-xs text-gray-500">1 hari lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>