<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-6">
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
            <p class="text-gray-600 mt-2">Selamat datang di panel administrasi sistem</p>
            <div class="flex items-center mt-4">
                <div class="w-3 h-3 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                <span class="text-sm text-gray-600">Sistem berjalan normal</span>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            <!-- Total Pengguna -->
            <a href="{{ route('admin.users.index') }}"
               class="block bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-lg p-6 border border-blue-100 hover:-translate-y-1 transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-100 rounded-xl">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4a4 4 0 110 8M15 21H3v-1a6 6 0 1112 0v1zm6-9V3h-6" />
                        </svg>
                    </div>
                    <span class="text-xs font-semibold px-3 py-1 bg-blue-100 text-blue-800 rounded-full">Total</span>
                </div>
                <h3 class="text-gray-600 font-medium mb-2">Total Pengguna</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2">{{ $users }}</p>
                <div class="text-sm text-gray-500">Klik untuk kelola pengguna</div>
            </a>

            <!-- Total Toko -->
            <a href="{{ route('admin.verification') }}"
               class="block bg-gradient-to-br from-white to-green-50 rounded-2xl shadow-lg p-6 border border-green-100 hover:-translate-y-1 transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-100 rounded-xl">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16" />
                        </svg>
                    </div>
                    <span class="text-xs font-semibold px-3 py-1 bg-green-100 text-green-800 rounded-full">Total</span>
                </div>
                <h3 class="text-gray-600 font-medium mb-2">Total Toko</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2">{{ $stores }}</p>
                <div class="text-sm text-gray-500">Klik untuk verifikasi toko</div>
            </a>

            <!-- Total Produk -->
            <a href="{{ route('admin.categories.index') }}"
                class="block bg-gradient-to-br from-white to-purple-50 rounded-2xl shadow-lg p-6 border border-purple-100 hover:-translate-y-1 transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-purple-100 rounded-xl">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
                        </svg>
                    </div>
                    <span class="text-xs font-semibold px-3 py-1 bg-purple-100 text-purple-800 rounded-full">Total</span>
                </div>
                <h3 class="text-gray-600 font-medium mb-2">Total Kategori</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2">{{ $products }}</p>
                <div class="text-sm text-gray-500">Kelola kategori</div>
            </a>

            <div class="bg-gradient-to-br from-white to-purple-50 rounded-2xl shadow-lg p-6 border border-purple-100 transform transition-transform duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-purple-100 rounded-xl">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold px-3 py-1 bg-purple-100 text-purple-800 rounded-full">Total</span>
                </div>
                <h3 class="text-gray-600 font-medium mb-2">Total Produk</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2">{{ $products }}</p>

                <a href="{{ route('admin.products.index') }}"
                class="text-sm text-purple-600 hover:text-purple-800 underline">Lihat Produk →</a>
            </div>

            <!-- Total Transaksi -->
            <div class="bg-gradient-to-br from-white to-orange-50 rounded-2xl shadow-lg p-6 border border-orange-100">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-orange-100 rounded-xl">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.7 0-3 .9-3 2s1.3 2 3 2 3 .9 3 2-1.3 2-3 2m0-8V7m0 1v8m0 0v1" />
                        </svg>
                    </div>
                    <span class="text-xs font-semibold px-3 py-1 bg-orange-100 text-orange-800 rounded-full">Total</span>
                </div>
                <h3 class="text-gray-600 font-medium mb-2">Total Transaksi</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2">{{ $transactions }}</p>
                <div class="text-sm text-gray-500">Transaksi berhasil</div>
            </div>
        </div>

        <!-- Aktivitas -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800">Aktivitas Terbaru</h2>
                <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat semua →</a>
            </div>

            <div class="space-y-4">
                <a href="{{ route('admin.users.index') }}" class="flex items-center p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition">
                    <div class="p-2 bg-blue-100 rounded-lg mr-4">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4a4 4 0 010 8M3 20v-1a6 6 0 0112 0v1" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Pengguna baru terdaftar</p>
                        <p class="text-sm text-gray-600">1 menit yang lalu</p>
                    </div>
                </a>

                <a href="{{ route('admin.verification') }}" class="flex items-center p-4 bg-green-50 rounded-xl hover:bg-green-100 transition">
                    <div class="p-2 bg-green-100 rounded-lg mr-4">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Transaksi berhasil diproses</p>
                        <p class="text-sm text-gray-600">15 menit yang lalu</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
