<x-app-layout>
    <div class="max-w-xl mx-auto mt-12 p-6 bg-white shadow rounded-xl">
        <h1 class="text-2xl font-bold mb-4">Pembayaran QRIS</h1>

        <p class="text-gray-600 mb-4">
            Silakan scan QR Code di bawah untuk menyelesaikan pembayaran.
        </p>

        <div class="flex justify-center mb-6">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ $qris_code }}" 
                 class="border rounded-lg shadow">
        </div>

        <p class="text-center text-lg font-semibold">
            Total: Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}
        </p>

        <div class="text-center mt-6">
            <a href="{{ route('history.show', $transaction->id) }}"
                class="bg-green-600 px-4 py-2 rounded text-white">
                Saya sudah bayar
            </a>
        </div>
    </div>
</x-app-layout>
