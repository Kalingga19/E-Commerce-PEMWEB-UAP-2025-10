<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel E-Commerce')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>
    <!-- Navigation Bar -->
    @include('layouts.navigation')
    
    <!-- Main Content -->
    <main class="container mt-4" id="main-content">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-dark text-white mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Laravel Commerce</h5>
                    <p>Aplikasi E-Commerce untuk Ujian Praktikum Pemrograman Web</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-white">Beranda</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-white">Produk</a></li>
                        <li><a href="{{ route('history') }}" class="text-white">Riwayat Transaksi</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Tim Pengembang</h5>
                    <p class="mb-1">Nama Kelompok: [Nama Kelompok]</p>
                    <p class="mb-1">Anggota 1: [Nama] - [NIM]</p>
                    <p class="mb-1">Anggota 2: [Nama] - [NIM]</p>
                </div>
            </div>
            <hr class="bg-white">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Laravel E-Commerce. Ujian Praktikum Pemrograman Web.</p>
            </div>
        </div>
    </footer>
    
    <!-- Modals -->
    @include('partials.modals.login')
    @include('partials.modals.register')
    @include('partials.modals.topup')
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>