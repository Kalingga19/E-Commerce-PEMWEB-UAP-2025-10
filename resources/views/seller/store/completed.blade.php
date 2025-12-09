<x-app-layout>
    <div class="max-w-xl mx-auto py-20 text-center">

        <div class="text-green-600 text-6xl mb-6">
            ✅
        </div>

        <h1 class="text-3xl font-bold mb-4">Pendaftaran Toko Berhasil!</h1>

        <p class="text-gray-600 mb-6">
            Dokumen Anda sedang ditinjau oleh admin. 
            Anda akan menerima notifikasi setelah toko diverifikasi.
        </p>

        <a href="{{ route('seller.dashboard') }}"
            class="px-6 py-3 bg-blue-600 text-white rounded-lg">
            Kembali ke Dashboard
        </a>

    </div>
</x-app-layout>
