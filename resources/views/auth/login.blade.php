@extends('layouts.guest')

@section('content')
    <div class="flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8 w-full max-w-md mx-auto">

        <!-- Logo -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
            <div class="flex justify-center">
                <div class="bg-white p-4 rounded-full shadow-lg">
                    @if(file_exists(public_path('storage/logo.png')))
                        <img src="{{ asset('storage/logo.png') }}" alt="Zylomart" class="h-16 w-auto">
                    @else
                        <div class="flex items-center justify-center h-16 w-16">
                            <span class="text-2xl font-bold text-blue-600">Z</span>
                        </div>
                    @endif
                </div>
            </div>

            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                Selamat Datang di <span class="text-blue-600">Zylomart</span>
            </h2>
            <p class="mt-2 text-sm text-gray-600">Marketplace Terlengkap & Terpercaya</p>
        </div>

        <!-- Form Card -->
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-6 shadow-2xl rounded-2xl border border-blue-100 sm:px-10">

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">
                            <i class="fas fa-envelope mr-2 text-blue-500"></i>Email
                        </label>
                        <div class="relative">
                            <i class="fas fa-user absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"></i>

                            <input type="email" name="email" required autofocus class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 
                                                       focus:ring-2 focus:ring-blue-300 py-3" placeholder="nama@email.com">
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex justify-between mb-2">
                            <label class="text-gray-700 text-sm font-medium">
                                <i class="fas fa-lock mr-2 text-blue-500"></i>Password
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-blue-600 text-sm">Lupa password?</a>
                            @endif
                        </div>

                        <div class="relative">
                            <i class="fas fa-key absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"></i>

                            <input id="login_password" type="password" name="password" required class="pl-10 pr-12 block w-full rounded-xl border-gray-300 shadow-sm 
                       focus:border-blue-500 focus:ring-2 focus:ring-blue-300 py-3" placeholder="••••••••">

                            <button type="button" onclick="togglePassword('login_password', 'eyeLogin')"
                                class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                                <i id="eyeLogin" class="fas fa-eye"></i>
                            </button>
                        </div>

                    </div>

                    <!-- Remember me -->
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                        <label class="ml-2 text-sm text-gray-700">Ingat saya</label>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 
                                            text-white font-semibold py-3 rounded-xl shadow-lg hover:shadow-xl transition-all">
                        <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                    </button>
                </form>

                <!-- Register Link -->
                <p class="mt-8 text-center text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-blue-600 font-medium">Daftar sekarang</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }
    </script>

@endsection