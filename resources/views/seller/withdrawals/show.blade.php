<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="mb-10">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <a href="{{ route('seller.withdrawals.index') }}" 
                           class="mr-4 p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Detail Penarikan</h1>
                            <p class="text-gray-600 mt-1">Informasi lengkap penarikan dana Anda</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                            ID: WD-{{ str_pad($withdrawal->id, 6, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>
                </div>

                <!-- Withdrawal Header Card -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6 mb-8">
                    <div class="flex items-center">
                        <div class="p-4 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg mr-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900">Penarikan #{{ str_pad($withdrawal->id, 6, '0', STR_PAD_LEFT) }}</h2>
                            <div class="flex flex-wrap items-center gap-4 mt-2">
                                <span class="px-3 py-1 text-sm font-medium rounded-full
                                    @if($withdrawal->status == 'completed') bg-green-100 text-green-800
                                    @elseif($withdrawal->status == 'processing') bg-blue-100 text-blue-800
                                    @elseif($withdrawal->status == 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($withdrawal->status) }}
                                </span>
                                <span class="text-gray-600">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $withdrawal->created_at->format('d F Y, H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Withdrawal Details -->
                <div class="lg:col-span-2">
                    <!-- Withdrawal Information Card -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden mb-8">
                        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-xl font-semibold text-gray-900">Informasi Penarikan</h3>
                        </div>
                        
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Amount -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Penarikan</label>
                                    <div class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-2xl font-bold text-gray-900">
                                            Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Penarikan</label>
                                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                        <div class="flex items-center">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                                    'processing' => 'bg-blue-100 text-blue-800',
                                                    'completed' => 'bg-green-100 text-green-800',
                                                    'rejected' => 'bg-red-100 text-red-800'
                                                ];
                                                $statusIcons = [
                                                    'pending' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                                                    'processing' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15',
                                                    'completed' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                                                    'rejected' => 'M6 18L18 6M6 6l12 12'
                                                ];
                                            @endphp
                                            <div class="p-2 {{ $statusColors[$withdrawal->status] ?? 'bg-gray-100 text-gray-800' }} rounded-lg mr-3">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="{{ $statusIcons[$withdrawal->status] ?? 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' }}"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="text-lg font-semibold capitalize">{{ $withdrawal->status }}</span>
                                                <p class="text-sm text-gray-600 mt-1">
                                                    Terakhir diupdate: {{ $withdrawal->updated_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Created Date -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengajuan</label>
                                    <div class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <div>
                                            <span class="font-medium text-gray-900">{{ $withdrawal->created_at->format('d F Y') }}</span>
                                            <p class="text-sm text-gray-600">{{ $withdrawal->created_at->format('H:i') }} WIB</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Estimated Completion -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Perkiraan Selesai</label>
                                    <div class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div>
                                            @if($withdrawal->status == 'completed')
                                                <span class="font-medium text-green-600">Selesai</span>
                                                <p class="text-sm text-gray-600">{{ $withdrawal->updated_at->format('d F Y') }}</p>
                                            @else
                                                <span class="font-medium text-blue-600">1-3 hari kerja</span>
                                                <p class="text-sm text-gray-600">Setelah status "Diproses"</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bank Transfer Details -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-xl font-semibold text-gray-900">Detail Transfer</h3>
                        </div>
                        
                        <div class="p-6">
                            <div class="space-y-6">
                                <!-- Bank Account -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Rekening Tujuan</label>
                                    <div class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                        <div>
                                            <span class="font-medium text-gray-900">{{ auth()->user()->bank_account ?? 'Belum diatur' }}</span>
                                            <p class="text-sm text-gray-600">{{ auth()->user()->bank_name ?? 'Bank' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Transaction Reference -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Referensi Transaksi</label>
                                    <div class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                        </svg>
                                        <div>
                                            <span class="font-mono font-medium text-gray-900">TRX-{{ strtoupper(substr(md5($withdrawal->id), 0, 12)) }}</span>
                                            <p class="text-sm text-gray-600">Gunakan referensi ini untuk konfirmasi</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Admin Fee -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Biaya Admin</label>
                                    <div class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <div>
                                            <span class="font-medium text-gray-900">Rp 2.500</span>
                                            <p class="text-sm text-gray-600">Biaya administrasi transfer</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Net Amount -->
                                <div class="border-t border-gray-200 pt-6">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-semibold text-gray-900">Jumlah Diterima</span>
                                        <div class="text-right">
                                            <div class="text-3xl font-bold text-green-600">
                                                Rp {{ number_format($withdrawal->amount - 2500, 0, ',', '.') }}
                                            </div>
                                            <div class="text-sm text-gray-500">Setelah dipotong biaya admin</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Timeline & Actions -->
                <div class="space-y-8">
                    <!-- Status Timeline -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900">Linimasa Status</h3>
                        </div>
                        
                        <div class="p-6">
                            <div class="space-y-8">
                                <!-- Timeline Item -->
                                <div class="relative">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">Penarikan Diajukan</p>
                                            <p class="text-xs text-gray-500">{{ $withdrawal->created_at->format('d M, H:i') }}</p>
                                            <p class="text-xs text-gray-400 mt-1">Pengajuan penarikan berhasil</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Timeline Item -->
                                <div class="relative">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">Diverifikasi Admin</p>
                                            <p class="text-xs text-gray-500">
                                                @if($withdrawal->status != 'pending')
                                                    {{ $withdrawal->created_at->addHours(2)->format('d M, H:i') }}
                                                @else
                                                    Menunggu
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Current Status -->
                                <div class="relative">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-full 
                                            @if($withdrawal->status == 'completed') bg-green-100 border-2 border-green-500
                                            @elseif($withdrawal->status == 'processing') bg-blue-100 border-2 border-blue-500
                                            @elseif($withdrawal->status == 'rejected') bg-red-100 border-2 border-red-500
                                            @else bg-yellow-100 border-2 border-yellow-500 @endif
                                            flex items-center justify-center">
                                            <svg class="w-5 h-5 
                                                @if($withdrawal->status == 'completed') text-green-600
                                                @elseif($withdrawal->status == 'processing') text-blue-600
                                                @elseif($withdrawal->status == 'rejected') text-red-600
                                                @else text-yellow-600 @endif" 
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                @if($withdrawal->status == 'completed')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                @elseif($withdrawal->status == 'processing')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                @elseif($withdrawal->status == 'rejected')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                @endif
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">Status Saat Ini</p>
                                            <p class="text-xs text-gray-500">{{ $withdrawal->updated_at->format('d M, H:i') }}</p>
                                            <p class="text-sm font-medium capitalize mt-1
                                                @if($withdrawal->status == 'completed') text-green-600
                                                @elseif($withdrawal->status == 'processing') text-blue-600
                                                @elseif($withdrawal->status == 'rejected') text-red-600
                                                @else text-yellow-600 @endif">
                                                {{ $withdrawal->status }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900">Aksi Cepat</h3>
                        </div>
                        
                        <div class="p-6">
                            <div class="space-y-4">
                                @if($withdrawal->status == 'pending')
                                <form action="{{ route('seller.withdrawals.update', $withdrawal->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" 
                                            onclick="return confirm('Apakah Anda yakin ingin membatalkan penarikan ini?')"
                                            class="w-full flex items-center p-3 border border-red-200 rounded-lg 
                                                   hover:bg-red-50 transition-colors duration-200 group">
                                        <div class="p-2 bg-red-100 rounded-lg mr-3 group-hover:bg-red-200">
                                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </div>
                                        <span class="font-medium text-red-600">Batalkan Penarikan</span>
                                    </button>
                                </form>
                                @endif
                                
                                <a href="{{ route('seller.withdrawals.index') }}" 
                                   class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 
                                          transition-colors duration-200 group">
                                    <div class="p-2 bg-gray-100 rounded-lg mr-3 group-hover:bg-gray-200">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-900">Kembali ke Daftar</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Support Info -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 p-2 bg-blue-100 rounded-lg mr-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Butuh Bantuan?</h4>
                                <p class="text-sm text-gray-700 mb-3">
                                    Jika ada pertanyaan mengenai penarikan ini, hubungi tim support kami.
                                </p>
                                <a href="mailto:support@example.com"
                                   class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Kontak Support
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Status Info -->
                    <div class="bg-white rounded-xl border border-gray-200 p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-2 
                                @if($withdrawal->status == 'completed') bg-green-100
                                @elseif($withdrawal->status == 'processing') bg-blue-100
                                @elseif($withdrawal->status == 'rejected') bg-red-100
                                @else bg-yellow-100 @endif
                                rounded-lg mr-3">
                                <svg class="w-5 h-5 
                                    @if($withdrawal->status == 'completed') text-green-600
                                    @elseif($withdrawal->status == 'processing') text-blue-600
                                    @elseif($withdrawal->status == 'rejected') text-red-600
                                    @else text-yellow-600 @endif" 
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-1">Informasi Status</h4>
                                <p class="text-xs text-gray-600">
                                    @if($withdrawal->status == 'completed')
                                        Dana telah berhasil ditransfer ke rekening Anda.
                                    @elseif($withdrawal->status == 'processing')
                                        Penarikan sedang diproses oleh tim finance.
                                    @elseif($withdrawal->status == 'pending')
                                        Penarikan menunggu verifikasi admin.
                                    @else
                                        Penarikan tidak dapat diproses.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>