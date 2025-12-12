<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section dengan Carousel -->
        <section class="relative bg-gradient-to-r from-blue-600 to-indigo-700 text-white overflow-hidden">
            <!-- Carousel Container -->
            <div class="relative h-[500px] md:h-[600px]">
                <!-- Carousel Items -->
                <div id="carousel-item-1"
                    class="absolute inset-0 h-[600px] w-full transition-opacity duration-1000 ease-in-out opacity-100">

                    <img src="https://images.pexels.com/photos/298864/pexels-photo-298864.jpeg?auto=compress&cs=tinysrgb&w=1600"
                        class="absolute inset-0 w-full h-full object-cover z-0" alt="Sale Banner">

                    <div class="absolute inset-0 bg-gradient-to-r from-black/40 to-transparent z-10"></div>

                    <div class="container mx-auto px-4 h-full flex items-center relative z-20">
                        <div class="max-w-2xl">
                            <h1 class="text-4xl md:text-6xl font-bold mb-4 animate-fade-in">Flash Sale<br>Special Offers
                            </h1>
                            <p class="text-xl mb-8 text-blue-100">
                                Diskon hingga 70% untuk produk pilihan. Waktu terbatas!
                            </p>
                            <a href="#products" class="inline-block bg-white text-blue-600 px-8 py-4 rounded-xl font-bold hover:bg-gray-100 
                                    transition-all duration-300 transform hover:-translate-y-1 shadow-lg">
                                Belanja Sekarang
                            </a>
                        </div>
                    </div>
                </div>

                <div id="carousel-item-1"
                    class="absolute inset-0 h-[600px] w-full transition-opacity duration-1000 ease-in-out opacity-100">

                    <img src="https://images.pexels.com/photos/3965545/pexels-photo-3965545.jpeg?auto=compress&cs=tinysrgb&w=1600"
                        class="absolute inset-0 w-full h-full object-cover z-0" alt="Sale Banner">

                    <div class="absolute inset-0 bg-gradient-to-r from-black/40 to-transparent z-10"></div>

                    <div class="container mx-auto px-4 h-full flex items-center relative z-20">
                        <div class="max-w-2xl">
                            <h1 class="text-4xl md:text-6xl font-bold mb-4 animate-fade-in">New Arrivals<br>2025
                                Collection</h1>
                            <p class="text-xl mb-8 text-blue-100">
                                Temukan produk terbaru dengan kualitas premium
                            </p>
                            <a href="#products" class="inline-block bg-white text-blue-600 px-8 py-4 rounded-xl font-bold hover:bg-gray-100 
                                    transition-all duration-300 transform hover:-translate-y-1 shadow-lg">
                                Lihat Koleksi
                            </a>
                        </div>
                    </div>
                </div>

                <div id="carousel-item-1"
                    class="absolute inset-0 h-[600px] w-full transition-opacity duration-1000 ease-in-out opacity-100">

                    <img src="https://images.pexels.com/photos/5632395/pexels-photo-5632395.jpeg?auto=compress&cs=tinysrgb&w=1600"
                        class="absolute inset-0 w-full h-full object-cover z-0" alt="Sale Banner">

                    <div class="absolute inset-0 bg-gradient-to-r from-black/40 to-transparent z-10"></div>

                    <div class="container mx-auto px-4 h-full flex items-center relative z-20">
                        <div class="max-w-2xl">
                            <h1 class="text-4xl md:text-6xl font-bold mb-4 animate-fade-in">Free Shipping<br>Minimal
                                Purchase</h1>
                            <p class="text-xl mb-8 text-blue-100">
                                Gratis ongkir untuk pembelian di atas Rp 500.000
                            </p>
                            <a href="#products" class="inline-block bg-white text-blue-600 px-8 py-4 rounded-xl font-bold hover:bg-gray-100 
                                    transition-all duration-300 transform hover:-translate-y-1 shadow-lg">
                                Mulai Belanja
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Carousel Controls -->
                <button onclick="prevSlide()"
                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/30 backdrop-blur-sm p-3 rounded-full z-30 transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </button>
                <button onclick="nextSlide()"
                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/30 backdrop-blur-sm p-3 rounded-full z-30 transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                <!-- Carousel Indicators -->
                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2 z-30">
                    <button onclick="goToSlide(0)" class="w-3 h-3 rounded-full bg-white"></button>
                    <button onclick="goToSlide(1)" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white"></button>
                    <button onclick="goToSlide(2)" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white"></button>
                </div>
            </div>
        </section>

        <!-- Promo Banner Section -->
        <section class="py-12 bg-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="relative overflow-hidden rounded-2xl group">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500"
                            alt="Fashion">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <h3 class="text-xl font-bold mb-2">Fashion Collection</h3>
                            <p class="text-blue-200">Diskon hingga 50%</p>
                        </div>
                    </div>

                    <div class="relative overflow-hidden rounded-2xl group">
                        <img src="https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500"
                            alt="Electronics">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <h3 class="text-xl font-bold mb-2">Electronics</h3>
                            <p class="text-blue-200">Produk terbaru 2025</p>
                        </div>
                    </div>

                    <div class="relative overflow-hidden rounded-2xl group">
                        <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500"
                            alt="Home Appliances">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <h3 class="text-xl font-bold mb-2">Home Appliances</h3>
                            <p class="text-blue-200">Beli 1 gratis 1</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Categories -->
        <section class="py-12 bg-gray-100">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Kategori Populer</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Jelajahi berbagai kategori produk terbaik kami</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @foreach($categories as $category)
                    <a href="{{ route('category.filter', $category->slug) }}" class="group">
                        <div
                            class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 text-center">
                            <div
                                class="w-16 h-16 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <h3
                                class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">
                                {{ $category->name }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">{{ rand(50, 500) }} produk</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Featured Products -->
        <section id="products" class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center mb-12">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Produk Terbaru</h2>
                        <p class="text-gray-600">Temukan produk berkualitas dari berbagai toko terpercaya</p>
                    </div>
                    <a href="{{ route('products.index') }}"
                        class="text-blue-600 hover:text-blue-800 font-semibold flex items-center gap-2">
                        Lihat Semua
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8">
                    @if(isset($latestProducts) && $latestProducts->count())
                    @foreach($latestProducts as $product)
                    @php
                    $thumb = $product->productImages->where('is_thumbnail', true)->first() ?? $product->productImages->first();
                    @endphp

                    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden group">\

                        <!-- Gambar Produk -->
                        <div class="relative bg-gray-100 overflow-hidden aspect-[4/5]">
                            @if($thumb)
                            <img src="{{ asset('storage/' . $thumb->image) }}" class="w-full h-full object-contain p-2 transition duration-300 group-hover:scale-105">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                No Image
                            </div>
                            @endif
                        </div>

                        <!-- Info -->
                        <div class="p-3">
                            <h3 class="font-semibold text-gray-900 mb-1 text-sm line-clamp-2 min-h-[2.3rem]">
                                {{ $product->name }}
                            </h3>

                            <p class="text-green-600 font-bold text-base mb-1">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>

                            <div class="flex items-center gap-1 mb-3">
                                <span class="text-xs text-gray-600">⭐ 4.8</span>
                            </div>

                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="qty" value="1">

                                <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg">
                                    + Tambah
                                </button>
                            </form>
                        </div>
                    </div>

                    @endforeach

                    @else
                    <p class="col-span-full text-center text-gray-500">
                        Produk belum tersedia
                    </p>

                    @endif
                </div>

                <!-- View All Button -->
                <div class="text-center mt-12">
                    <a href="{{ route('products.index') }}"
                        class="inline-block px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        Lihat Semua Produk
                    </a>
                </div>
            </div>
        </section>

        {{-- CTA Register Store (hanya member yang login & belum verified) --}}
        @auth
        @if(auth()->user()->role === 'member')
        @php
        $store = auth()->user()->store;
        @endphp

        <section class="py-14 bg-white">
            <div class="container mx-auto px-4">
                <div class="rounded-3xl overflow-hidden border border-blue-100 shadow-sm bg-gradient-to-r from-blue-50 to-indigo-50">
                    <div class="p-8 md:p-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                        <div class="max-w-2xl">
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">
                                Mau mulai jualan di platform ini?
                            </h2>

                            @if(!$store)
                            <p class="text-gray-700">
                                Daftarkan toko kamu sekarang. Proses cepat dan setelah diverifikasi kamu bisa akses dashboard seller.
                            </p>
                            @elseif($store && !$store->is_verified)
                            <p class="text-gray-700">
                                Toko <b>{{ $store->name }}</b> sudah terdaftar, tinggal tunggu verifikasi admin / lanjut verifikasi.
                            </p>
                            @else
                            <p class="text-gray-700">
                                Toko kamu sudah aktif. Kamu bisa langsung masuk ke dashboard seller.
                            </p>
                            @endif
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            @if(!$store)
                            <a href="{{ route('store.register') }}"
                                class="inline-flex items-center justify-center px-7 py-4 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-lg transition">
                                Daftar Toko
                            </a>
                            @elseif($store && !$store->is_verified)
                            <a href="{{ route('seller.store.verify') }}"
                                class="inline-flex items-center justify-center px-7 py-4 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-lg transition">
                                Lanjut Verifikasi
                            </a>

                            <a href="{{ route('store.register') }}"
                                class="inline-flex items-center justify-center px-7 py-4 rounded-2xl bg-white hover:bg-gray-50 text-gray-800 font-semibold border border-gray-200 transition">
                                Edit Data Toko
                            </a>
                            @else
                            <a href="{{ route('seller.dashboard') }}"
                                class="inline-flex items-center justify-center px-7 py-4 rounded-2xl bg-green-600 hover:bg-green-700 text-white font-semibold shadow-lg transition">
                                Ke Dashboard Seller
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        @endauth


        <!-- Why Choose Us Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Kenapa Memilih Kami?</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Kami berkomitmen memberikan pengalaman belanja terbaik
                        untuk Anda</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div
                            class="w-20 h-20 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Produk Berkualitas</h3>
                        <p class="text-gray-600">100% produk original dengan garansi resmi</p>
                    </div>

                    <div class="text-center">
                        <div
                            class="w-20 h-20 bg-gradient-to-r from-green-100 to-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Pengiriman Cepat</h3>
                        <p class="text-gray-600">Dikirim dalam 24 jam setelah pemesanan</p>
                    </div>

                    <div class="text-center">
                        <div
                            class="w-20 h-20 bg-gradient-to-r from-purple-100 to-pink-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Pembayaran Aman</h3>
                        <p class="text-gray-600">Berbagai metode pembayaran terpercaya</p>
                    </div>

                    <div class="text-center">
                        <div
                            class="w-20 h-20 bg-gradient-to-r from-orange-100 to-red-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Support 24/7</h3>
                        <p class="text-gray-600">Customer service siap membantu kapan saja</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold mb-4">Tetap Update dengan Promo Terbaru</h2>
                <p class="text-blue-100 mb-8 max-w-2xl mx-auto">Daftarkan email Anda untuk mendapatkan notifikasi promo
                    eksklusif dan penawaran spesial</p>

                <form class="max-w-md mx-auto flex gap-4">
                    <input type="email" placeholder="Masukkan email Anda"
                        class="flex-1 px-6 py-4 rounded-2xl text-gray-900 focus:outline-none focus:ring-4 focus:ring-white/30">
                    <button type="submit"
                        class="px-8 py-4 bg-white text-blue-600 font-semibold rounded-2xl hover:bg-blue-50 transition-all duration-300 shadow-lg">
                        Berlangganan
                    </button>
                </form>
            </div>
        </section>
    </div>

    <script>
        // Carousel functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('[id^="carousel-item-"]');
        const totalSlides = slides.length;

        function showSlide(n) {
            // Wrap around if needed
            if (n >= totalSlides) currentSlide = 0;
            else if (n < 0) currentSlide = totalSlides - 1;
            else currentSlide = n;

            // Update all slides
            slides.forEach((slide, index) => {
                slide.style.opacity = index === currentSlide ? '1' : '0';
                slide.style.zIndex = index === currentSlide ? '20' : '10';
            });

            // Update indicators
            updateIndicators();
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }

        function goToSlide(n) {
            showSlide(n);
        }

        function updateIndicators() {
            const indicators = document.querySelectorAll('.absolute.bottom-6 button');
            indicators.forEach((indicator, index) => {
                indicator.className = index === currentSlide ?
                    'w-3 h-3 rounded-full bg-white' :
                    'w-3 h-3 rounded-full bg-white/50 hover:bg-white';
            });
        }

        // Auto slide every 5 seconds
        setInterval(nextSlide, 5000);

        // Initialize first slide
        showSlide(0);
    </script>

    <style>
        .animate-fade-in {
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-app-layout>