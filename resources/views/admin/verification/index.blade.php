<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <!-- HEADER -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                            <svg class="w-8 h-8 text-amber-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Verifikasi Toko
                        </h1>
                        <p class="text-gray-600 mt-2 ml-11">Review dan verifikasi pendaftaran toko baru</p>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-200 flex items-center">
                            <div class="w-3 h-3 bg-amber-500 rounded-full mr-2 animate-pulse"></div>
                            <span class="text-sm text-gray-600">Pending:</span>
                            <span class="ml-2 font-bold text-gray-800">{{ $stores->count() }} toko</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KOSONG -->
            @if($stores->isEmpty())
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="text-center py-16">
                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-6 text-xl font-medium text-gray-900">Tidak ada toko yang menunggu verifikasi</h3>
                        <p class="mt-2 text-gray-500">Semua pendaftaran toko telah diverifikasi.</p>
                    </div>
                </div>
            @else

            <!-- LIST TOKO -->
            <div class="space-y-6">
                @foreach($stores as $store)
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border hover:border-amber-300 transition">

                        <!-- HEADER CARD -->
                        <div class="px-6 py-4 bg-gradient-to-r from-amber-50 to-yellow-50 border-b">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">{{ $store->name }}</h3>
                                    <div class="text-xs text-gray-500 mt-1">ID: {{ $store->id }}</div>
                                </div>
                                <div class="text-sm text-gray-500">
                                    Diajukan: {{ $store->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>

                        <!-- CONTENT -->
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Info Toko -->
                                <div>
                                    <h4 class="font-semibold mb-3">Informasi Toko</h4>
                                    <p><b>Nama:</b> {{ $store->name }}</p>
                                    <p><b>Telepon:</b> {{ $store->phone }}</p>
                                    <p><b>Kota:</b> {{ $store->city }}</p>
                                </div>

                                <!-- Info Pemilik -->
                                <div>
                                    <h4 class="font-semibold mb-3">Informasi Pemilik</h4>
                                    <p><b>Nama:</b> {{ $store->user->name }}</p>
                                    <p><b>Email:</b> {{ $store->user->email }}</p>
                                    <p><b>Role:</b> {{ $store->user->role }}</p>
                                </div>
                            </div>

                            <!-- ACTION BUTTONS -->
                            <div class="flex flex-col sm:flex-row justify-between items-center mt-6 pt-4 border-t gap-3">

                                <!-- BUTTON TOLAK — OPEN MODAL -->
                                <button
                                    onclick="openRejectModal('{{ route('admin.verification.reject', $store) }}', '{{ $store->name }}')"
                                    class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-red-500 to-pink-600 text-white font-medium rounded-xl shadow hover:shadow-xl hover:-translate-y-0.5 transition flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Tolak Verifikasi
                                </button>

                                <!-- BUTTON TERIMA -->
                                <form method="POST" action="{{ route('admin.verification.approve', $store) }}"
                                      onsubmit="return confirm('Setujui verifikasi toko {{ $store->name }}?')">
                                    @csrf
                                    <button type="submit"
                                        class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-medium rounded-xl shadow hover:shadow-xl hover:-translate-y-0.5 transition flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Setujui Verifikasi
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @endif
        </div>
    </div>

    <!-- MODAL PENOLAKAN -->
    <div id="rejectModal"
        class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

        <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-xl">
            <h2 class="text-xl font-bold mb-3">Tolak Verifikasi Toko</h2>
            <p class="text-sm text-gray-600 mb-4" id="rejectStoreName"></p>

            <form method="POST" id="rejectForm">
                @csrf

                <label class="block text-sm mb-2">Alasan Penolakan:</label>
                <textarea name="reason" required rows="4"
                    class="w-full border rounded-lg p-3 focus:ring focus:ring-red-200"></textarea>

                <div class="flex justify-end mt-4 gap-3">
                    <button type="button"
                        onclick="closeRejectModal()"
                        class="px-4 py-2 bg-gray-200 rounded">
                        Batal
                    </button>

                    <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Kirim Penolakan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        function openRejectModal(actionUrl, storeName) {
            document.getElementById('rejectForm').action = actionUrl;
            document.getElementById('rejectStoreName').innerText =
                "Toko: " + storeName;
            document.getElementById('rejectModal').style.display = 'flex';
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').style.display = 'none';
        }
    </script>

</x-app-layout>
