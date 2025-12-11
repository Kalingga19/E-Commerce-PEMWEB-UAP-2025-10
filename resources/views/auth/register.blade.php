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
                Bergabung dengan <span class="text-blue-600">Zylomart</span>
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Mulai belanja dengan jutaan produk menarik
            </p>
        </div>

        <!-- Form Card -->
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-6 shadow-2xl rounded-2xl border border-blue-100 sm:px-10">

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">
                            <i class="fas fa-user mr-2 text-blue-500"></i>Nama Lengkap
                        </label>
                        <div class="relative">
                            <i class="fas fa-id-card absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"></i>
                            <input type="text" name="name" value="{{ old('name') }}" required class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm 
                                               focus:border-blue-500 focus:ring-2 focus:ring-blue-300 py-3"
                                placeholder="Nama lengkap Anda">
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">
                            <i class="fas fa-envelope mr-2 text-blue-500"></i>Email
                        </label>
                        <div class="relative">
                            <i class="fas fa-at absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"></i>
                            <input type="email" name="email" required class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm 
                                               focus:border-blue-500 focus:ring-2 focus:ring-blue-300 py-3"
                                placeholder="nama@email.com">
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">
                            <i class="fas fa-lock mr-2 text-blue-500"></i>Password
                        </label>

                        <div class="relative">
                            <i class="fas fa-key absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"></i>

                            <input id="password" type="password" name="password" required class="pl-10 pr-12 block w-full rounded-xl border-gray-300 shadow-sm 
                       focus:border-blue-500 focus:ring-2 focus:ring-blue-300 py-3" placeholder="Minimal 8 karakter">

                            <!-- Eye Icon -->
                            <button type="button" onclick="togglePassword('password', 'eye1')"
                                class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                                <i id="eye1" class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">
                            <i class="fas fa-lock mr-2 text-blue-500"></i>Konfirmasi Password
                        </label>

                        <div class="relative">
                            <i class="fas fa-key absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"></i>

                            <input id="password_confirmation" type="password" name="password_confirmation" required class="pl-10 pr-12 block w-full rounded-xl border-gray-300 shadow-sm 
                       focus:border-blue-500 focus:ring-2 focus:ring-blue-300 py-3" placeholder="Ketik ulang password">

                            <!-- Eye Icon -->
                            <button type="button" onclick="togglePassword('password_confirmation', 'eye2')"
                                class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                                <i id="eye2" class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>


                    <!-- Submit -->
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold py-3 rounded-xl 
                                        shadow-lg hover:shadow-xl transition-all">
                        <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                    </button>
                </form>

                <!-- Login link -->
                <p class="mt-8 text-center text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-blue-600 font-medium">Masuk di sini</a>
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