<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .auth-illustration {
            background: linear-gradient(135deg, #4f46e5, #7c3aed, #ec4899);
            background-size: 300% 300%;
            animation: gradientMove 8s ease infinite;
        }

        @keyframes gradientMove {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>

<body class="h-screen w-screen overflow-hidden bg-gray-50">

    <div class="flex h-full">

        <!-- LEFT SIDE (Branding / Illustration) -->
        <div class="hidden lg:flex w-1/2 auth-illustration text-white flex-col justify-center px-20 shadow-2xl">
            <h1 class="text-5xl font-bold leading-tight drop-shadow-xl">
                Selamat Datang di<br>
                <span class="text-yellow-300">Zylomart</span>
            </h1>

            <p class="mt-6 text-lg opacity-90">
                Marketplace modern dengan jutaan produk pilihan.
                Belanja lebih cepat, lebih aman, lebih nyaman.
            </p>

            <img src="{{ asset('images/windowshopping.svg') }}" class="mt-10 w-3/4 drop-shadow-2xl opacity-90">

        </div>

        <!-- RIGHT SIDE (Auth Form Container) -->
        <div class="w-full lg:w-1/2 flex justify-center items-start overflow-y-auto py-16 px-6">
            <div class="w-full max-w-md space-y-8">

                {{-- TITLE untuk REGISTER & LOGIN --}}
                @yield('auth-title')

                {{-- FORM --}}
                <div>
                    @yield('content')
                </div>

            </div>
        </div>


    </div>

</body>

</html>