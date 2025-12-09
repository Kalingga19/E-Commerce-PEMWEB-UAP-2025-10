@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-blue-50 to-white">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <!-- Logo Zylomart -->
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
        
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Selamat Datang di <span class="text-blue-600">Zylomart</span>
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Marketplace Terlengkap & Terpercaya
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-6 shadow-2xl rounded-2xl sm:px-10 border border-blue-100">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-gray-700 text-sm font-medium mb-2">
                        <i class="fas fa-envelope mr-2 text-blue-500"></i>{{ __('Email') }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input id="email" 
                            class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50 transition duration-200 py-3" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus 
                            autocomplete="email"
                            placeholder="nama@email.com">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-gray-700 text-sm font-medium">
                            <i class="fas fa-lock mr-2 text-blue-500"></i>{{ __('Password') }}
                        </label>
                        @if (Route::has('password.request'))
                            <a class="text-sm text-blue-600 hover:text-blue-800 font-medium transition duration-200" href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-key text-gray-400"></i>
                        </div>
                        <input id="password" 
                            class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50 transition duration-200 py-3" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            placeholder="••••••••">
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" 
                        type="checkbox" 
                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500" 
                        name="remember">
                    <label for="remember_me" class="ml-2 text-sm text-gray-700">
                        Ingat saya
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg hover:shadow-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:-translate-y-0.5">
                        <i class="fas fa-sign-in-alt mr-2"></i>{{ __('Masuk') }}
                    </button>
                </div>
            </form>

            <!-- Divider -->
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">
                            Atau lanjutkan dengan
                        </span>
                    </div>
                </div>
            </div>

            <!-- Social Login (Optional) -->
            <div class="mt-6 grid grid-cols-2 gap-3">
                <div>
                    <a href="#" class="w-full inline-flex justify-center py-3 px-4 border border-gray-300 rounded-xl shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-200">
                        <i class="fab fa-google text-red-500 mr-2"></i>
                        Google
                    </a>
                </div>
                <div>
                    <a href="#" class="w-full inline-flex justify-center py-3 px-4 border border-gray-300 rounded-xl shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-200">
                        <i class="fab fa-facebook text-blue-600 mr-2"></i>
                        Facebook
                    </a>
                </div>
            </div>

            <!-- Register Link -->
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-800 transition duration-200 ml-1">
                        Daftar sekarang
                    </a>
                </p>
            </div>
        </div>

        <!-- Features -->
        <div class="mt-8 grid grid-cols-3 gap-4 text-center text-xs text-gray-500">
            <div class="bg-white p-3 rounded-lg shadow">
                <i class="fas fa-shipping-fast text-blue-500 text-lg mb-1"></i>
                <p>Gratis Ongkir</p>
            </div>
            <div class="bg-white p-3 rounded-lg shadow">
                <i class="fas fa-shield-alt text-blue-500 text-lg mb-1"></i>
                <p>100% Aman</p>
            </div>
            <div class="bg-white p-3 rounded-lg shadow">
                <i class="fas fa-headset text-blue-500 text-lg mb-1"></i>
                <p>24/7 Support</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .input-focus:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    .btn-gradient {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    }
</style>
@endsection