<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-shop"></i> Laravel Commerce
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">Produk</a>
                </li>
                
                @auth
                    @if(auth()->user()->role === 'member')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('checkout') }}">
                                <i class="bi bi-cart"></i> Keranjang
                                <span id="cart-count" class="badge bg-danger rounded-pill">{{ $cartCount ?? 0 }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('wallet.topup') }}">
                                <i class="bi bi-wallet2"></i> Topup
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('history') }}">
                                <i class="bi bi-clock-history"></i> Riwayat
                            </a>
                        </li>
                        
                        @if(auth()->user()->hasStore())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-shop-window"></i> Seller Dashboard
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('seller.profile') }}">Profil Toko</a></li>
                                    <li><a class="dropdown-item" href="{{ route('seller.products.index') }}">Produk</a></li>
                                    <li><a class="dropdown-item" href="{{ route('seller.orders.index') }}">Pesanan</a></li>
                                    <li><a class="dropdown-item" href="{{ route('seller.balance') }}">Saldo</a></li>
                                    <li><a class="dropdown-item" href="{{ route('seller.withdrawals.index') }}">Penarikan</a></li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('store.register') }}">Daftar Toko</a>
                            </li>
                        @endif
                    @endif
                    
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-gear"></i> Admin Panel
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.verification') }}">Verifikasi Toko</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">Manajemen User</a></li>
                            </ul>
                        </li>
                    @endif
                @endauth
            </ul>
            
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">
                            <i class="bi bi-person-plus"></i> Register
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile') }}">Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>