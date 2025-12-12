<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="container mx-auto px-4 py-10">

            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Katalog Produk</h1>
                    <p class="text-gray-600">Temukan produk dari berbagai toko</p>
                </div>

                <!-- Quick info -->
                <div class="text-sm text-gray-500">
                    @if(isset($products))
                        Menampilkan <span class="font-semibold text-gray-700">{{ $products->count() }}</span>
                        dari <span class="font-semibold text-gray-700">{{ $products->total() }}</span> produk
                    @endif
                </div>
            </div>

            <!-- Filter Bar -->
            <form method="GET" action="{{ url('/products') }}" class="bg-white rounded-2xl shadow-sm p-4 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">

                    <!-- Search -->
                    <div class="md:col-span-5">
                        <label class="text-sm font-semibold text-gray-700">Cari Produk</label>
                        <input
                            type="text"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Cari nama produk..."
                            class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        />
                    </div>

                    <!-- Category -->
                    <div class="md:col-span-3">
                        <label class="text-sm font-semibold text-gray-700">Kategori</label>
                        <select
                            name="category"
                            class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        >
                            <option value="">Semua Kategori</option>
                            @if(isset($categories))
                                @foreach($categories as $cat)
                                    <option
                                        value="{{ $cat->slug }}"
                                        @selected(request('category') == $cat->slug)
                                    >
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Sort -->
                    <div class="md:col-span-2">
                        <label class="text-sm font-semibold text-gray-700">Urutkan</label>
                        <select
                            name="sort"
                            class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        >
                            <option value="latest" @selected(request('sort','latest') == 'latest')>Terbaru</option>
                            <option value="price_asc" @selected(request('sort') == 'price_asc')>Harga Termurah</option>
                            <option value="price_desc" @selected(request('sort') == 'price_desc')>Harga Termahal</option>
                            <option value="name_asc" @selected(request('sort') == 'name_asc')>Nama A-Z</option>
                            <option value="name_desc" @selected(request('sort') == 'name_desc')>Nama Z-A</option>
                        </select>
                    </div>

                    <!-- Submit -->
                    <div class="md:col-span-2 flex gap-2 md:justify-end">
                        <button
                            type="submit"
                            class="w-full md:w-auto mt-6 md:mt-0 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition"
                        >
                            Terapkan
                        </button>

                        <a
                            href="{{ url('/products') }}"
                            class="w-full md:w-auto mt-6 md:mt-0 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-semibold transition text-center"
                        >
                            Reset
                        </a>
                    </div>
                </div>
            </form>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8">
                @if(isset($products) && $products->count())
                    @foreach($products as $product)
                        @php
                            $thumb = $product->productImages->where('is_thumbnail', true)->first()
                                    ?? $product->productImages->first();
                        @endphp

                        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden group">
                            <!-- Image -->
                            <a href="{{ route('product.show', $product->slug) }}" class="block">
                                <div class="relative bg-gray-100 overflow-hidden aspect-[4/5]">
                                    @if($thumb)
                                        <img
                                            src="{{ asset('storage/' . $thumb->image) }}"
                                            class="w-full h-full object-contain p-2 transition duration-300 group-hover:scale-105"
                                            alt="{{ $product->name }}"
                                        >
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            No Image
                                        </div>
                                    @endif
                                </div>
                            </a>

                            <!-- Info -->
                            <div class="p-3">
                                <div class="mb-1">
                                    @if($product->productCategory)
                                        <span class="text-[11px] px-2 py-1 rounded-lg bg-blue-50 text-blue-700">
                                            {{ $product->productCategory->name }}
                                        </span>
                                    @endif
                                </div>

                                <a href="{{ route('product.show', $product->slug) }}">
                                    <h3 class="font-semibold text-gray-900 mb-1 text-sm line-clamp-2 min-h-[2.3rem]">
                                        {{ $product->name }}
                                    </h3>
                                </a>

                                <p class="text-green-600 font-bold text-base mb-1">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>

                                <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                                    <span>{{ $product->store->name ?? 'Toko' }}</span>
                                    <span>Stok: {{ $product->stock }}</span>
                                </div>

                                {{-- Tombol cart hanya untuk member (karena route cart ada di middleware member) --}}
                                @auth
                                    @if(auth()->user()->role === 'member')
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="qty" value="1">

                                            <button type="submit"
                                                class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg">
                                                + Tambah
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('product.show', $product->slug) }}"
                                            class="block w-full text-center py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg">
                                            Lihat Detail
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('product.show', $product->slug) }}"
                                        class="block w-full text-center py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg">
                                        Lihat Detail
                                    </a>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-full text-center text-gray-500 py-10">
                        Produk belum tersedia.
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if(isset($products))
                <div class="mt-10">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-app-layout>
