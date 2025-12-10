<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 md:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="mb-8 animate-fade-in">
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-4xl md:text-5xl font-extrabold bg-gradient-to-r from-gray-900 via-blue-800 to-indigo-900 bg-clip-text text-transparent mb-3">
                        Dashboard Admin
                    </h1>
                    <p class="text-gray-600 text-lg">Selamat datang di panel administrasi sistem</p>
                </div>
                <div class="hidden md:flex items-center space-x-2 bg-white px-4 py-2 rounded-full shadow-md">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-sm font-medium text-gray-700">Sistem Online</span>
                </div>
            </div>
            <div class="md:hidden flex items-center mt-4 bg-white px-4 py-2 rounded-full shadow-md w-fit">
                <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                <span class="text-sm font-medium text-gray-700">Sistem Online</span>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">

            <!-- Total Users -->
            <a href="{{ route('admin.users.index') }}"
                class="group relative bg-white rounded-3xl shadow-md hover:shadow-2xl p-6 border border-transparent hover:border-blue-200 transform hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-400/10 to-blue-600/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold px-3 py-1.5 bg-blue-50 text-blue-700 rounded-full border border-blue-200">TOTAL</span>
                    </div>
                    <h3 class="text-gray-500 font-semibold text-sm mb-2 uppercase tracking-wide">Total Pengguna</h3>
                    <p class="text-4xl font-black text-gray-900 mb-1">{{ $totalUsers }}</p>
                    <div class="flex items-center text-xs text-blue-600 font-medium">
                        <span>Lihat detail</span>
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Total Stores -->
            <a href="{{ route('admin.verification') }}"
                class="group relative bg-white rounded-3xl shadow-md hover:shadow-2xl p-6 border border-transparent hover:border-green-200 transform hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-400/10 to-green-600/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold px-3 py-1.5 bg-green-50 text-green-700 rounded-full border border-green-200">TOTAL</span>
                    </div>
                    <h3 class="text-gray-500 font-semibold text-sm mb-2 uppercase tracking-wide">Total Toko</h3>
                    <p class="text-4xl font-black text-gray-900 mb-1">{{ $totalStores }}</p>
                    <div class="flex items-center text-xs text-green-600 font-medium">
                        <span>Lihat detail</span>
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Total Produk -->
            <a href="{{ route('admin.products.index') }}"
                class="group relative bg-white rounded-3xl shadow-md hover:shadow-2xl p-6 border border-transparent hover:border-purple-200 transform hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-400/10 to-purple-600/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold px-3 py-1.5 bg-purple-50 text-purple-700 rounded-full border border-purple-200">TOTAL</span>
                    </div>
                    <h3 class="text-gray-500 font-semibold text-sm mb-2 uppercase tracking-wide">Total Produk</h3>
                    <p class="text-4xl font-black text-gray-900 mb-1">{{ $totalProducts }}</p>
                    <div class="flex items-center text-xs text-purple-600 font-medium">
                        <span>Lihat detail</span>
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Total Transaksi -->
            <a href="{{ route('admin.transactions.index') }}"
                class="group relative bg-white rounded-3xl shadow-md hover:shadow-2xl p-6 border border-transparent hover:border-orange-200 transform hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-orange-400/10 to-orange-600/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold px-3 py-1.5 bg-orange-50 text-orange-700 rounded-full border border-orange-200">TOTAL</span>
                    </div>
                    <h3 class="text-gray-500 font-semibold text-sm mb-2 uppercase tracking-wide">Total Transaksi</h3>
                    <p class="text-4xl font-black text-gray-900 mb-1">{{ $completedTransactions }}</p>
                    <div class="flex items-center text-xs text-orange-600 font-medium">
                        <span>Lihat detail</span>
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

        </div>

        <!-- Extra Cards: Pending Transaction, Pending Withdraw -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">

            <!-- Pending Transactions -->
            <a href="{{ route('admin.transactions.index') }}"
                class="group relative bg-gradient-to-br from-amber-50 to-yellow-50 rounded-3xl shadow-md hover:shadow-2xl p-6 border-2 border-amber-200 hover:border-amber-300 transform hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-amber-300/20 rounded-full -ml-12 -mb-12 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-gradient-to-br from-amber-400 to-yellow-500 rounded-2xl shadow-lg group-hover:rotate-12 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex items-center space-x-1 text-xs font-bold px-3 py-1.5 bg-amber-200 text-amber-900 rounded-full">
                            <svg class="w-3 h-3 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            <span>PENDING</span>
                        </div>
                    </div>
                    <h3 class="text-gray-600 font-semibold text-sm mb-2 uppercase tracking-wide">Transaksi Pending</h3>
                    <p class="text-4xl font-black text-gray-900 mb-1">{{ $pendingTransactions }}</p>
                    <p class="text-xs text-amber-700 font-medium">Memerlukan perhatian</p>
                </div>
            </a>

            <!-- Withdraw Pending -->
            <a href="{{ route('admin.withdrawals.index') }}"
                class="group relative bg-gradient-to-br from-red-50 to-rose-50 rounded-3xl shadow-md hover:shadow-2xl p-6 border-2 border-red-200 hover:border-red-300 transform hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-red-300/20 rounded-full -ml-12 -mb-12 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-gradient-to-br from-red-500 to-rose-600 rounded-2xl shadow-lg group-hover:rotate-12 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="flex items-center space-x-1 text-xs font-bold px-3 py-1.5 bg-red-200 text-red-900 rounded-full">
                            <svg class="w-3 h-3 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            <span>PENDING</span>
                        </div>
                    </div>
                    <h3 class="text-gray-600 font-semibold text-sm mb-2 uppercase tracking-wide">Withdrawal Pending</h3>
                    <p class="text-4xl font-black text-gray-900 mb-1">{{ $pendingWithdrawals }}</p>
                    <p class="text-xs text-red-700 font-medium">Segera proses</p>
                </div>
            </a>

            <!-- Withdraw Approved -->
            <a href="{{ route('admin.withdrawals.index') }}"
                class="group relative bg-gradient-to-br from-emerald-50 to-green-50 rounded-3xl shadow-md hover:shadow-2xl p-6 border-2 border-emerald-200 hover:border-emerald-300 transform hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-emerald-300/20 rounded-full -ml-12 -mb-12 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex items-center space-x-1 text-xs font-bold px-3 py-1.5 bg-emerald-200 text-emerald-900 rounded-full">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>APPROVED</span>
                        </div>
                    </div>
                    <h3 class="text-gray-600 font-semibold text-sm mb-2 uppercase tracking-wide">Withdrawal Disetujui</h3>
                    <p class="text-4xl font-black text-gray-900 mb-1">{{ $approvedWithdrawals }}</p>
                    <p class="text-xs text-emerald-700 font-medium">Berhasil diproses</p>
                </div>
            </a>

        </div>

        <!-- Recent Activities -->
        <div class="bg-white rounded-3xl shadow-xl p-6 md:p-8 border border-gray-100">
            <div class="flex items-center justify-between mb-6 pb-4 border-b-2 border-gray-100">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Aktivitas Terbaru</h2>
                </div>
                <span class="text-sm text-gray-500 font-medium">Real-time updates</span>
            </div>

            <div class="space-y-3">

                {{-- Recent Transactions --}}
                @foreach($recentTransactions as $tx)
                <a href="{{ route('admin.transactions.show', $tx->id) }}"
                    class="group flex items-center p-4 bg-gradient-to-r from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 rounded-2xl transition-all duration-300 border border-blue-100 hover:border-blue-200 hover:shadow-md">
                    <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl mr-4 group-hover:scale-110 transition-transform duration-300 shadow-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-gray-900 group-hover:text-blue-700 transition-colors">Transaksi #{{ $tx->id }}</p>
                        <p class="text-sm text-gray-600 flex items-center mt-1">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $tx->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($tx->status) }}
                            </span>
                            <span class="mx-2">•</span>
                            <span>{{ $tx->created_at->diffForHumans() }}</span>
                        </p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                @endforeach

                {{-- Recent Withdrawals --}}
                @foreach($recentWithdrawals as $wd)
                <a href="{{ route('admin.withdrawals.show', $wd->id) }}"
                    class="group flex items-center p-4 bg-gradient-to-r from-purple-50 to-pink-50 hover:from-purple-100 hover:to-pink-100 rounded-2xl transition-all duration-300 border border-purple-100 hover:border-purple-200 hover:shadow-md">
                    <div class="p-3 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl mr-4 group-hover:scale-110 transition-transform duration-300 shadow-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-gray-900 group-hover:text-purple-700 transition-colors">Withdrawal #{{ $wd->id }}</p>
                        <p class="text-sm text-gray-600 flex items-center mt-1">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $wd->status == 'approved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($wd->status) }}
                            </span>
                            <span class="mx-2">•</span>
                            <span>{{ $wd->created_at->diffForHumans() }}</span>
                        </p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                @endforeach

            </div>
        </div>

    </div>
</div>
</x-app-layout>