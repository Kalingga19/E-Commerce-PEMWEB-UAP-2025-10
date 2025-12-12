<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-10">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                    <div>
                        <div class="flex items-center mb-4">
                            <div class="p-3 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg mr-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">Riwayat Penarikan Dana</h1>
                                <p class="text-gray-600 mt-1">Lacak semua transaksi penarikan Anda</p>
                            </div>
                        </div>
                        
                        <!-- Stats Summary -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-xl p-4">
                                <div class="flex items-center">
                                    <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Total Penarikan</p>
                                        <p class="text-xl font-bold text-gray-900">
                                            Rp {{ number_format($withdrawals->sum('amount')) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100 rounded-xl p-4">
                                <div class="flex items-center">
                                    <div class="p-2 bg-green-100 rounded-lg mr-3">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Berhasil</p>
                                        <p class="text-xl font-bold text-gray-900">
                                            {{ $withdrawals->where('status', 'completed')->count() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-100 rounded-xl p-4">
                                <div class="flex items-center">
                                    <div class="p-2 bg-amber-100 rounded-lg mr-3">
                                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Dalam Proses</p>
                                        <p class="text-xl font-bold text-gray-900">
                                            {{ $withdrawals->where('status', 'pending')->count() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex-shrink-0">
                        <a href="{{ route('seller.withdrawals.create') }}" 
                           class="inline-flex items-center px-6 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 
                                  text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-indigo-700 
                                  focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 
                                  transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 4v16m8-8H4"></path>
                            </svg>
                            Ajukan Penarikan Baru
                        </a>
                    </div>
                </div>
            </div>

            <!-- Withdrawals List -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Penarikan</h3>
                </div>

                @if($withdrawals->count() > 0)
                    <div class="divide-y divide-gray-200">
                        @foreach($withdrawals as $w)
                        <div class="p-6 hover:bg-gray-50 transition duration-200">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                <!-- Left Column -->
                                <div class="flex-1">
                                    <div class="flex items-start">
                                        <div class="p-3 rounded-lg mr-4
                                            @if($w->status == 'completed') bg-green-100 text-green-600
                                            @elseif($w->status == 'pending') bg-amber-100 text-amber-600
                                            @else bg-red-100 text-red-600 @endif">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                @if($w->status == 'completed')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                @elseif($w->status == 'pending')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                @endif
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="flex items-center mb-2">
                                                <h4 class="text-lg font-semibold text-gray-900">
                                                    Penarikan #{{ str_pad($w->id, 6, '0', STR_PAD_LEFT) }}
                                                </h4>
                                                <span class="ml-3 px-3 py-1 text-xs font-medium rounded-full
                                                    @if($w->status == 'completed') bg-green-100 text-green-800
                                                    @elseif($w->status == 'pending') bg-amber-100 text-amber-800
                                                    @else bg-red-100 text-red-800 @endif">
                                                    {{ ucfirst($w->status) }}
                                                </span>
                                            </div>
                                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    {{ $w->created_at->format('d M Y, H:i') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Right Column -->
                                <div class="lg:text-right">
                                    <div class="mb-2">
                                        <p class="text-2xl font-bold text-gray-900">
                                            Rp {{ number_format($w->amount) }}
                                        </p>
                                    </div>
                                    @if($w->completed_at && $w->status == 'completed')
                                    <div class="text-sm text-gray-600">
                                        <span class="flex items-center justify-end lg:justify-start">
                                            <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Selesai: {{ $w->completed_at->format('d M Y') }}
                                        </span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Additional Details -->
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-600 mb-1">Status</p>
                                        <p class="text-sm text-gray-900">{{ $w->status }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600 mb-1">Jumlah</p>
                                        <p class="text-sm text-gray-900">Rp {{ number_format($w->amount) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="p-4 bg-gray-100 rounded-full inline-flex mb-6">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Riwayat Penarikan</h3>
                        <p class="text-gray-600 max-w-md mx-auto mb-8">
                            Anda belum melakukan penarikan dana. Mulailah dengan mengajukan penarikan pertama Anda.
                        </p>
                        <a href="{{ route('seller.withdrawals.create') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 
                                  text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-indigo-700 
                                  focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 
                                  transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 4v16m8-8H4"></path>
                            </svg>
                            Ajukan Penarikan Pertama
                        </a>
                    </div>
                @endif

                <!-- Pagination -->
                @if($withdrawals->count() > 0)
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Menampilkan {{ $withdrawals->firstItem() }} - {{ $withdrawals->lastItem() }} dari {{ $withdrawals->total() }} penarikan
                        </div>
                        <div class="flex space-x-2">
                            {{ $withdrawals->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Information Card -->
            <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0 p-3 bg-blue-100 rounded-xl mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">Informasi Penting</h4>
                        <ul class="space-y-2 text-sm text-gray-700">
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Penarikan biasanya diproses dalam 1-3 hari kerja</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Minimum penarikan adalah Rp 50.000</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Pastikan informasi rekening Anda sudah benar dan terverifikasi</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>