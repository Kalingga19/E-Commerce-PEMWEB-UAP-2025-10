<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                            <svg class="w-8 h-8 text-amber-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
                        <a href="#" class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition duration-200 ease-in-out transform hover:-translate-y-0.5 flex items-center font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Riwayat Verifikasi
                        </a>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-gradient-to-r from-amber-50 to-yellow-50 border border-amber-100 rounded-xl p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Menunggu Review</p>
                                <p class="text-xl font-bold text-gray-800">{{ $stores->count() }}</p>
                            </div>
                            <div class="p-2 bg-amber-100 rounded-lg">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-xl p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Disetujui</p>
                                <p class="text-xl font-bold text-gray-800">0</p>
                            </div>
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-r from-red-50 to-pink-50 border border-red-100 rounded-xl p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Ditolak</p>
                                <p class="text-xl font-bold text-gray-800">0</p>
                            </div>
                            <div class="p-2 bg-red-100 rounded-lg">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100 rounded-xl p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Total Toko</p>
                                <p class="text-xl font-bold text-gray-800">0</p>
                            </div>
                            <div class="p-2 bg-green-100 rounded-lg">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            @if($stores->isEmpty())
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="text-center py-16">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-6 text-xl font-medium text-gray-900">Tidak ada toko yang menunggu verifikasi</h3>
                    <p class="mt-2 text-gray-500">Semua pendaftaran toko telah diverifikasi.</p>
                    <div class="mt-8">
                        <a href="#" class="inline-flex items-center px-6 py-3 border border-transparent rounded-xl text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 shadow-lg hover:shadow-xl transition duration-200 ease-in-out">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Lihat Riwayat Verifikasi
                        </a>
                    </div>
                </div>
            </div>
            @else
            <!-- Store Verification Cards -->
            <div class="space-y-6">
                @foreach($stores as $store)
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200 hover:border-amber-300 transition duration-200 ease-in-out">
                    <!-- Card Header -->
                    <div class="px-6 py-4 bg-gradient-to-r from-amber-50 to-yellow-50 border-b border-amber-100">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="flex items-center">
                                <div class="p-2 bg-white rounded-lg shadow-sm mr-4">
                                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">{{ $store->name }}</h3>
                                    <div class="flex items-center mt-1">
                                        <span class="px-3 py-1 bg-amber-100 text-amber-800 text-xs font-medium rounded-full flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Menunggu Verifikasi
                                        </span>
                                        <span class="ml-3 text-sm text-gray-500">ID: {{ $store->id }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500">
                                Diajukan: {{ $store->created_at ? $store->created_at->format('d M Y') : 'N/A' }}
                            </div>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Store Information -->
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-4 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Informasi Toko
                                </h4>
                                <div class="space-y-3">
                                    <div class="flex items-start">
                                        <span class="text-gray-600 w-32 flex-shrink-0">Nama Toko:</span>
                                        <span class="font-medium text-gray-900">{{ $store->name }}</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="text-gray-600 w-32 flex-shrink-0">Telepon:</span>
                                        <span class="font-medium text-gray-900">{{ $store->phone }}</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="text-gray-600 w-32 flex-shrink-0">Kota:</span>
                                        <span class="font-medium text-gray-900">{{ $store->city }}</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="text-gray-600 w-32 flex-shrink-0">Status:</span>
                                        <span class="px-2 py-1 bg-amber-100 text-amber-800 text-xs font-medium rounded">Pending</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Owner Information -->
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-4 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Informasi Pemilik
                                </h4>
                                <div class="space-y-3">
                                    <div class="flex items-start">
                                        <span class="text-gray-600 w-32 flex-shrink-0">Nama:</span>
                                        <div>
                                            <span class="font-medium text-gray-900">{{ $store->user->name }}</span>
                                            <div class="text-xs text-gray-500">User ID: {{ $store->user->id }}</div>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="text-gray-600 w-32 flex-shrink-0">Email:</span>
                                        <span class="font-medium text-gray-900">{{ $store->user->email }}</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="text-gray-600 w-32 flex-shrink-0">Role:</span>
                                        <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded">
                                            {{ $store->user->role }}
                                        </span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="text-gray-600 w-32 flex-shrink-0">Bergabung:</span>
                                        <span class="text-gray-700">{{ $store->user->created_at ? $store->user->created_at->format('d M Y') : 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="bg-gray-50 rounded-xl p-4 mb-6">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Toko ini didaftarkan pada {{ $store->created_at ? $store->created_at->format('d M Y H:i') : 'N/A' }} dan menunggu verifikasi admin.</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-6 border-t border-gray-200">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Pastikan informasi toko dan pemilik valid sebelum verifikasi
                            </div>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <form method="POST" action="{{ route('admin.verification.reject', $store) }}" class="w-full sm:w-auto" onsubmit="return confirmReject('{{ $store->name }}')">
                                    @csrf
                                    <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition duration-200 ease-in-out transform hover:-translate-y-0.5 flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Tolak Verifikasi
                                    </button>
                                </form>
                                
                                <form method="POST" action="{{ route('admin.verification.approve', $store) }}" class="w-full sm:w-auto" onsubmit="return confirmApprove('{{ $store->name }}')">
                                    @csrf
                                    <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition duration-200 ease-in-out transform hover:-translate-y-0.5 flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Setujui Verifikasi
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <!-- Verification Guidelines -->
            <div class="mt-8">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Panduan Verifikasi Toko
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-gray-700 mb-2">Alasan Menyetujui:</h4>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-start">
                                    <span class="text-green-500 mr-2">✓</span>
                                    Informasi toko dan pemilik valid
                                </li>
                                <li class="flex items-start">
                                    <span class="text-green-500 mr-2">✓</span>
                                    Data kontak dapat diverifikasi
                                </li>
                                <li class="flex items-start">
                                    <span class="text-green-500 mr-2">✓</span>
                                    Tidak melanggar syarat & ketentuan
                                </li>
                                <li class="flex items-start">
                                    <span class="text-green-500 mr-2">✓</span>
                                    Pemilik memiliki rekening bank valid
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-700 mb-2">Alasan Menolak:</h4>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-start">
                                    <span class="text-red-500 mr-2">✗</span>
                                    Informasi tidak lengkap atau palsu
                                </li>
                                <li class="flex items-start">
                                    <span class="text-red-500 mr-2">✗</span>
                                    Kontak tidak dapat dihubungi
                                </li>
                                <li class="flex items-start">
                                    <span class="text-red-500 mr-2">✗</span>
                                    Melanggar syarat & ketentuan
                                </li>
                                <li class="flex items-start">
                                    <span class="text-red-500 mr-2">✗</span>
                                    Duplikat atau spam pendaftaran
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function confirmApprove(storeName) {
        return confirm(`Apakah Anda yakin ingin MENYETUJUI verifikasi toko "${storeName}"?\n\nToko akan aktif dan dapat mulai berjualan.`);
    }
    
    function confirmReject(storeName) {
        return confirm(`Apakah Anda yakin ingin MENOLAK verifikasi toko "${storeName}"?\n\nPemilik toko akan mendapatkan notifikasi penolakan.`);
    }
    </script>
</x-app-layout>