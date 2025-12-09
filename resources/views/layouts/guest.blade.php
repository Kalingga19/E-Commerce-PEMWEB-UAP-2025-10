<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Animations & Style -->
    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }

        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }

        .gradient-text {
            background: linear-gradient(90deg, #4F46E5, #7C3AED, #EC4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }
    </style>
</head>

<body class="font-sans antialiased bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">

    <!-- Background Effects -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-200 rounded-full blur-3xl opacity-70 animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-200 rounded-full blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-60 h-60 bg-pink-200 rounded-full blur-3xl opacity-60 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Main Container -->
    <div class="relative min-h-screen flex flex-col items-center justify-center p-4">

        <!-- Header with Logo -->
        <div class="w-full max-w-md mb-8 text-center">
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center space-x-4 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl blur-lg opacity-70 group-hover:opacity-100 transition"></div>

                    @if (function_exists('view') && View::exists('components.application-logo'))
                        <x-application-logo class="relative w-16 h-16 sm:w-20 sm:h-20 text-white group-hover:scale-110 transition" />
                    @else
                        <div class="relative w-16 h-16 bg-purple-600 rounded-2xl"></div>
                    @endif
                </div>

                <div class="text-left">
                    <h1 class="text-3xl sm:text-4xl font-bold gradient-text">{{ config('app.name', 'Laravel') }}</h1>
                    <p class="text-gray-600 text-sm">Welcome to our platform</p>
                </div>
            </a>
        </div>

        <!-- Main Card -->
        <div class="relative w-full sm:max-w-md">
            <div class="glass-effect rounded-2xl shadow-2xl overflow-hidden">

                <div class="h-2 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>

                <div class="px-6 py-8 sm:px-8 sm:py-10">

                    <!-- SLOT CONTENT FROM LOGIN/REGISTER -->
                    @yield('content')

                </div>

                <!-- Footer Links -->
                <div class="px-6 py-4 bg-gray-50 border-t">
                    <div class="flex flex-col sm:flex-row justify-between items-center space-y-2 sm:space-y-0">

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                                Lupa password?
                            </a>
                        @endif

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm text-purple-600 hover:underline">
                                Buat akun baru
                            </a>
                        @endif

                    </div>
                </div>

            </div>

            <!-- Bottom small info -->
            <div class="mt-8 text-center text-gray-600 text-sm">
                <p class="mb-3 flex justify-center items-center gap-2">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5..." />
                    </svg>
                    Secure & encrypted connection
                </p>

                <div class="flex justify-center gap-4 text-xs">
                    <a href="#" class="hover:text-blue-600">Privacy</a>
                    <span>•</span>
                    <a href="#" class="hover:text-blue-600">Terms</a>
                    <span>•</span>
                    <a href="#" class="hover:text-blue-600">Help</a>
                </div>

                <p class="mt-4 text-xs text-gray-500">
                    © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>
            </div>
        </div>
    </div>

</body>
</html>
