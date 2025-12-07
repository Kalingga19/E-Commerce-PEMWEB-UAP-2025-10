<x-app-layout>
<div class="py-6">

    <h2 class="text-2xl font-bold mb-6">Dashboard Admin</h2>

    <div class="grid grid-cols-4 gap-6">

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">Total Pengguna</h3>
            <p class="text-3xl font-bold">{{ $users }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">Total Toko</h3>
            <p class="text-3xl font-bold">{{ $stores }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">Total Produk</h3>
            <p class="text-3xl font-bold">{{ $products }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">Total Transaksi</h3>
            <p class="text-3xl font-bold">{{ $transactions }}</p>
        </div>

    </div>

</div>
</x-app-layout>

