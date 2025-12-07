<x-app-layout>
<h2 class="text-xl font-bold mb-4">Manajemen Produk</h2>

<a href="{{ route('seller.products.create') }}" 
    class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
    + Tambah Produk
</a>

<table class="w-full bg-white shadow rounded overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-3">Nama</th>
            <th class="p-3">Harga</th>
            <th class="p-3">Stok</th>
            <th class="p-3">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($products as $product)
        <tr class="border-b">
            <td class="p-3">{{ $product->name }}</td>
            <td class="p-3">Rp {{ number_format($product->price) }}</td>
            <td class="p-3">{{ $product->stock }}</td>
            <td class="p-3">
                <a href="{{ route('seller.products.edit', $product) }}" class="text-blue-600">Edit</a>
                
                <form action="{{ route('seller.products.destroy', $product) }}"
                    method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button class="text-red-600 ml-2">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</x-app-layout>