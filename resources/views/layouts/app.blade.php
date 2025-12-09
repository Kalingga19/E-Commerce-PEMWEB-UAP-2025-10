<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Zylomart')) - Marketplace Terlengkap</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/logo.png') ?? asset('favicon.ico') }}" type="image/x-icon">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Custom Styles -->
    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #1d4ed8;
        }
        
        /* Smooth transitions */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
        
        /* Dropdown animation */
        @keyframes dropdownFade {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .dropdown-animation {
            animation: dropdownFade 0.2s ease-out;
        }
    </style>
    
    @yield('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        @if(file_exists(public_path('storage/logo.png')))
                            <img src="{{ asset('storage/logo.png') }}" alt="Zylomart" class="h-10 w-auto">
                        @else
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold text-xl">Z</span>
                            </div>
                        @endif
                        <span class="text-xl font-bold text-gray-900 hidden sm:block">Zylomart</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-gray-700 hover:text-blue-600 font-medium rounded-lg hover:bg-blue-50 {{ request()->is('/') ? 'text-blue-600 bg-blue-50' : '' }}">
                        <i class="fas fa-home mr-2"></i>Beranda
                    </a>
                    <a href="{{ route('products.index') }}" class="px-4 py-2 text-gray-700 hover:text-blue-600 font-medium rounded-lg hover:bg-blue-50 {{ request()->is('products*') ? 'text-blue-600 bg-blue-50' : '' }}">
                        <i class="fas fa-shopping-bag mr-2"></i>Produk
                    </a>
                    <a href="{{ route('categories.index') }}" class="px-4 py-2 text-gray-700 hover:text-blue-600 font-medium rounded-lg hover:bg-blue-50 {{ request()->is('categories*') ? 'text-blue-600 bg-blue-50' : '' }}">
                        <i class="fas fa-list mr-2"></i>Kategori
                    </a>
                    <a href="#" class="px-4 py-2 text-gray-700 hover:text-blue-600 font-medium rounded-lg hover:bg-blue-50">
                        <i class="fas fa-percent mr-2"></i>Promo
                    </a>
                </div>

                <!-- Search Bar -->
                <div class="flex-1 max-w-xl mx-4 hidden lg:block">
                    <form action="{{ route('products.index') }}" method="GET" class="relative">
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   placeholder="Cari produk, brand, atau kategori..."
                                   value="{{ request('search') }}"
                                   class="w-full py-2 pl-10 pr-4 rounded-full border border-gray-300 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-600">
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Side Icons -->
                <div class="flex items-center space-x-4">
                    <!-- Cart -->
                    <a href="#" class="relative text-gray-700 hover:text-blue-600">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                            0
                        </span>
                    </a>
                    
                    <!-- Wishlist -->
                    <a href="#" class="text-gray-700 hover:text-blue-600">
                        <i class="far fa-heart text-xl"></i>
                    </a>
                    
                    <!-- User Dropdown -->
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="hidden md:inline font-medium">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-200 dropdown-animation">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                </a>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="fas fa-user-circle mr-2"></i>Profil
                                </a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="fas fa-shopping-bag mr-2"></i>Pesanan
                                </a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="fas fa-heart mr-2"></i>Wishlist
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 hover:text-red-700">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Auth Links -->
                        <div class="hidden md:flex items-center space-x-3">
                            <a href="{{ route('login') }}" class="px-4 py-2 text-blue-600 hover:text-blue-800 font-medium">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow hover:shadow-md">
                                Daftar
                            </a>
                        </div>
                    @endauth
                    
                    <!-- Mobile Menu Button -->
                    <button class="md:hidden text-gray-700 hover:text-blue-600" id="mobile-menu-button">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Search Bar -->
            <div class="lg:hidden py-3 border-t border-gray-100" id="mobile-search" style="display: none;">
                <form action="{{ route('products.index') }}" method="GET" class="px-2">
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               placeholder="Cari produk..."
                               class="w-full py-2 pl-10 pr-4 rounded-full border border-gray-300 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Mobile Menu -->
            <div class="md:hidden bg-white border-t border-gray-100" id="mobile-menu" style="display: none;">
                <div class="px-2 py-3 space-y-1">
                    <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg {{ request()->is('/') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <i class="fas fa-home mr-3"></i>Beranda
                    </a>
                    <a href="{{ route('products.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg {{ request()->is('products*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <i class="fas fa-shopping-bag mr-3"></i>Produk
                    </a>
                    <a href="{{ route('categories.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg {{ request()->is('categories*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <i class="fas fa-list mr-3"></i>Kategori
                    </a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
                        <i class="fas fa-percent mr-3"></i>Promo
                    </a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
                        <i class="fas fa-shopping-cart mr-3"></i>Keranjang
                    </a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
                        <i class="far fa-heart mr-3"></i>Wishlist
                    </a>
                    
                    @auth
                        <div class="border-t border-gray-100 my-2 pt-2">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
                                <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
                            </a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
                                <i class="fas fa-user-circle mr-3"></i>Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 hover:text-red-700 rounded-lg">
                                    <i class="fas fa-sign-out-alt mr-3"></i>Keluar
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="border-t border-gray-100 my-2 pt-2 space-y-2">
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-center text-blue-600 hover:bg-blue-50 font-medium rounded-lg">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="block px-4 py-2 text-center bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-lg hover:from-blue-700 hover:to-blue-800">
                                Daftar
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="min-h-screen">
        @if(isset($header))
            <header class="bg-white shadow">
                <div class="container mx-auto px-4 py-6">
                    {{ $header }}
                </div>
            </header>
        @endif

        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        @if(file_exists(public_path('storage/logo.png')))
                            <img src="{{ asset('storage/logo.png') }}" alt="Zylomart" class="h-10 w-auto">
                        @else
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold text-xl">Z</span>
                            </div>
                        @endif
                        <span class="text-xl font-bold">Zylomart</span>
                    </div>
                    <p class="text-gray-400 mb-6">
                        Marketplace terlengkap dengan jutaan produk berkualitas dari berbagai seller terpercaya.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-blue-600 rounded-full flex items-center justify-center transition duration-200">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-blue-400 rounded-full flex items-center justify-center transition duration-200">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-pink-600 rounded-full flex items-center justify-center transition duration-200">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-green-500 rounded-full flex items-center justify-center transition duration-200">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold mb-6">Tautan Cepat</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition duration-200">Beranda</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-gray-400 hover:text-white transition duration-200">Produk</a></li>
                        <li><a href="{{ route('categories.index') }}" class="text-gray-400 hover:text-white transition duration-200">Kategori</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Promo</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Karir</a></li>
                    </ul>
                </div>

                <!-- Help & Support -->
                <div>
                    <h3 class="text-lg font-bold mb-6">Bantuan</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Pusat Bantuan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Cara Berbelanja</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Cara Pembayaran</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Pengiriman</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Pengembalian</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-200">Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-bold mb-6">Kontak</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-blue-400 mt-1 mr-3"></i>
                            <span class="text-gray-400">Jl. Marketplace No. 123, Jakarta, Indonesia</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone text-blue-400 mr-3"></i>
                            <span class="text-gray-400">+62 812 3456 7890</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-blue-400 mr-3"></i>
                            <span class="text-gray-400">support@zylomart.com</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-clock text-blue-400 mr-3"></i>
                            <span class="text-gray-400">Senin - Minggu, 24 Jam</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="mt-12 pt-8 border-t border-gray-800">
                <div class="max-w-md">
                    <h3 class="text-lg font-bold mb-4">Berlangganan Newsletter</h3>
                    <p class="text-gray-400 mb-4">Dapatkan promo dan info produk terbaru</p>
                    <form class="flex">
                        <input type="email" 
                               placeholder="Masukkan email Anda"
                               class="flex-grow py-3 px-4 rounded-l-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-r-lg transition duration-200">
                            Langganan
                        </button>
                    </form>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="mt-12 pt-8 border-t border-gray-800">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">
                        &copy; {{ date('Y') }} Zylomart. All rights reserved.
                    </p>
                    
                    <div class="flex flex-wrap gap-4 mt-4 md:mt-0">
                        <a href="#" class="text-gray-400 hover:text-white text-sm">Kebijakan Privasi</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm">Syarat & Ketentuan</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm">Kebijakan Cookie</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm">Peta Situs</a>
                    </div>
                    
                    <div class="mt-4 md:mt-0">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/e/e8/Layanan_pembayaran.png" 
                             alt="Payment Methods" 
                             class="h-8 opacity-80">
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            const search = document.getElementById('mobile-search');
            
            if (menu.style.display === 'block') {
                menu.style.display = 'none';
                search.style.display = 'none';
            } else {
                menu.style.display = 'block';
                search.style.display = 'block';
            }
        });

        // Cart count update (example)
        function updateCartCount(count) {
            document.querySelector('.fa-shopping-cart').nextElementSibling.textContent = count;
        }

        // Search focus
        document.querySelectorAll('input[name="search"]').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-blue-200');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-blue-200');
            });
        });

        // Scroll to top button
        const scrollToTopButton = document.createElement('button');
        scrollToTopButton.innerHTML = '<i class="fas fa-chevron-up"></i>';
        scrollToTopButton.className = 'fixed bottom-6 right-6 w-12 h-12 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-700 transition duration-200 z-40 flex items-center justify-center';
        scrollToTopButton.style.display = 'none';
        
        scrollToTopButton.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
        
        document.body.appendChild(scrollToTopButton);
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollToTopButton.style.display = 'flex';
            } else {
                scrollToTopButton.style.display = 'none';
            }
        });

        // Notification system
        window.showNotification = function(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300 ${
                type === 'success' ? 'bg-green-500 text-white' : 
                type === 'error' ? 'bg-red-500 text-white' : 
                'bg-blue-500 text-white'
            }`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} mr-3"></i>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 10);
            
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
    </script>
    
    @yield('scripts')
</body>
</html>