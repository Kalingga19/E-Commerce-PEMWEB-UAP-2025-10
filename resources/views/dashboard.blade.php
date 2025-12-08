<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-gray-600 mt-1">Selamat datang kembali, {{ auth()->user()->name }}!</p>
            </div>
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                    {{ now()->format('d F Y') }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Revenue Card -->
                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl shadow-xl p-6 text-white transform hover:-translate-y-1 transition-transform duration-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-blue-100 text-sm font-medium mb-2">Total Pendapatan</p>
                            <p class="text-3xl font-bold">Rp 12.5 JT</p>
                            <p class="text-blue-200 text-sm mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                                +15% dari bulan lalu
                            </p>
                        </div>
                        <div class="p-3 bg-white/20 rounded-xl">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Orders Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transition-shadow duration-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-2">Total Pesanan</p>
                            <p class="text-3xl font-bold text-gray-900">1,248</p>
                            <p class="text-green-600 text-sm mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                                +32% dari bulan lalu
                            </p>
                        </div>
                        <div class="p-3 bg-green-50 rounded-xl">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Active Products Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transition-shadow duration-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-2">Produk Aktif</p>
                            <p class="text-3xl font-bold text-gray-900">86</p>
                            <p class="text-gray-500 text-sm mt-2">Dari 100 kapasitas</p>
                        </div>
                        <div class="p-3 bg-purple-50 rounded-xl">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Customer Satisfaction Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transition-shadow duration-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-2">Kepuasan Pelanggan</p>
                            <p class="text-3xl font-bold text-gray-900">94.5%</p>
                            <p class="text-gray-500 text-sm mt-2">Rating 4.7/5.0</p>
                        </div>
                        <div class="p-3 bg-amber-50 rounded-xl">
                            <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts & Tables Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Revenue Chart -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Statistik Pendapatan</h3>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded-lg">Bulanan</button>
                            <button class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-100 rounded-lg">Tahunan</button>
                        </div>
                    </div>
                    <div class="h-64 flex items-end space-x-2">
                        <!-- Sample Chart Bars -->
                        @foreach([65, 80, 75, 90, 85, 95, 70] as $height)
                            <div class="flex-1 flex flex-col items-center">
                                <div class="w-full bg-gradient-to-t from-blue-500 to-blue-300 rounded-t-lg" 
                                     style="height: {{ $height }}%"></div>
                                <span class="text-xs text-gray-500 mt-2">{{ ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'][$loop->index] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Pesanan Terbaru</h3>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</a>
                    </div>
                    <div class="space-y-4">
                        @foreach([
                            ['id' => 'ORD-001', 'customer' => 'Ahmad Santoso', 'amount' => 'Rp 450.000', 'status' => 'completed'],
                            ['id' => 'ORD-002', 'customer' => 'Budi Setiawan', 'amount' => 'Rp 325.000', 'status' => 'processing'],
                            ['id' => 'ORD-003', 'customer' => 'Citra Wijaya', 'amount' => 'Rp 890.000', 'status' => 'pending'],
                            ['id' => 'ORD-004', 'customer' => 'Dewi Anggraini', 'amount' => 'Rp 210.000', 'status' => 'completed'],
                            ['id' => 'ORD-005', 'customer' => 'Eko Prasetyo', 'amount' => 'Rp 150.000', 'status' => 'cancelled']
                        ] as $order)
                            <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $order['id'] }}</p>
                                    <p class="text-sm text-gray-600">{{ $order['customer'] }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-medium text-gray-900">{{ $order['amount'] }}</p>
                                    <span class="text-xs px-2 py-1 rounded-full 
                                        @if($order['status'] == 'completed') bg-green-100 text-green-800
                                        @elseif($order['status'] == 'processing') bg-blue-100 text-blue-800
                                        @elseif($order['status'] == 'pending') bg-amber-100 text-amber-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($order['status']) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Info Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Quick Actions -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Aksi Cepat</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <a href="{{ route('seller.products.create') }}" 
                               class="flex flex-col items-center justify-center p-4 border border-gray-200 rounded-xl hover:border-blue-300 hover:bg-blue-50 transition-all duration-200 group">
                                <div class="p-3 bg-blue-100 rounded-lg mb-3 group-hover:bg-blue-200">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Tambah Produk</span>
                            </a>
                            <a href="{{ route('seller.orders.index') }}" 
                               class="flex flex-col items-center justify-center p-4 border border-gray-200 rounded-xl hover:border-green-300 hover:bg-green-50 transition-all duration-200 group">
                                <div class="p-3 bg-green-100 rounded-lg mb-3 group-hover:bg-green-200">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Kelola Pesanan</span>
                            </a>
                            <a href="{{ route('seller.withdrawals.create') }}" 
                               class="flex flex-col items-center justify-center p-4 border border-gray-200 rounded-xl hover:border-purple-300 hover:bg-purple-50 transition-all duration-200 group">
                                <div class="p-3 bg-purple-100 rounded-lg mb-3 group-hover:bg-purple-200">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Tarik Dana</span>
                            </a>
                            <a href="{{ route('profile.edit') }}" 
                               class="flex flex-col items-center justify-center p-4 border border-gray-200 rounded-xl hover:border-amber-300 hover:bg-amber-50 transition-all duration-200 group">
                                <div class="p-3 bg-amber-100 rounded-lg mb-3 group-hover:bg-amber-200">
                                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Pengaturan</span>
                            </a>
                            <a href="{{ route('store.settings') }}" 
                               class="flex flex-col items-center justify-center p-4 border border-gray-200 rounded-xl hover:border-red-300 hover:bg-red-50 transition-all duration-200 group">
                                <div class="p-3 bg-red-100 rounded-lg mb-3 group-hover:bg-red-200">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Toko</span>
                            </a>
                            <a href="{{ route('support') }}" 
                               class="flex flex-col items-center justify-center p-4 border border-gray-200 rounded-xl hover:border-indigo-300 hover:bg-indigo-50 transition-all duration-200 group">
                                <div class="p-3 bg-indigo-100 rounded-lg mb-3 group-hover:bg-indigo-200">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Bantuan</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- System Status -->
                <div class="bg-gradient-to-br from-gray-900 to-black rounded-2xl shadow-xl p-6 text-white">
                    <h3 class="text-lg font-semibold mb-6">Status Sistem</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                <span>Server Status</span>
                            </div>
                            <span class="text-green-400 font-medium">Online</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                <span>Database</span>
                            </div>
                            <span class="text-green-400 font-medium">Normal</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                <span>Payment Gateway</span>
                            </div>
                            <span class="text-green-400 font-medium">Active</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                                <span>API Response</span>
                            </div>
                            <span class="text-yellow-400 font-medium">175ms</span>
                        </div>
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-gray-800">
                        <h4 class="text-sm font-medium text-gray-300 mb-3">Pengingat</h4>
                        <div class="bg-gray-800/50 rounded-lg p-4">
                            <p class="text-sm">Pajak kuartal berikutnya jatuh tempo: <strong>15 Januari 2024</strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Welcome Message -->
            <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-8">
                <div class="flex items-center">
                    <div class="flex-shrink-0 mr-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Selamat datang di Dashboard Anda!</h3>
                        <p class="text-gray-700">
                            Anda berhasil login ke sistem. Mulai kelola bisnis online Anda dari sini.
                            Lihat statistik terbaru, kelola pesanan, dan pantau performa toko Anda.
                        </p>
                        <div class="mt-4 flex space-x-3">
                            <a href="{{ route('seller.products.index') }}" 
                               class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                Mulai Mengelola
                            </a>
                            <a href="#" class="px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                Pelajari Lebih Lanjut
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>