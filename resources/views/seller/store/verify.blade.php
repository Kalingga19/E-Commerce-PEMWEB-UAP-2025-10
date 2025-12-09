<x-app-layout>
    <div class="max-w-2xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-4">Verifikasi Toko</h1>
        <p class="text-gray-600 mb-8">
            Unggah dokumen verifikasi untuk melanjutkan.
        </p>

        <form action="{{ route('store.register.verify.store') }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="bg-white p-6 rounded-xl shadow">

            @csrf

            <label class="block font-medium mb-2">Upload Dokumen (KTP / NPWP)</label>
            <input type="file" name="verification_document" 
                   class="border p-3 w-full rounded">

            @error('verification_document')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror

            <button class="mt-6 w-full bg-blue-600 text-white py-3 rounded-lg">
                Kirim Dokumen Verifikasi
            </button>
        </form>

    </div>
</x-app-layout>
