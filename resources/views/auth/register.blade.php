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
            Bergabung dengan <span class="text-blue-600">Zylomart</span>
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Mulai berbelanja dengan jutaan produk menarik
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-6 shadow-2xl rounded-2xl sm:px-10 border border-blue-100">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-gray-700 text-sm font-medium mb-2">
                        <i class="fas fa-user mr-2 text-blue-500"></i>{{ __('Nama Lengkap') }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-id-card text-gray-400"></i>
                        </div>
                        <input id="name" 
                            class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50 transition duration-200 py-3" 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}" 
                            required 
                            autofocus 
                            autocomplete="name"
                            placeholder="Nama lengkap Anda">
                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-gray-700 text-sm font-medium mb-2">
                        <i class="fas fa-envelope mr-2 text-blue-500"></i>{{ __('Email') }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-at text-gray-400"></i>
                        </div>
                        <input id="email" 
                            class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50 transition duration-200 py-3" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
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
                    <label for="password" class="block text-gray-700 text-sm font-medium mb-2">
                        <i class="fas fa-lock mr-2 text-blue-500"></i>{{ __('Password') }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-key text-gray-400"></i>
                        </div>
                        <input id="password" 
                            class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50 transition duration-200 py-3" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="new-password"
                            placeholder="Minimal 8 karakter">
                    </div>
                    <p class="mt-1 text-xs text-gray-500">
                        Gunakan kombinasi huruf, angka, dan simbol untuk keamanan lebih
                    </p>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-medium mb-2">
                        <i class="fas fa-lock mr-2 text-blue-500"></i>{{ __('Konfirmasi Password') }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-key text-gray-400"></i>
                        </div>
                        <input id="password_confirmation" 
                            class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50 transition duration-200 py-3" 
                            type="password" 
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            placeholder="Ketik ulang password">
                    </div>
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-center">
                    <input id="terms" 
                        type="checkbox" 
                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500" 
                        name="terms"
                        required>
                    <label for="terms" class="ml-2 text-sm text-gray-700">
                        Saya menyetujui 
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Syarat & Ketentuan</a>
                        dan 
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Kebijakan Privasi</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg hover:shadow-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:-translate-y-0.5">
                        <i class="fas fa-user-plus mr-2"></i>{{ __('Daftar Sekarang') }}
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
                            Daftar cepat dengan
                        </span>
                    </div>
                </div>
            </div>

            <!-- Social Register -->
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

            <!-- Login Link -->
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-800 transition duration-200 ml-1">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </div>

        <!-- Benefits -->
        <div class="mt-8 bg-white p-6 rounded-2xl shadow-lg">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 text-center">
                <i class="fas fa-gift text-blue-500 mr-2"></i>Keuntungan Bergabung
            </h3>
            <ul class="space-y-3 text-sm text-gray-600">
                <li class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <span>Akses ke jutaan produk dari berbagai kategori</span>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <span>Voucher dan diskon khusus member</span>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <span>Transaksi aman dengan sistem escrow</span>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <span>Gratis ongkir untuk pembelian pertama</span>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <span>Dukungan customer service 24/7</span>
                </li>
            </ul>
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
</style>
@endsection