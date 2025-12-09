<x-app-layout>
    <div class="max-w-3xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-6">Edit Withdrawal</h1>

        <div class="bg-white shadow-lg rounded-xl p-6">

            <form action="{{ route('seller.withdrawals.update', $withdrawal->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="font-medium">Status</label>
                    <select name="status" class="w-full border rounded-lg p-2">
                        <option value="pending" {{ $withdrawal->status=='pending'?'selected':'' }}>Pending</option>
                        <option value="processing" {{ $withdrawal->status=='processing'?'selected':'' }}>Diproses</option>
                        <option value="completed" {{ $withdrawal->status=='completed'?'selected':'' }}>Selesai</option>
                        <option value="rejected" {{ $withdrawal->status=='rejected'?'selected':'' }}>Ditolak</option>
                    </select>
                </div>

                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                    Simpan Perubahan
                </button>

            </form>

        </div>

    </div>
</x-app-layout>
