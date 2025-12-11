<x-app-layout>
    <div class="container mx-auto px-4 py-6 max-w-6xl">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Transaksi</h1>
                <div class="flex items-center mt-2">
                    <span class="text-sm text-gray-500">ID Transaksi:</span>
                    <span class="ml-2 px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">#{{ $transaction->id }}</span>
                </div>
            </div>
            
            <!-- Status Badge -->
            <div class="mt-4 md:mt-0">
                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'approved' => 'bg-blue-100 text-blue-800',
                        'processing' => 'bg-purple-100 text-purple-800',
                        'completed' => 'bg-green-100 text-green-800',
                        'cancelled' => 'bg-red-100 text-red-800',
                        'rejected' => 'bg-red-100 text-red-800'
                    ];
                    $color = $statusColors[$transaction->status] ?? 'bg-gray-100 text-gray-800';
                @endphp
                <span class="px-4 py-2 rounded-full font-medium {{ $color }}">
                    {{ ucfirst($transaction->status) }}
                </span>
            </div>
        </div>

        @foreach ($transaction->transactionDetails as $detail)
        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
            <div class="p-6">
                <!-- Informasi Pembeli & Penjual dalam Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <!-- Informasi Pembeli -->
                    <div class="bg-gray-50 p-5 rounded-lg border border-gray-100">
                        <div class="flex items-center mb-4">
                            <div class="p-2 bg-blue-50 rounded-lg mr-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Informasi Pembeli</h3>
                        </div>
                        
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500">Nama</p>
                                <p class="font-medium text-gray-800">{{ $transaction->buyer->buyer_id }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-medium text-gray-800">{{ $transaction->buyer->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Penjual -->
                    <div class="bg-gray-50 p-5 rounded-lg border border-gray-100">
                        <div class="flex items-center mb-4">
                            <div class="p-2 bg-green-50 rounded-lg mr-3">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Informasi Penjual</h3>
                        </div>
                        
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500">Nama Toko</p>
                                <p class="font-medium text-gray-800">{{ $detail->store->store_name ?? '-' }}
</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Pemilik Toko</p>
                                <p class="font-medium text-gray-800">{{ $detail->seller->owner->name ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Produk -->
                <div class="bg-gray-50 p-5 rounded-lg border border-gray-100 mb-8">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-purple-50 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Informasi Produk</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-500">Nama Produk</p>
                            <p class="font-medium text-gray-800 text-lg">{{ $detail->product->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Harga Produk</p>
                            <p class="font-medium text-gray-800 text-lg text-green-600">Rp {{ number_format($detail->product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- Alasan Penolakan (jika ada) -->
                @if($transaction->reject_reason)
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-8">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-red-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.346 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <div>
                            <p class="font-medium text-red-800">Alasan Penolakan</p>
                            <p class="text-red-700 mt-1">{{ $transaction->reject_reason }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="pt-6 border-t border-gray-200">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Aksi Transaksi</h4>
                    
                    <div class="flex flex-wrap gap-3">
                        @if($transaction->status === 'pending')
                            <!-- Approve Button -->
                            <form action="{{ route('admin.transactions.approve', $transaction->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Approve Transaksi
                                </button>
                            </form>

                            <!-- Reject Button (Triggers Modal) -->
                            <button type="button" data-bs-toggle="modal" data-bs-target="#rejectModal" class="inline-flex items-center px-4 py-2.5 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Tolak Transaksi
                            </button>
                        @endif

                        @if($transaction->status === 'approved' || $transaction->status === 'processing')
                            <!-- Status Update Form -->
                            <form action="{{ route('admin.transactions.updateStatus', $transaction->id) }}" method="POST" class="flex flex-col sm:flex-row items-start sm:items-center gap-3 bg-gray-50 p-4 rounded-lg border border-gray-200 w-full">
                                @csrf
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Ubah Status Transaksi</label>
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                                        <select name="status" class="w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-colors duration-200">
                                            <option value="processing" {{ $transaction->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="completed">Completed</option>
                                            <option value="cancelled">Cancelled</option>
                                        </select>
                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 whitespace-nowrap">
                                            Update Status
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- REJECT MODAL --}}
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('admin.transactions.reject', $transaction->id) }}" method="POST">
                @csrf
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-red-50 border-b border-red-100 px-6 py-4 rounded-t-lg">
                        <h5 class="modal-title text-lg font-semibold text-red-800">Tolak Transaksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-6">
                        <div class="mb-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.346 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                <p class="text-gray-700">Anda akan menolak transaksi #{{ $transaction->id }}</p>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">Silakan berikan alasan penolakan transaksi ini.</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan</label>
                            <textarea name="reason" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:outline-none transition-colors duration-200" required placeholder="Masukkan alasan penolakan transaksi..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-gray-50 border-t border-gray-200 px-6 py-4 rounded-b-lg">
                        <button type="button" class="px-4 py-2.5 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2.5 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200">
                            Tolak Transaksi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>