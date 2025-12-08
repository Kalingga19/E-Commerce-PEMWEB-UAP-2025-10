<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
            <p class="text-gray-600 mt-2">Selamat datang di panel administrasi sistem</p>
            <div class="flex items-center mt-4">
                <div class="w-3 h-3 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                <span class="text-sm text-gray-600">Sistem berjalan normal</span>
            </div>
        </div>

        <!-- Stats Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Pengguna Card -->
            <div class="bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-lg p-6 border border-blue-100 transform transition-transform duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-100 rounded-xl">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-6.75V3.75A2.25 2.25 0 0018 1.5h-2.25a2.25 2.25 0 00-2.25 2.25v.75m7.5 0h-7.5m7.5 0a3 3 0 013 3v6m-3-9h-7.5m0 0a3 3 0 00-3 3v6m3-9v6"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold px-3 py-1 bg-blue-100 text-blue-800 rounded-full">Total</span>
                </div>
                <h3 class="text-gray-600 font-medium mb-2">Total Pengguna</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2">{{ $users }}</p>
                <div class="text-sm text-gray-500">Pengguna terdaftar</div>
            </div>

            <!-- Total Toko Card -->
            <div class="bg-gradient-to-br from-white to-green-50 rounded-2xl shadow-lg p-6 border border-green-100 transform transition-transform duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-100 rounded-xl">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold px-3 py-1 bg-green-100 text-green-800 rounded-full">Total</span>
                </div>
                <h3 class="text-gray-600 font-medium mb-2">Total Toko</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2">{{ $stores }}</p>
                <div class="text-sm text-gray-500">Toko aktif</div>
            </div>

            <!-- Total Produk Card -->
            <div class="bg-gradient-to-br from-white to-purple-50 rounded-2xl shadow-lg p-6 border border-purple-100 transform transition-transform duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-purple-100 rounded-xl">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold px-3 py-1 bg-purple-100 text-purple-800 rounded-full">Total</span>
                </div>
                <h3 class="text-gray-600 font-medium mb-2">Total Produk</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2">{{ $products }}</p>
                <div class="text-sm text-gray-500">Produk tersedia</div>
            </div>

            <!-- Total Transaksi Card -->
            <div class="bg-gradient-to-br from-white to-orange-50 rounded-2xl shadow-lg p-6 border border-orange-100 transform transition-transform duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-orange-100 rounded-xl">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold px-3 py-1 bg-orange-100 text-orange-800 rounded-full">Total</span>
                </div>
                <h3 class="text-gray-600 font-medium mb-2">Total Transaksi</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2">{{ $transactions }}</p>
                <div class="text-sm text-gray-500">Transaksi berhasil</div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800">Aktivitas Terbaru</h2>
                <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat semua →</a>
            </div>
            <div class="space-y-4">
                <div class="flex items-center p-4 bg-blue-50 rounded-xl">
                    <div class="p-2 bg-blue-100 rounded-lg mr-4">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-6.75V3.75A2.25 2.25 0 0018 1.5h-2.25a2.25 2.25 0 00-2.25 2.25v.75m7.5 0h-7.5m7.5 0a3 3 0 013 3v6m-3-9h-7.5m0 0a3 3 0 00-3 3v6m3-9v6"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Pengguna baru terdaftar</p>
                        <p class="text-sm text-gray-600">1 menit yang lalu</p>
                    </div>
                </div>
                <div class="flex items-center p-4 bg-green-50 rounded-xl">
                    <div class="p-2 bg-green-100 rounded-lg mr-4">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Transaksi berhasil diproses</p>
                        <p class="text-sm text-gray-600">15 menit yang lalu</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
            <h2 class="text-xl font-bold mb-4">Aksi Cepat</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="#" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-xl p-4 text-center transition-colors duration-300">
                    <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span class="text-sm font-medium">Tambah Pengguna</span>
                </a>
                <a href="#" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-xl p-4 text-center transition-colors duration-300">
                    <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="text-sm font-medium">Laporan</span>
                </a>
                <a href="#" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-xl p-4 text-center transition-colors duration-300">
                    <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-sm font-medium">Pengaturan</span>
                </a>
                <a href="#" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-xl p-4 text-center transition-colors duration-300">
                    <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span class="text-sm font-medium">Edit Profil</span>
                </a>
            </div>
        </div>
    </div>
</div>
</x-app-layout>