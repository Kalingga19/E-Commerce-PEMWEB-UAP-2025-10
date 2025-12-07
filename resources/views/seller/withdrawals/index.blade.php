<x-app-layout>
<h2 class="text-xl font-bold mb-4">Riwayat Penarikan Dana</h2>

<a href="{{ route('seller.withdrawals.create') }}" 
    class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
    + Ajukan Withdraw
</a>

@foreach($withdrawals as $w)
<div class="bg-white p-4 rounded shadow mb-3">
    <p>Jumlah: Rp {{ number_format($w->amount) }}</p>
    <p>Status: {{ $w->status }}</p>
</div>
@endforeach
</x-app-layout>