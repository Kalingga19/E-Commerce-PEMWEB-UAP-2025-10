<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <!-- Success Animation -->
            <div class="text-center mb-10">
                <div class="relative inline-flex mb-8">
                    <div class="absolute inset-0 animate-ping opacity-20">
                        <div class="w-32 h-32 bg-green-500 rounded-full"></div>
                    </div>
                    <div class="relative w-32 h-32 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full 
                                flex items-center justify-center shadow-2xl">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Pendaftaran Toko Berhasil!</h1>
                <p class="text-xl text-gray-600 max-w-lg mx-auto">
                    Selamat! Toko Anda telah berhasil terdaftar
                </p>
            </div>

            <!-- Success Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden mb-10">
                <div class="px-8 py-6 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-xl font-semibold text-gray-900">Status Pendaftaran</h2>
                </div>
                
                <div class="px-8 py-10">
                    <!-- Status Timeline -->
                    <div class="mb-12">
                        <div class="flex items-center justify-center mb-8">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-12 h-12 bg-green-600 text-white rounded-full shadow-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div class="h-1 w-24 bg-green-600"></div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-12 h-12 bg-blue-600 text-white rounded-full shadow-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="h-1 w-24 bg-gray-300"></div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-12 h-12 bg-gray-300 text-gray-500 rounded-full">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600 max-w-2xl mx-auto px-4">
                            <span class="font-medium text-green-600">Pendaftaran Selesai</span>
                            <span class="font-medium text-blue-600">Verifikasi Admin</span>
                            <span class="text-gray-500">Toko Aktif</span>
                        </div>
                    </div>

                    <!-- Success Message -->
                    <div class="text-center mb-10">
                        <div class="inline-flex items-center justify-center p-3 bg-green-100 rounded-full mb-6">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">Sedang Dalam Proses Verifikasi</h3>
                        <div class="max-w-lg mx-auto space-y-4 text-gray-600">
                            <p class="text-lg">
                                Dokumen dan informasi toko Anda sedang ditinjau oleh tim admin kami.
                            </p>
                            <p>
                                Proses verifikasi biasanya memakan waktu <span class="font-semibold text-blue-600">1-3 hari kerja</span>.
                            </p>
                            <p class="text-sm">
                                Anda akan menerima notifikasi melalui email dan dashboard setelah toko diverifikasi.
                            </p>
                        </div>
                    </div>

                    <!-- What's Next -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6 mb-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 p-2 bg-blue-100 rounded-lg mr-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-3">Apa Selanjutnya?</h4>
                                <ul class="space-y-3 text-sm text-gray-700">
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Tim admin akan memverifikasi informasi toko Anda</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Anda akan menerima email konfirmasi setelah verifikasi selesai</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Toko akan aktif dan siap untuk mulai berjualan</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Estimated Time -->
                    <div class="flex items-center justify-center p-4 bg-amber-50 border border-amber-200 rounded-xl mb-8">
                        <div class="flex-shrink-0 p-2 bg-amber-100 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="text-sm font-medium text-amber-800">Perkiraan Waktu Verifikasi</p>
                            <p class="text-sm text-amber-700">1-3 hari kerja (tidak termasuk akhir pekan dan hari libur)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center space-y-6">
                <a href="{{ route('seller.dashboard') }}"
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-600 to-emerald-600 
                          text-white font-semibold rounded-xl shadow-lg hover:from-green-700 hover:to-emerald-700 
                          focus:outline-none focus:ring-4 focus:ring-green-500 focus:ring-opacity-50 
                          transform hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Kembali ke Dashboard
                </a>

                <!-- Additional Options -->
                <div class="pt-6 border-t border-gray-200">
                    <p class="text-gray-600 mb-4">Sambil menunggu verifikasi, Anda dapat:</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-md mx-auto">
                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center justify-center p-4 border border-gray-300 rounded-xl 
                                  hover:border-blue-400 hover:bg-blue-50 transition-all duration-200 group">
                            <div class="p-2 bg-blue-100 rounded-lg mr-3 group-hover:bg-blue-200">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900">Lengkapi Profil</span>
                        </a>
                        
                        <button onclick="window.location.href='{{ route('seller.products.index') }}'"
                                class="flex items-center justify-center p-4 border border-gray-300 rounded-xl 
                                       hover:border-green-400 hover:bg-green-50 transition-all duration-200 group">
                            <div class="p-2 bg-green-100 rounded-lg mr-3 group-hover:bg-green-200">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900">Persiapkan Produk</span>
                        </button>
                    </div>
                </div>

                <!-- Contact Support -->
                <div class="mt-8">
                    <p class="text-gray-600 mb-4">Butuh bantuan?</p>
                    <a href="mailto:support@example.com"
                       class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 
                              font-medium rounded-xl hover:bg-gray-50 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Hubungi Support
                    </a>
                </div>
            </div>

            <!-- Success Celebration -->
            <div class="mt-12 text-center">
                <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-50 to-emerald-50 
                           border border-green-200 rounded-full">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm font-medium text-green-800">Selamat atas pendaftaran toko Anda!</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Celebration Animation -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none z-50">
        @for($i = 0; $i < 20; $i++)
            <div class="absolute confetti" style="
                left: {{ rand(0, 100) }}%;
                top: -10px;
                width: {{ rand(5, 10) }}px;
                height: {{ rand(10, 20) }}px;
                background: {{ ['#10B981', '#059669', '#047857', '#34D399'][rand(0, 3)] }};
                transform: rotate({{ rand(0, 360) }}deg);
                animation: fall {{ rand(2, 5) }}s linear infinite;
                animation-delay: {{ rand(0, 2) }}s;
            "></div>
        @endfor
    </div>

    <style>
        @keyframes fall {
            0% {
                transform: translateY(-10px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }
        
        .confetti {
            border-radius: 2px;
        }
    </style>
</x-app-layout>