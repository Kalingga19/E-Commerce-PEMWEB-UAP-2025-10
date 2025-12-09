<x-app-layout>
    <div class="max-w-5xl mx-auto py-10">
        
        <a href="{{ route('seller.products.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">
            ← Kembali ke Daftar Produk
        </a>

        <div class="bg-white shadow-lg rounded-xl p-6">

            <h1 class="text-2xl font-bold text-gray-900 mb-4">
                Detail Produk – {{ $product->name }}
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Image --}}
                <div class="space-y-3">
                    @foreach($product->productImages as $img)
                        <img src="{{ asset('storage/' . $img->image) }}" 
                             class="w-full rounded-xl border shadow">
                    @endforeach
                </div>

                {{-- Info --}}
                <div class="space-y-4">
                    <p><strong>Harga:</strong> Rp {{ number_format($product->price,0,',','.') }}</p>
                    <p><strong>Stok:</strong> {{ $product->stock }}</p>
                    <p><strong>Kategori:</strong> {{ $product->category->name ?? '-' }}</p>
                    <p><strong>Dibuat:</strong> {{ $product->created_at->format('d M Y') }}</p>

                    <div>
                        <strong>Deskripsi:</strong>
                        <p class="text-gray-600 mt-1">{{ $product->description }}</p>
                    </div>

                    <div class="flex space-x-3 mt-4">
                        <a href="{{ route('seller.products.edit', $product->id) }}"
                           class="px-4 py-2 bg-blue-600 text-white rounded-lg">Edit Produk</a>

                        <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST"
                              onsubmit="return confirm('Yakin hapus produk?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-4 py-2 bg-red-600 text-white rounded-lg">Hapus</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
