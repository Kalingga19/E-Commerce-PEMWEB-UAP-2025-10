@guest
<!-- Navbar untuk Guest (Belum Login) -->
<nav class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-xl">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <!-- Left Section -->
            <div class="flex items-center space-x-8">
                <a href="/" class="flex items-center space-x-3 group">
                    <div class="p-2 bg-white/20 backdrop-blur-sm rounded-xl group-hover:bg-white/30 transition-all duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white">ZyloMart</span>
                </a>

                <div class="hidden md:flex items-center space-x-6">
                    <a href="/" class="relative px-4 py-2 text-white/90 hover:text-white font-medium rounded-xl hover:bg-white/10 transition-all duration-300 group">
                        Home
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-white group-hover:w-3/4 transition-all duration-300"></span>
                    </a>
                    <a href="/search" class="relative px-4 py-2 text-white/90 hover:text-white font-medium rounded-xl hover:bg-white/10 transition-all duration-300 group">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <span>Cari Produk</span>
                        </div>
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-white group-hover:w-3/4 transition-all duration-300"></span>
                    </a>
                </div>
            </div>

            <!-- Right Section -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}" 
                   class="px-6 py-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold rounded-xl hover:bg-white/30 hover:scale-105 transition-all duration-300 border border-white/30">
                    Login
                </a>
                <a href="{{ route('register') }}" 
                   class="px-6 py-2.5 bg-white text-blue-600 font-semibold rounded-xl hover:bg-gray-100 hover:scale-105 transition-all duration-300 shadow-lg">
                    Register
                </a>
            </div>
        </div>
    </div>
</nav>
@endguest

@auth
@if(auth()->user()->role === 'admin')
<!-- Navbar untuk Admin -->
<nav class="bg-gradient-to-r from-gray-900 to-gray-800 shadow-xl">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <!-- Left Section -->
            <div class="flex items-center space-x-6">
                <!-- Logo/Brand -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 group">
                    <div class="p-2 bg-gradient-to-r from-red-500 to-pink-600 rounded-xl group-hover:scale-110 transition-all duration-300 shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white">Admin Panel</span>
                </a>

                <!-- Admin Navigation Links -->
                <div class="hidden md:flex items-center space-x-4">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" 
                       class="relative px-4 py-2.5 text-gray-300 hover:text-white font-medium rounded-xl hover:bg-white/10 transition-all duration-300 group flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <!-- Verifikasi Toko dengan Badge -->
                    <a href="{{ route('admin.verification') }}" 
                       class="relative px-4 py-2.5 text-gray-300 hover:text-white font-medium rounded-xl hover:bg-white/10 transition-all duration-300 group flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Verifikasi Toko</span>
                        @if(($pendingStores ?? 0) > 0)
                            <span class="px-2 py-0.5 bg-gradient-to-r from-red-500 to-pink-600 text-white text-xs font-bold rounded-full animate-pulse">
                                {{ $pendingStores }}
                            </span>
                        @endif
                    </a>

                    <!-- Users -->
                    <a href="{{ route('admin.users.index') }}" 
                       class="relative px-4 py-2.5 text-gray-300 hover:text-white font-medium rounded-xl hover:bg-white/10 transition-all duration-300 group flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-6.75a6.75 6.75 0 01-13.5 0"></path>
                        </svg>
                        <span>Users</span>
                    </a>

                    <!-- Categories -->
                    <a href="{{ route('admin.categories.index') }}" 
                       class="relative px-4 py-2.5 text-gray-300 hover:text-white font-medium rounded-xl hover:bg-white/10 transition-all duration-300 group flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        <span>Categories</span>
                    </a>

                    <!-- Products -->
                    <a href="{{ route('admin.products.index') }}" 
                       class="relative px-4 py-2.5 text-gray-300 hover:text-white font-medium rounded-xl hover:bg-white/10 transition-all duration-300 group flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <span>Products</span>
                    </a>
                </div>
            </div>

            <!-- Right Section - Logout -->
            <div class="flex items-center space-x-4">
                <div class="hidden md:flex items-center space-x-3 px-4 py-2 rounded-xl bg-white/10 backdrop-blur-sm">
                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-sm">A</span>
                    </div>
                    <span class="text-white font-medium">{{ auth()->user()->name }}</span>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="px-6 py-2.5 bg-gradient-to-r from-red-500 to-pink-600 text-white font-semibold rounded-xl hover:from-red-600 hover:to-pink-700 hover:scale-105 transition-all duration-300 shadow-lg flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
@endif
@endauth

@auth
@if(auth()->user()->role !== 'admin')
<!-- Navbar untuk User (Bukan Admin) -->
<nav class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-xl">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <!-- Left Section -->
            <div class="flex items-center space-x-8">
                <!-- Logo/Brand -->
                <a href="/" class="flex items-center space-x-3 group">
                    <div class="p-2 bg-white/20 backdrop-blur-sm rounded-xl group-hover:bg-white/30 group-hover:scale-110 transition-all duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white">ZyloMart</span>
                </a>

                <!-- User Navigation Links -->
                <div class="hidden md:flex items-center space-x-4">
                    <!-- Home -->
                    <a href="/" 
                        class="relative px-4 py-2.5 text-white/90 hover:text-white font-medium rounded-xl hover:bg-white/10 transition-all duration-300 group flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Home</span>
                    </a>

                    <!-- Cek Status Pengiriman -->
                    <a href="#" 
                        class="relative px-4 py-2.5 text-white/90 hover:text-white font-medium rounded-xl hover:bg-white/10 transition-all duration-300 group flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span>Cek Pengiriman</span>
                    </a>

                    <!-- Riwayat Transaksi -->
                    <a href="/history" 
                       class="relative px-4 py-2.5 text-white/90 hover:text-white font-medium rounded-xl hover:bg-white/10 transition-all duration-300 group flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Riwayat Transaksi</span>
                    </a>
                </div>
            </div>

            <!-- Right Section - Keranjang & User Menu -->
            <div class="flex items-center space-x-6">
                <!-- Keranjang Button -->
                <a href="#" 
                    class="relative p-3 bg-white/20 backdrop-blur-sm rounded-xl hover:bg-white/30 hover:scale-110 transition-all duration-300 group">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <!-- Cart Badge -->
                    <span class="absolute -top-1 -right-1 w-5 h-5 bg-gradient-to-r from-red-500 to-pink-600 text-white text-xs font-bold rounded-full flex items-center justify-center animate-bounce">
                        3
                    </span>
                </a>

                <!-- User Profile & Logout -->
                <div class="flex items-center space-x-4">
                    <!-- User Avatar & Name -->
                    <div class="hidden md:flex items-center space-x-3 px-4 py-2 rounded-xl bg-white/10 backdrop-blur-sm">
                        <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <span class="text-white font-medium block">{{ auth()->user()->name }}</span>
                            <span class="text-white/70 text-xs">Member</span>
                        </div>
                    </div>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="px-6 py-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold rounded-xl hover:bg-white/30 hover:scale-105 transition-all duration-300 border border-white/30 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="hidden md:inline">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
@endif
@endauth