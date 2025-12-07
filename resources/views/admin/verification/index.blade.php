<x-app-layout>
<h2 class="text-2xl font-bold mb-4">Verifikasi Toko</h2>

@if($stores->isEmpty())
    <p>Tidak ada toko yang menunggu verifikasi.</p>
@endif

@foreach($stores as $store)
<div class="bg-white p-4 rounded shadow mb-4">

    <h3 class="text-lg font-semibold">{{ $store->name }}</h3>
    <p>Pemilik: {{ $store->user->name }}</p>
    <p>No. HP: {{ $store->phone }}</p>
    <p>Kota: {{ $store->city }}</p>

    <div class="mt-3 flex gap-3">

        <form method="POST" action="{{ route('admin.verification.approve', $store) }}">
            @csrf
            <button class="bg-green-600 text-white px-4 py-2 rounded">
                Approve
            </button>
        </form>

        <form method="POST" action="{{ route('admin.verification.reject', $store) }}">
            @csrf
            <button class="bg-red-600 text-white px-4 py-2 rounded">
                Reject
            </button>
        </form>

    </div>
</div>
@endforeach
</x-app-layout>