<x-app-layout>
<div class="max-w-3xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">Edit Produk</h1>

    <form method="POST" action="{{ route('admin.products.update', $product) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="font-medium">Nama Produk</label>
            <input type="text" name="name" value="{{ $product->name }}"
                class="w-full px-4 py-2 border rounded-lg" required>
        </div>

        <div class="mb-4">
            <label class="font-medium">Harga</label>
            <input type="number" name="price" value="{{ $product->price }}"
                class="w-full px-4 py-2 border rounded-lg" required>
        </div>

        <div class="mb-4">
            <label class="font-medium">Stok</label>
            <input type="number" name="stock" value="{{ $product->stock }}"
                class="w-full px-4 py-2 border rounded-lg" required>
        </div>

        <div class="mb-4">
            <label class="font-medium">Kategori</label>
            <select name="category_id" class="w-full px-4 py-2 border rounded-lg" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected($product->category_id == $cat->id)>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.products.index') }}"
                class="px-4 py-2 bg-gray-300 rounded-lg">Batal</a>
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg">Simpan</button>
        </div>

    </form>

</div>
</x-app-layout>
