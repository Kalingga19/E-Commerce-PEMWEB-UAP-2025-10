<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-6">Edit Pesanan</h1>

        <div class="bg-white shadow-lg rounded-xl p-6">

            <form action="{{ route('seller.orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="font-medium">Status Pesanan</label>
                    <select name="status" class="w-full border rounded-lg p-2">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Diproses</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">Simpan</button>
            </form>

        </div>

    </div>
</x-app-layout>
