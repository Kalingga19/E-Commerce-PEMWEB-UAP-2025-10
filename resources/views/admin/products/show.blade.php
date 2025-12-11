<x-app-layout>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-lg">

        {{-- TITLE --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Detail Produk</h1>

            {{-- STATUS PRODUK --}}
            @if($product->status === 'active')
                <span class="px-3 py-1 bg-green-100 text-green-700 text-sm rounded-full">Aktif</span>
            @else
                <span class="px-3 py-1 bg-red-100 text-red-700 text-sm rounded-full">Suspend</span>
            @endif
        </div>

        {{-- PRODUK INFO --}}
        <div class="space-y-4 mb-8">

            <p>
                <strong>Nama Produk:</strong>
                {{ $product->name }}
            </p>

            <p>
                <strong>Kategori:</strong>
                {{ optional($product->category)->name ?? 'Tidak ada kategori' }}
            </p>

            <p>
                <strong>Harga:</strong>
                Rp {{ number_format($product->price) }}
            </p>

            <p>
                <strong>Deskripsi:</strong>
                {!! $product->description !!}
            </p>

        </div>

        <hr class="my-6">

        {{-- INFORMASI TOKO --}}
        <h2 class="text-xl font-semibold mb-4">Informasi Toko Pemilik</h2>

        <div class="space-y-3">

            <p>
                <strong>Nama Toko:</strong>
                {{ optional($product->store)->name ?? 'Toko tidak ditemukan' }}
            </p>

            <p>
                <strong>Pemilik Toko:</strong>
                {{ optional(optional($product->store)->user)->name ?? '-' }}
            </p>

            <p>
                <strong>Status Verifikasi Toko:</strong>

                @if(optional($product->store)->is_verified === true)
                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">Terverifikasi</span>
                @elseif(optional($product->store)->is_verified === false)
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm">Menunggu Verifikasi</span>
                @else
                    <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm">Ditolak</span>
                @endif
            </p>

            {{-- LINK KE PAGE VERIFIKASI ADMIN --}}
            @if(optional($product->store)->is_verified === false)
                <a href="{{ route('admin.verification') }}"
                    class="text-blue-600 underline hover:text-blue-800 text-sm">
                    Lihat halaman verifikasi toko →
                </a>
            @endif

        </div>

        <hr class="my-6">

        {{-- TOMBOL AKSI --}}
        <div class="flex space-x-4">

            {{-- Kembali --}}
            <a href="{{ route('admin.products.index') }}"
                class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                Kembali
            </a>

            {{-- Suspend / Activate --}}
            @if($product->status === 'active')
                <form method="POST" action="{{ route('admin.products.suspend', $product->id) }}">
                    @csrf
                    @method('PATCH')

                    <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Suspend Produk
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('admin.products.activate', $product->id) }}">
                    @csrf
                    @method('PATCH')

                    <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Aktifkan Produk
                    </button>
                </form>
            @endif

        </div>

    </div>

</x-app-layout>
