<!DOCTYPE html>
<html lang="id" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplikasi E-Commerce untuk Ujian Praktikum Pemrograman Web">
    <meta name="keywords" content="e-commerce, laravel, toko online, belanja online">
    <meta name="author" content="Kelompok Praktikum">
    
    <!-- CSRF Token (penting untuk keamanan Laravel) -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Laravel E-Commerce')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    @stack('styles')
</head>
<body class="d-flex flex-column h-100">
    <!-- Navigation Bar -->
    @include('layouts.navigation')
    
    <!-- Main Content -->
    <main class="container mt-4 mb-auto" id="main-content">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
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
                        @auth
                            @if(auth()->user()->role === 'member')
                                <li><a href="{{ route('cart.index') }}" class="text-white">Keranjang</a></li>
                            @endif
                        @endauth
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Tim Pengembang</h5>
                    <p class="mb-1">Nama Kelompok: [Nama Kelompok]</p>
                    <p class="mb-1">Anggota 1: [Nama] - [NIM]</p>
                    <p class="mb-1">Anggota 2: [Nama] - [NIM]</p>
                    <p class="mb-1 mt-3">
                        <small>
                            <i class="bi bi-github"></i> 
                            <a href="https://github.com/your-repo" class="text-white" target="_blank">GitHub Repository</a>
                        </small>
                    </p>
                </div>
            </div>
            <hr class="bg-white my-3">
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Laravel E-Commerce. Ujian Praktikum Pemrograman Web.</p>
                <small class="text-muted">Dibangun dengan Laravel & Bootstrap</small>
            </div>
        </div>
    </footer>
    
    <!-- Modals -->
    @include('partials.modals.login')
    @include('partials.modals.register')
    @include('partials.modals.topup')
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery (optional, jika diperlukan) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- CSRF Token untuk AJAX -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>