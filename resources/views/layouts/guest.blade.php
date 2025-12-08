<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Zylomart') }} - Marketplace Terlengkap</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Animations & Style -->
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }

        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-blob { animation: blob 7s infinite; }
        .animate-shimmer {
            background: linear-gradient(90deg, 
                rgba(255,255,255,0) 0%, 
                rgba(255,255,255,0.6) 50%, 
                rgba(255,255,255,0) 100%);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite linear;
        }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }

        .gradient-text {
            background: linear-gradient(90deg, #1e40af, #3b82f6, #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .zylomart-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.1);
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            transition: transform 0.3s ease;
        }

        /* Custom scrollbar */
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
    </style>
</head>

<body class="font-sans antialiased bg-gradient-to-br from-blue-50 via-sky-50 to-indigo-50 min-h-screen overflow-x-hidden">

    <!-- Background Effects -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-200 rounded-full blur-3xl opacity-60 animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-sky-200 rounded-full blur-3xl opacity-60 animate-blob animation-delay-2000"></div>
        <div class="absolute top-1/2 right-1/4 w-72 h-72 bg-indigo-200 rounded-full blur-3xl opacity-50 animate-blob animation-delay-4000"></div>
        
        <!-- Floating elements -->
        <div class="absolute top-20 left-10 w-20 h-20 rounded-full bg-gradient-to-r from-blue-400 to-cyan-400 opacity-20 animate-float"></div>
        <div class="absolute bottom-32 right-20 w-16 h-16 rounded-full bg-gradient-to-r from-indigo-400 to-purple-400 opacity-20 animate-float animation-delay-2000"></div>
        <div class="absolute top-1/3 left-1/3 w-12 h-12 rounded-lg bg-gradient-to-r from-blue-300 to-sky-300 opacity-20 rotate-45 animate-float animation-delay-4000"></div>
    </div>

    <!-- Main Container -->
    <div class="relative min-h-screen flex flex-col items-center justify-center p-4 sm:p-6 z-10">

        <!-- Header with Logo -->
        <div class="w-full max-w-2xl mb-6 sm:mb-10 text-center">
            <a href="{{ url('/') }}" class="inline-flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6 group hover-lift transition-all duration-300">
                
                <!-- Logo Container -->
                <div class="relative">
                    <!-- Glow effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-600 rounded-3xl blur-xl opacity-50 group-hover:opacity-70 transition-opacity duration-300"></div>
                    
                    <!-- Logo or placeholder -->
                    @if(file_exists(public_path('storage/logo.png')))
                        <div class="relative bg-white p-5 rounded-2xl shadow-2xl border-2 border-white">
                            <img src="{{ asset('storage/logo.png') }}" alt="Zylomart" class="w-20 h-20 sm:w-24 sm:h-24 object-contain">
                        </div>
                    @else
                        <div class="relative w-24 h-24 sm:w-28 sm:h-28 bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl flex items-center justify-center shadow-2xl border-4 border-white">
                            <span class="text-4xl sm:text-5xl font-bold text-white">Z</span>
                            <div class="absolute inset-0 rounded-2xl border-2 border-white/30"></div>
                        </div>
                    @endif
                </div>

                <!-- Brand Text -->
                <div class="text-center sm:text-left">
                    <h1 class="text-4xl sm:text-5xl font-black gradient-text tracking-tight">
                        Zylomart
                    </h1>
                    <div class="mt-2">
                        <p class="text-lg sm:text-xl font-semibold text-gray-700">Marketplace Terlengkap</p>
                        <div class="mt-1 flex items-center justify-center sm:justify-start space-x-2 text-sm text-gray-600">
                            <span class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-1"></i>
                                <span>Aman</span>
                            </span>
                            <span class="text-gray-300">•</span>
                            <span class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-1"></i>
                                <span>Terpercaya</span>
                            </span>
                            <span class="text-gray-300">•</span>
                            <span class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-1"></i>
                                <span>Lengkap</span>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Main Card -->
        <div class="relative w-full max-w-md sm:max-w-lg">
            <!-- Decorative top border -->
            <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 w-24 h-3 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-t-lg"></div>
            
            <div class="glass-effect rounded-3xl shadow-2xl overflow-hidden border border-white/50 relative">
                <!-- Shimmer effect overlay -->
                <div class="absolute inset-0 animate-shimmer rounded-3xl pointer-events-none"></div>
                
                <!-- Content Area -->
                <div class="px-6 py-8 sm:px-10 sm:py-10 relative z-10">
                    @yield('content')
                </div>

                <!-- Footer Links -->
                <div class="px-6 py-5 bg-gradient-to-r from-blue-50 to-white border-t border-gray-100">
                    <div class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0">
                        
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline transition duration-200 flex items-center">
                                <i class="fas fa-key mr-2"></i>
                                Lupa Password?
                            </a>
                        @endif

                        @if (Route::has('register') && Request::is('login'))
                            <a href="{{ route('register') }}" class="text-sm font-medium bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-md hover:shadow-lg flex items-center">
                                <i class="fas fa-user-plus mr-2"></i>
                                Daftar Gratis
                            </a>
                        @endif

                        @if (Route::has('login') && Request::is('register'))
                            <a href="{{ route('login') }}" class="text-sm font-medium bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-md hover:shadow-lg flex items-center">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Masuk Sekarang
                            </a>
                        @endif

                    </div>
                </div>

            </div>

            <!-- Marketplace Features -->
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white/80 backdrop-blur-sm rounded-xl p-4 text-center shadow-lg border border-blue-100 hover:border-blue-300 transition duration-200">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-shipping-fast text-white text-xl"></i>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-1">Gratis Ongkir</h4>
                    <p class="text-xs text-gray-600">Min. pembelian Rp 50.000</p>
                </div>

                <div class="bg-white/80 backdrop-blur-sm rounded-xl p-4 text-center shadow-lg border border-blue-100 hover:border-blue-300 transition duration-200">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-shield-alt text-white text-xl"></i>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-1">100% Aman</h4>
                    <p class="text-xs text-gray-600">Garansi uang kembali</p>
                </div>

                <div class="bg-white/80 backdrop-blur-sm rounded-xl p-4 text-center shadow-lg border border-blue-100 hover:border-blue-300 transition duration-200">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-headset text-white text-xl"></i>
                    </div>
                    <h4 class="font-semibold text-gray-800 mb-1">Bantuan 24/7</h4>
                    <p class="text-xs text-gray-600">Customer service siap membantu</p>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-10 text-center">
                <!-- Social Links -->
                <div class="flex justify-center space-x-6 mb-6">
                    <a href="#" class="w-10 h-10 rounded-full bg-blue-100 hover:bg-blue-200 flex items-center justify-center text-blue-600 hover:text-blue-800 transition duration-200">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-blue-100 hover:bg-blue-200 flex items-center justify-center text-blue-600 hover:text-blue-800 transition duration-200">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-blue-100 hover:bg-blue-200 flex items-center justify-center text-blue-600 hover:text-blue-800 transition duration-200">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-blue-100 hover:bg-blue-200 flex items-center justify-center text-blue-600 hover:text-blue-800 transition duration-200">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>

                <!-- Links -->
                <div class="flex flex-wrap justify-center gap-4 text-sm text-gray-600 mb-4">
                    <a href="#" class="hover:text-blue-600 hover:underline transition duration-200">Tentang Zylomart</a>
                    <span class="text-gray-300">•</span>
                    <a href="#" class="hover:text-blue-600 hover:underline transition duration-200">Kebijakan Privasi</a>
                    <span class="text-gray-300">•</span>
                    <a href="#" class="hover:text-blue-600 hover:underline transition duration-200">Syarat & Ketentuan</a>
                    <span class="text-gray-300">•</span>
                    <a href="#" class="hover:text-blue-600 hover:underline transition duration-200">Bantuan</a>
                    <span class="text-gray-300">•</span>
                    <a href="#" class="hover:text-blue-600 hover:underline transition duration-200">Karir</a>
                </div>

                <!-- Copyright -->
                <p class="text-xs text-gray-500 mt-6">
                    <i class="fas fa-copyright mr-1"></i> {{ date('Y') }} <span class="font-semibold text-blue-600">Zylomart</span>. 
                    Marketplace Indonesia. All rights reserved.
                </p>
                
                <!-- Secure Badge -->
                <div class="mt-4 inline-flex items-center space-x-2 text-xs text-gray-500 bg-white/50 px-4 py-2 rounded-full">
                    <i class="fas fa-lock text-green-500"></i>
                    <span>Secure & Encrypted Connection</span>
                    <i class="fas fa-shield-alt text-blue-500"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Add hover effect to interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            const interactiveElements = document.querySelectorAll('a, button');
            
            interactiveElements.forEach(element => {
                element.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                
                element.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Add loading animation
            const mainCard = document.querySelector('.glass-effect');
            if (mainCard) {
                mainCard.style.opacity = '0';
                mainCard.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    mainCard.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    mainCard.style.opacity = '1';
                    mainCard.style.transform = 'translateY(0)';
                }, 100);
            }
        });
    </script>
</body>
</html>