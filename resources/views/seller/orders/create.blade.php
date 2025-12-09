<x-app-layout>
    <div class="max-w-3xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-6">Buat Pesanan Manual</h1>

        <div class="bg-white shadow-lg rounded-xl p-6">
            <p class="text-gray-600 mb-4">
                Biasanya seller tidak membuat pesanan manual.  
                Form ini hanya disediakan agar route resource tidak error.
            </p>

            <form action="{{ route('seller.orders.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="font-medium">Nama Pembeli</label>
                    <input type="text" name="buyer" class="w-full border rounded-lg p-2">
                </div>

                <div class="mb-4">
                    <label class="font-medium">Catatan</label>
                    <textarea name="note" class="w-full border rounded-lg p-2"></textarea>
                </div>

                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                    Simpan
                </button>
            </form>
        </div>

    </div>
</x-app-layout>
