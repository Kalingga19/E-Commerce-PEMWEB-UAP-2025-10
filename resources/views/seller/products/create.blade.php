<x-app-layout>
<h2 class="text-xl font-bold mb-4">Tambah Produk Baru</h2>

<form action="{{ route('seller.products.store') }}" method="POST">
@csrf

<div class="grid grid-cols-2 gap-6">

    <div>
        <label>Nama Produk</label>
        <input type="text" name="name" class="border p-2 w-full mb-3" required>

        <label>Kategori</label>
        <select name="product_category_id" class="border p-2 w-full mb-3">
            @foreach($categories as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
        </select>

        <label>Harga</label>
        <input type="number" name="price" class="border p-2 w-full mb-3" required>

        <label>Berat (gram)</label>
        <input type="number" name="weight" class="border p-2 w-full mb-3" required>

        <label>Stok</label>
        <input type="number" name="stock" class="border p-2 w-full mb-3" required>
    </div>

    <div>
        <label>Deskripsi</label>
        <textarea name="description" class="border p-2 w-full h-40 mb-3"></textarea>

        <label>Kondisi Produk</label>
        <select name="condition" class="border p-2 w-full">
            <option value="new">Baru</option>
            <option value="second">Bekas</option>
        </select>
    </div>

</div>

<button class="mt-4 bg-green-600 text-white px-4 py-2 rounded">
    Simpan Produk
</button>

</form>
</x-app-layout>