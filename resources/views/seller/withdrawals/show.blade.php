<x-app-layout>
    <div class="max-w-3xl mx-auto py-10">

        <a href="{{ route('seller.withdrawals.index') }}" class="text-blue-600 hover:underline mb-3 inline-block">
            ← Kembali
        </a>

        <div class="bg-white shadow-xl rounded-xl p-6">

            <h1 class="text-2xl font-bold mb-4">Detail Penarikan</h1>

            <p><strong>Jumlah:</strong> Rp {{ number_format($withdrawal->amount,0,',','.') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($withdrawal->status) }}</p>
            <p><strong>Dibuat:</strong> {{ $withdrawal->created_at->format('d M Y, H:i') }}</p>

        </div>

    </div>
</x-app-layout>
