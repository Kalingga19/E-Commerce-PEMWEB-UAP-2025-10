<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">

        <!-- Hero Section with Welcome -->
        <div class="mb-8 animate-fade-in">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-4xl md:text-5xl font-extrabold bg-gradient-to-r from-gray-900 via-blue-800 to-indigo-900 bg-clip-text text-transparent">
                                Dashboard Admin
                            </h1>
                            <p class="text-gray-600 text-lg mt-2">Selamat datang kembali, <span class="font-semibold text-blue-700">{{ Auth::user()->name }}</span></p>
                        </div>
                    </div>
                    
                    <!-- Stats Summary -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-6">
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-3 border border-gray-200 shadow-sm">
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Hari ini</p>
                            <p class="text-xl font-bold text-gray-900">{{ now()->format('d M Y') }}</p>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-3 border border-gray-200 shadow-sm">
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Pengguna Aktif</p>
                            <p class="text-xl font-bold text-green-600">{{ $activeUsers ?? '0' }}</p>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-3 border border-gray-200 shadow-sm">
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Toko Aktif</p>
                            <p class="text-xl font-bold text-blue-600">{{ $activeStores ?? '0' }}</p>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-3 border border-gray-200 shadow-sm">
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Pendapatan</p>
                            <p class="text-xl font-bold text-purple-600">Rp {{ number_format($todayRevenue ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Status and Quick Actions -->
                <div class="flex flex-col gap-4">
                    <div class="flex items-center space-x-2 bg-white px-4 py-3 rounded-xl shadow-md border border-gray-200">
                        <div class="relative">
                            <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                            <div class="absolute inset-0 bg-green-500 rounded-full animate-ping opacity-75"></div>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-700">Sistem Online</span>
                            <p class="text-xs text-gray-500">Uptime: 99.9%</p>
                        </div>
                    </div>
                    
                    <!-- Quick Action Button -->
                    <button onclick="window.location='{{ route('admin.verification') }}'" 
                            class="group flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-4 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-semibold">Verifikasi Toko</span>
                        <span class="bg-white/20 px-2 py-0.5 rounded-full text-xs">{{ $pendingVerifications ?? '0' }} menunggu</span>
                    </button>
                </div>
            </div>
            
            <!-- Time Period Selector -->
            <div class="flex items-center justify-between mt-8 pb-4 border-b border-gray-200">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h2 class="text-lg font-semibold text-gray-800">Ringkasan Minggu Ini</h2>
                </div>
                <div class="flex items-center space-x-1 bg-gray-100 rounded-lg p-1">
                    <button class="px-3 py-1.5 text-sm font-medium rounded-md bg-white shadow text-gray-800">Hari Ini</button>
                    <button class="px-3 py-1.5 text-sm font-medium rounded-md text-gray-600 hover:text-gray-800">Minggu Ini</button>
                    <button class="px-3 py-1.5 text-sm font-medium rounded-md text-gray-600 hover:text-gray-800">Bulan Ini</button>
                </div>
            </div>
        </div>

        <!-- Main Stats Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">

            <!-- Total Users Card -->
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl p-6 border border-gray-100 hover:border-blue-200 transform hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-blue-50 to-blue-100 rounded-full -mr-12 -mt-12 opacity-50 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="flex items-center space-x-1">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-xs font-medium text-green-600">+{{ $userGrowth ?? '0' }}%</span>
                        </div>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-2">Total Pengguna</h3>
                    <p class="text-3xl font-bold text-gray-900 mb-2">{{ $totalUsers ?? '0' }}</p>
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        <a href="{{ route('admin.users.index') }}" class="font-medium text-blue-600 hover:text-blue-800">Lihat detail</a>
                    </div>
                </div>
            </div>

            <!-- Total Stores Card -->
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl p-6 border border-gray-100 hover:border-green-200 transform hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-green-50 to-green-100 rounded-full -mr-12 -mt-12 opacity-50 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="flex items-center space-x-1">
                            <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full font-medium">{{ $verifiedStores ?? '0' }} terverifikasi</span>
                        </div>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-2">Total Toko</h3>
                    <p class="text-3xl font-bold text-gray-900 mb-2">{{ $totalStores ?? '0' }}</p>
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        <a href="{{ route('admin.verification') }}" class="font-medium text-green-600 hover:text-green-800">Verifikasi Toko</a>
                    </div>
                </div>
            </div>

            <!-- Total Products Card -->
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl p-6 border border-gray-100 hover:border-purple-200 transform hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-purple-50 to-purple-100 rounded-full -mr-12 -mt-12 opacity-50 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div class="flex items-center space-x-1">
                            <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                            <span class="text-xs font-medium text-purple-600">{{ $activeProducts ?? '0' }} aktif</span>
                        </div>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-2">Total Produk</h3>
                    <p class="text-3xl font-bold text-gray-900 mb-2">{{ $totalProducts ?? '0' }}</p>
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-1 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        <a href="{{ route('admin.products.index') }}" class="font-medium text-purple-600 hover:text-purple-800">Kelola produk</a>
                    </div>
                </div>
            </div>

            <!-- Total Transactions Card -->
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl p-6 border border-gray-100 hover:border-orange-200 transform hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-orange-50 to-orange-100 rounded-full -mr-12 -mt-12 opacity-50 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex items-center space-x-1">
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-xs font-medium text-green-600">Rp {{ number_format($todayRevenue ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-2">Total Transaksi</h3>
                    <p class="text-3xl font-bold text-gray-900 mb-2">{{ $completedTransactions ?? '0' }}</p>
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-1 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        <a href="{{ route('admin.transactions.index') }}" class="font-medium text-orange-600 hover:text-orange-800">Lihat transaksi</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Second Row: Pending Actions and Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            
            <!-- Pending Actions -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Tindakan Menunggu</h2>
                        <p class="text-gray-600 text-sm">Perlu perhatian segera</p>
                    </div>
                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">{{ $totalPending ?? '0' }} menunggu</span>
                </div>
                
                <div class="space-y-4">
                    <!-- Pending Verifications -->
                    <a href="{{ route('admin.verification') }}" class="group flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-indigo-50 hover:from-blue-100 rounded-xl border border-blue-100 hover:border-blue-200 transition-all duration-300">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-500 rounded-lg mr-3 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Verifikasi Toko</p>
                                <p class="text-sm text-gray-600">{{ $pendingVerifications ?? '0' }} toko menunggu verifikasi</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <span class="text-blue-600 font-medium text-sm mr-2">Proses</span>
                            <svg class="w-5 h-5 text-blue-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                    
                    <!-- Pending Withdrawals -->
                    <a href="{{ route('admin.withdrawals.index') }}" class="group flex items-center justify-between p-4 bg-gradient-to-r from-amber-50 to-orange-50 hover:from-amber-100 rounded-xl border border-amber-100 hover:border-amber-200 transition-all duration-300">
                        <div class="flex items-center">
                            <div class="p-2 bg-amber-500 rounded-lg mr-3 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Withdrawal Pending</p>
                                <p class="text-sm text-gray-600">{{ $pendingWithdrawals ?? '0' }} permintaan penarikan</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <span class="text-amber-600 font-medium text-sm mr-2">Proses</span>
                            <svg class="w-5 h-5 text-amber-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                    
                    <!-- Pending Transactions -->
                    <a href="{{ route('admin.transactions.index') }}" class="group flex items-center justify-between p-4 bg-gradient-to-r from-purple-50 to-pink-50 hover:from-purple-100 rounded-xl border border-purple-100 hover:border-purple-200 transition-all duration-300">
                        <div class="flex items-center">
                            <div class="p-2 bg-purple-500 rounded-lg mr-3 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Transaksi Pending</p>
                                <p class="text-sm text-gray-600">{{ $pendingTransactions ?? '0' }} transaksi menunggu</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <span class="text-purple-600 font-medium text-sm mr-2">Proses</span>
                            <svg class="w-5 h-5 text-purple-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
            
            <!-- Quick Stats -->
            <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-lg p-6 text-white">
                <h2 class="text-xl font-bold mb-6">Statistik Cepat</h2>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-white/10 rounded-xl backdrop-blur-sm">
                        <div class="flex items-center">
                            <div class="p-2 bg-green-500/20 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Transaksi Sukses</p>
                                <p class="text-lg font-bold">{{ $completedTransactions ?? '0' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-300">Rate</p>
                            <p class="text-lg font-bold text-green-400">{{ $successRate ?? '95' }}%</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-white/10 rounded-xl backdrop-blur-sm">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-500/20 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Pengguna Baru</p>
                                <p class="text-lg font-bold">{{ $newUsersToday ?? '0' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-300">Hari ini</p>
                            <p class="text-lg font-bold text-blue-400">+{{ $userGrowth ?? '0' }}%</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-white/10 rounded-xl backdrop-blur-sm">
                        <div class="flex items-center">
                            <div class="p-2 bg-purple-500/20 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Pendapatan</p>
                                <p class="text-lg font-bold">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-300">Total</p>
                            <p class="text-lg font-bold text-purple-400">+{{ $revenueGrowth ?? '0' }}%</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 pt-4 border-t border-white/20">
                    <p class="text-sm text-gray-300">Terakhir diperbarui: {{ now()->format('H:i') }}</p>
                </div>
            </div>
        </div>
        </div>

        <!-- Footer Note -->
        <div class="mt-8 text-center text-gray-500 text-sm">
            <p>Dashboard Admin • Sistem versi {{ env('APP_VERSION', '1.0.0') }} • Terakhir diupdate: {{ now()->format('d M Y H:i') }}</p>
        </div>

    </div>
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 0.8s ease-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
</x-app-layout>