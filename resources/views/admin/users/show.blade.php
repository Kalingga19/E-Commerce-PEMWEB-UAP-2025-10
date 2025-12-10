<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section -->
            <div class="mb-10">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <a href="{{ route('admin.users.index') }}" 
                           class="mr-4 p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Detail Pengguna</h1>
                            <p class="text-gray-600 mt-1">Informasi lengkap dan aktivitas pengguna</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.users.edit', $user) }}" 
                           class="inline-flex items-center px-4 py-2.5 border border-blue-300 
                                  text-blue-700 font-medium rounded-lg hover:bg-blue-50 
                                  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                                  transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Pengguna
                        </a>
                    </div>
                </div>

                <!-- User Header Card -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6 mb-8">
                    <div class="flex items-center">
                        <div class="relative">
                            <div class="p-4 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg mr-6">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            @if($user->email_verified_at)
                            <div class="absolute -bottom-1 -right-1 p-1.5 bg-green-500 text-white rounded-full">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            @endif
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h2>
                            <div class="flex flex-wrap items-center gap-4 mt-2">
                                <span class="text-gray-600">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $user->email }}
                                </span>
                                <span class="px-3 py-1.5 text-sm font-medium rounded-full
                                    @if($user->role == 'admin') bg-purple-100 text-purple-800
                                    @elseif($user->role == 'seller') bg-green-100 text-green-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ ucfirst($user->role) }}
                                </span>
                                <span class="px-3 py-1.5 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">
                                    ID: USER-{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - User Details -->
                <div class="lg:col-span-2">
                    <!-- Basic Information Card -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden mb-8">
                        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-xl font-semibold text-gray-900">Informasi Dasar</h3>
                        </div>
                        
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                    <div class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="font-medium text-gray-900">{{ $user->name }}</span>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                                    <div class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="font-medium text-gray-900">{{ $user->email }}</span>
                                    </div>
                                </div>

                                <!-- Role -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Peran Pengguna</label>
                                    <div class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <span class="font-medium text-gray-900 capitalize">{{ $user->role }}</span>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Akun</label>
                                    <div class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                        @if($user->email_verified_at)
                                            <div class="flex items-center px-3 py-1.5 bg-green-100 text-green-800 rounded-full">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Terverifikasi
                                            </div>
                                        @else
                                            <div class="flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-800 rounded-full">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Belum Diverifikasi
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline & Activity Card -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-xl font-semibold text-gray-900">Linimasa Aktivitas</h3>
                        </div>
                        
                        <div class="p-6">
                            <div class="space-y-6">
                                <!-- Account Creation -->
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 p-3 bg-blue-100 rounded-xl mr-4">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900">Akun Dibuat</h4>
                                        <p class="text-sm text-gray-600 mt-1">Pengguna mendaftar ke sistem</p>
                                        <div class="flex items-center text-sm text-gray-500 mt-2">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ $user->created_at->format('d F Y, H:i') }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Last Update -->
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 p-3 bg-green-100 rounded-xl mr-4">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900">Update Terakhir</h4>
                                        <p class="text-sm text-gray-600 mt-1">Profil terakhir diperbarui</p>
                                        <div class="flex items-center text-sm text-gray-500 mt-2">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $user->updated_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>

                                @if($user->email_verified_at)
                                <!-- Email Verification -->
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 p-3 bg-purple-100 rounded-xl mr-4">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900">Email Diverifikasi</h4>
                                        <p class="text-sm text-gray-600 mt-1">Email berhasil diverifikasi</p>
                                        <div class="flex items-center text-sm text-gray-500 mt-2">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ $user->email_verified_at->format('d F Y, H:i') }}
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Stats & Actions -->
                <div class="space-y-8">
                    <!-- User Statistics -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900">Statistik Pengguna</h3>
                        </div>
                        
                        <div class="p-6">
                            <div class="space-y-6">
                                <!-- Orders Count -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Total Pesanan</p>
                                            <p class="text-2xl font-bold text-gray-900">24</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Last Login -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-green-100 rounded-lg mr-3">
                                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Login Terakhir</p>
                                            <p class="text-2xl font-bold text-gray-900">2 hari</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Activity Score -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-purple-100 rounded-lg mr-3">
                                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Skor Aktivitas</p>
                                            <p class="text-2xl font-bold text-gray-900">85%</p>
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
                                <a href="{{ route('admin.users.edit', $user) }}" 
                                   class="flex items-center p-3 border border-blue-200 rounded-lg hover:bg-blue-50 
                                          transition-colors duration-200 group">
                                    <div class="p-2 bg-blue-100 rounded-lg mr-3 group-hover:bg-blue-200">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-900">Edit Pengguna</span>
                                </a>
                                
                                <a href="{{ route('admin.users.index') }}" 
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

                    <!-- Account Status -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 p-3 bg-blue-100 rounded-lg mr-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Status Akun</h4>
                                <p class="text-sm text-gray-700">
                                    Akun pengguna ini 
                                    <span class="font-medium @if($user->email_verified_at) text-green-600 @else text-yellow-600 @endif">
                                        {{ $user->email_verified_at ? 'aktif' : 'menunggu verifikasi' }}
                                    </span>.
                                    @if($user->email_verified_at)
                                        Semua fitur sistem dapat diakses.
                                    @else
                                        Beberapa fitur mungkin terbatas hingga verifikasi email selesai.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Role-Based Information -->
            @if($user->role == 'seller')
            <div class="mt-8 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 bg-green-100 rounded-xl mr-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Informasi Seller</h3>
                        <p class="text-gray-700">
                            Pengguna ini memiliki toko aktif di platform. Mereka dapat mengelola produk, pesanan, 
                            dan melakukan penarikan dana sesuai dengan kebijakan platform.
                        </p>
                        <a href="{{ route('admin.stores.show', $user->store->id ?? '#') }}" 
                           class="inline-flex items-center text-green-600 hover:text-green-800 font-medium mt-3">
                            Lihat Toko
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            @if($user->role == 'admin')
            <div class="mt-8 bg-gradient-to-r from-purple-50 to-indigo-50 border border-purple-200 rounded-2xl p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 bg-purple-100 rounded-xl mr-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Akses Admin</h3>
                        <p class="text-gray-700">
                            Pengguna ini memiliki akses penuh ke sistem administrasi. Mereka dapat mengelola pengguna, 
                            produk, kategori, dan semua aspek platform.
                        </p>
                        <div class="mt-3 text-sm text-gray-600">
                            <span class="font-medium">Hak Akses:</span> Penuh (Super Admin)
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>