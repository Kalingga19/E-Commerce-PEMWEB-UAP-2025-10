<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            @if (session('success'))
                <div class="mb-4 rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-green-800 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-red-800 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                            <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Topup Saldo Dompet
                        </h1>
                        <p class="text-gray-600 mt-2 ml-11">Isi saldo dompet Anda untuk kemudahan bertransaksi</p>
                    </div>
                    
                    <!-- Current Balance -->
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-2xl p-6 shadow-lg">
                        <p class="text-sm opacity-90 mb-1">Saldo Saat Ini</p>
                        <p class="text-3xl font-bold">Rp 1.250.000</p>
                        <div class="flex items-center mt-2 text-sm opacity-90">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Saldo aktif dan siap digunakan
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    <div class="bg-white border border-gray-200 rounded-xl p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Topup Terakhir</p>
                                <p class="text-xl font-bold text-gray-800">Rp 500.000</p>
                            </div>
                            <div class="p-2 bg-green-100 rounded-lg">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">2 hari yang lalu</p>
                    </div>
                    
                    <div class="bg-white border border-gray-200 rounded-xl p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Total Topup</p>
                                <p class="text-xl font-bold text-gray-800">Rp 3.250.000</p>
                            </div>
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Sejak bergabung</p>
                    </div>
                    
                    <div class="bg-white border border-gray-200 rounded-xl p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Transaksi Bulan Ini</p>
                                <p class="text-xl font-bold text-gray-800">8 transaksi</p>
                            </div>
                            <div class="p-2 bg-purple-100 rounded-lg">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Aktifitas pembelian</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Topup Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-100">
                            <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Isi Jumlah Topup
                            </h3>
                        </div>
                        
                        <form method="POST" action="/wallet/topup" class="p-6">
                            @csrf
                            
                            <!-- Amount Input -->
                            <div class="mb-8">
                                <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                    Jumlah Topup (Rp)
                                    <span class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Required</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 font-bold">Rp</span>
                                    </div>
                                    <input type="number" 
                                           name="amount" 
                                           id="amount"
                                           class="pl-12 w-full px-4 py-3 text-2xl border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 font-bold"
                                           placeholder="0"
                                           required
                                           min="10000"
                                           step="10000"
                                           oninput="updateSuggestedAmounts(this.value)">
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Minimum topup: Rp 10.000</p>
                            </div>

                            <!-- Quick Amount Buttons -->
                            <div class="mb-8">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Jumlah Cepat:</label>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                    <button type="button" 
                                            onclick="setAmount(50000)" 
                                            class="py-3 bg-gray-100 hover:bg-blue-100 text-gray-800 hover:text-blue-700 font-medium rounded-xl transition duration-200 border-2 border-transparent hover:border-blue-300">
                                        Rp 50.000
                                    </button>
                                    <button type="button" 
                                            onclick="setAmount(100000)" 
                                            class="py-3 bg-gray-100 hover:bg-blue-100 text-gray-800 hover:text-blue-700 font-medium rounded-xl transition duration-200 border-2 border-transparent hover:border-blue-300">
                                        Rp 100.000
                                    </button>
                                    <button type="button" 
                                            onclick="setAmount(250000)" 
                                            class="py-3 bg-gray-100 hover:bg-blue-100 text-gray-800 hover:text-blue-700 font-medium rounded-xl transition duration-200 border-2 border-transparent hover:border-blue-300">
                                        Rp 250.000
                                    </button>
                                    <button type="button" 
                                            onclick="setAmount(500000)" 
                                            class="py-3 bg-gray-100 hover:bg-blue-100 text-gray-800 hover:text-blue-700 font-medium rounded-xl transition duration-200 border-2 border-transparent hover:border-blue-300">
                                        Rp 500.000
                                    </button>
                                </div>
                            </div>

                            <!-- Bank Selection -->
                            <div class="mb-8">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Pilih Bank:</label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="relative">
                                        <input type="radio" 
                                               name="bank" 
                                               id="bank_bca" 
                                               value="bca" 
                                               class="sr-only"
                                               checked>
                                        <label for="bank_bca" 
                                               class="flex items-center p-4 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-blue-500 transition duration-200 peer-checked:border-blue-500 peer-checked:bg-blue-50">
                                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                                                <span class="text-red-600 font-bold">BCA</span>
                                            </div>
                                            <div class="flex-1">
                                                <span class="font-medium text-gray-800">BCA Virtual Account</span>
                                            </div>
                                            <svg class="w-5 h-5 text-blue-600 hidden peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </label>
                                    </div>

                                    <div class="relative">
                                        <input type="radio" 
                                               name="bank" 
                                               id="bank_mandiri" 
                                               value="mandiri" 
                                               class="sr-only">
                                        <label for="bank_mandiri" 
                                               class="flex items-center p-4 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-blue-500 transition duration-200 peer-checked:border-blue-500 peer-checked:bg-blue-50">
                                            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                                                <span class="text-yellow-600 font-bold">MDR</span>
                                            </div>
                                            <div class="flex-1">
                                                <span class="font-medium text-gray-800">Mandiri Virtual Account</span>
                                            </div>
                                            <svg class="w-5 h-5 text-blue-600 hidden peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="mb-8 p-4 bg-gray-50 rounded-xl">
                                <div class="flex items-start">
                                    <input type="checkbox" 
                                           id="terms" 
                                           class="mt-1 mr-3 rounded border-gray-300 text-blue-600 focus:ring-blue-500" 
                                           required>
                                    <label for="terms" class="text-sm text-gray-600">
                                        Saya menyetujui <a href="#" class="text-blue-600 hover:underline">Syarat & Ketentuan</a> topup saldo dompet. 
                                        Saldo yang sudah ditopup tidak dapat dikembalikan dalam bentuk uang tunai.
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" 
                                    class="w-full py-4 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-bold text-lg rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-0.5 flex items-center justify-center group">
                                <svg class="w-6 h-6 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Buat Virtual Account
                            </button>
                        </form>
                    </div>

                    <!-- Security Notice -->
                    <div class="mt-6 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100 rounded-2xl p-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 p-2 bg-white rounded-lg shadow-sm mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 mb-2">Transaksi Aman & Terjamin</h4>
                                <p class="text-sm text-gray-600">Pembayaran melalui Virtual Account dilindungi dengan sistem keamanan bank. 
                                Data transaksi Anda terenkripsi dan tidak disimpan di server kami.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Information -->
                <div class="space-y-6">
                    <!-- How It Works -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-purple-100">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Cara Topup Saldo
                            </h3>
                        </div>
                        <div class="p-6">
                            <ol class="space-y-4">
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-sm font-bold mr-3">1</span>
                                    <div>
                                        <p class="font-medium text-gray-800">Masukkan jumlah topup</p>
                                        <p class="text-sm text-gray-600 mt-1">Minimal Rp 10.000</p>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-sm font-bold mr-3">2</span>
                                    <div>
                                        <p class="font-medium text-gray-800">Pilih bank tujuan</p>
                                        <p class="text-sm text-gray-600 mt-1">BCA, Mandiri, BRI, atau BNI</p>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-sm font-bold mr-3">3</span>
                                    <div>
                                        <p class="font-medium text-gray-800">Dapatkan Virtual Account</p>
                                        <p class="text-sm text-gray-600 mt-1">Kode VA unik untuk pembayaran</p>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-sm font-bold mr-3">4</span>
                                    <div>
                                        <p class="font-medium text-gray-800">Saldo otomatis terisi</p>
                                        <p class="text-sm text-gray-600 mt-1">Setelah pembayaran dikonfirmasi</p>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>

                    <!-- Benefits -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Keuntungan Saldo Dompet
                            </h3>
                        </div>
                        <div class="p-6">
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-green-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-sm text-gray-600">Transaksi lebih cepat tanpa input data berulang</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-green-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-sm text-gray-600">Diskon khusus untuk pembayaran via dompet</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-green-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-sm text-gray-600">Riwayat transaksi terpusat dan mudah dilacak</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-green-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-sm text-gray-600">Saldo aman dengan sistem keamanan berlapis</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Recent Topups -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Riwayat Topup Terakhir
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-medium text-gray-800">Rp 500.000</p>
                                        <p class="text-xs text-gray-500">BCA • 2 hari lalu</p>
                                    </div>
                                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Berhasil</span>
                                </div>
                                
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-medium text-gray-800">Rp 250.000</p>
                                        <p class="text-xs text-gray-500">Mandiri • 1 minggu lalu</p>
                                    </div>
                                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Berhasil</span>
                                </div>
                                
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-medium text-gray-800">Rp 1.000.000</p>
                                        <p class="text-xs text-gray-500">BCA • 2 minggu lalu</p>
                                    </div>
                                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Berhasil</span>
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
                            <h4 class="font-medium text-gray-800">Butuh Bantuan Topup?</h4>
                            <p class="text-sm text-gray-600">Tim support siap membantu Anda 24/7</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="tel:+6281234567890" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200 flex items-center text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            0812-3456-7890
                        </a>
                        <a href="mailto:wallet@ecommerce.com" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200 flex items-center text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            wallet@ecommerce.com
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setAmount(amount) {
            document.getElementById('amount').value = amount;
            formatAmountInput();
        }
        
        function formatAmountInput() {
            const input = document.getElementById('amount');
            let value = parseInt(input.value);
            
            if (value < 10000) {
                input.value = 10000;
            }
            
            // Format display (optional)
            input.value = value.toLocaleString('id-ID');
        }
        
        function updateSuggestedAmounts(value) {
            // Logic to update suggested amounts based on input
            // This is a placeholder for future enhancement
        }
        
        // Initialize with default format
        document.getElementById('amount').addEventListener('blur', formatAmountInput);
    </script>
</x-app-layout>