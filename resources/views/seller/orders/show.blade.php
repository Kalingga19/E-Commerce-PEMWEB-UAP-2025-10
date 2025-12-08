<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                            <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Detail Pesanan
                        </h1>
                        <p class="text-gray-600 mt-2 ml-11">Kelola dan update status pesanan pelanggan</p>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-200">
                            <span class="text-sm text-gray-600">Order ID:</span>
                            <span class="ml-2 font-bold text-gray-800">{{ $order->id }}</span>
                        </div>
                        <a href="{{ route('seller.orders.index') }}" class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition duration-200 ease-in-out transform hover:-translate-y-0.5 flex items-center font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>

                <!-- Order Status Progress -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">Order #{{ $order->code }}</h2>
                            <p class="text-gray-600 mt-1">Dibuat: {{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        
                        <!-- Status Badge -->
                        @if($order->payment_status == 'pending')
                        <span class="px-6 py-3 bg-amber-100 text-amber-800 text-lg font-medium rounded-full flex items-center mt-4 md:mt-0">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Menunggu Pembayaran
                        </span>
                        @elseif($order->payment_status == 'processing')
                        <span class="px-6 py-3 bg-blue-100 text-blue-800 text-lg font-medium rounded-full flex items-center mt-4 md:mt-0">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                            </svg>
                            Diproses
                        </span>
                        @elseif($order->payment_status == 'shipped')
                        <span class="px-6 py-3 bg-green-100 text-green-800 text-lg font-medium rounded-full flex items-center mt-4 md:mt-0">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                            </svg>
                            Dikirim
                        </span>
                        @elseif($order->payment_status == 'completed')
                        <span class="px-6 py-3 bg-purple-100 text-purple-800 text-lg font-medium rounded-full flex items-center mt-4 md:mt-0">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Selesai
                        </span>
                        @else
                        <span class="px-6 py-3 bg-red-100 text-red-800 text-lg font-medium rounded-full flex items-center mt-4 md:mt-0">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Dibatalkan
                        </span>
                        @endif
                    </div>

                    <!-- Progress Steps -->
                    <div class="relative">
                        <div class="flex items-center justify-between mb-2">
                            <div class="text-center">
                                <div class="w-12 h-12 {{ $order->payment_status == 'pending' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-400' }} rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium">Order Placed</span>
                            </div>
                            <div class="flex-1 h-1 {{ $order->payment_status != 'pending' ? 'bg-blue-600' : 'bg-gray-200' }} mx-4"></div>
                            <div class="text-center">
                                <div class="w-12 h-12 {{ in_array($order->payment_status, ['processing', 'shipped', 'completed']) ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-400' }} rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium">Confirmed</span>
                            </div>
                            <div class="flex-1 h-1 {{ in_array($order->payment_status, ['shipped', 'completed']) ? 'bg-blue-600' : 'bg-gray-200' }} mx-4"></div>
                            <div class="text-center">
                                <div class="w-12 h-12 {{ in_array($order->payment_status, ['shipped', 'completed']) ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-400' }} rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium">Shipped</span>
                            </div>
                            <div class="flex-1 h-1 {{ $order->payment_status == 'completed' ? 'bg-blue-600' : 'bg-gray-200' }} mx-4"></div>
                            <div class="text-center">
                                <div class="w-12 h-12 {{ $order->payment_status == 'completed' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-400' }} rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium">Delivered</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Order Details -->
                <div class="lg:col-span-2">
                    <!-- Order Items -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
                        <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-100">
                            <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                Produk Dipesan
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                @foreach($order->transactionDetails as $item)
                                <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition duration-200">
                                    <div class="flex-shrink-0 w-16 h-16 bg-gradient-to-r from-gray-100 to-gray-200 rounded-lg flex items-center justify-center mr-4">
                                        @if($item->product->productImages->first())
                                        <img src="{{ asset('storage/' . $item->product->productImages->first()->image) }}" 
                                             class="w-full h-full object-cover rounded-lg"
                                             alt="{{ $item->product->name }}">
                                        @else
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-800">{{ $item->product->name }}</h4>
                                        <div class="flex items-center justify-between mt-2">
                                            <span class="text-sm text-gray-600">Qty: {{ $item->qty }} × Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                            <span class="font-bold text-gray-900">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Order Summary -->
                            <div class="mt-8 border-t pt-6">
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Subtotal Produk</span>
                                        <span class="font-medium text-gray-800">Rp {{ number_format($order->transactionDetails->sum(fn($item) => $item->price * $item->qty), 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Biaya Pengiriman</span>
                                        <span class="font-medium text-gray-800">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center border-t pt-3">
                                        <span class="text-lg font-bold text-gray-800">Total Pembayaran</span>
                                        <span class="text-2xl font-bold text-green-600">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Update Tracking Form -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100">
                            <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Update Tracking & Status
                            </h3>
                        </div>
                        
                        <form method="POST" action="{{ route('seller.orders.update', $order) }}" class="p-6">
                            @csrf
                            @method('PUT')
                            
                            <!-- Tracking Number -->
                            <div class="mb-8">
                                <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                    Nomor Resi / Tracking
                                    <span class="ml-2 px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">Optional</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                        </svg>
                                    </div>
                                    <input type="text" 
                                           name="tracking_number" 
                                           class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                           placeholder="Contoh: 1234567890XYZ"
                                           value="{{ $order->tracking_number }}">
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Masukkan nomor resi dari kurir pengiriman</p>
                            </div>

                            <!-- Status Update -->
                            <div class="mb-8">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Update Status Pesanan</label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <button type="button" 
                                            onclick="updateStatus('processing')"
                                            class="py-3 bg-blue-50 border-2 border-blue-200 text-blue-700 font-medium rounded-xl hover:bg-blue-100 transition duration-200 flex items-center justify-center group">
                                        <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Konfirmasi Pesanan
                                    </button>
                                    
                                    <button type="button" 
                                            onclick="updateStatus('shipped')"
                                            class="py-3 bg-green-50 border-2 border-green-200 text-green-700 font-medium rounded-xl hover:bg-green-100 transition duration-200 flex items-center justify-center group">
                                        <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                        </svg>
                                        Tandai Dikirim
                                    </button>
                                </div>
                            </div>

                            <!-- Additional Notes -->
                            <div class="mb-8">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Catatan untuk Pelanggan</label>
                                <textarea class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 resize-none"
                                          rows="3"
                                          placeholder="Tambahkan catatan tentang pengiriman atau status pesanan..."></textarea>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" 
                                    class="w-full py-4 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold text-lg rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-0.5 flex items-center justify-center group">
                                <svg class="w-6 h-6 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Pesanan
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Right Column - Customer & Shipping Info -->
                <div class="space-y-6">
                    <!-- Customer Information -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-purple-100">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Informasi Pelanggan
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Nama</p>
                                    <p class="font-medium text-gray-800">{{ $order->user->name ?? 'Pelanggan' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Email</p>
                                    <p class="font-medium text-gray-800">{{ $order->user->email ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Telepon</p>
                                    <p class="font-medium text-gray-800">{{ $order->phone ?? 'Tidak tersedia' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Bergabung</p>
                                    <p class="font-medium text-gray-800">{{ $order->user->created_at->format('d M Y') ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-100">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Alamat Pengiriman
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Alamat Lengkap</p>
                                    <p class="font-medium text-gray-800">{{ $order->address }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Kota</p>
                                    <p class="font-medium text-gray-800">{{ $order->city }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Kode Pos</p>
                                    <p class="font-medium text-gray-800">{{ $order->postal_code ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Kurir</p>
                                    <p class="font-medium text-gray-800">{{ strtoupper($order->shipping_type) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                Informasi Pembayaran
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Metode Pembayaran</p>
                                    <p class="font-medium text-gray-800">{{ ucfirst($order->payment_method) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Status Pembayaran</p>
                                    <p class="font-medium text-gray-800">{{ ucfirst($order->payment_status) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Tanggal Pembayaran</p>
                                    <p class="font-medium text-gray-800">{{ $order->updated_at->format('d M Y, H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">ID Transaksi</p>
                                    <p class="font-medium text-gray-800">{{ $order->code }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Actions -->
                    <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-100 rounded-2xl p-6">
                        <h4 class="font-medium text-gray-800 mb-4">Aksi Cepat</h4>
                        <div class="space-y-3">
                            <button class="w-full py-3 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition duration-200 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Kirim Notifikasi
                            </button>
                            <button class="w-full py-3 bg-white border border-red-300 text-red-600 font-medium rounded-lg hover:bg-red-50 transition duration-200 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Batalkan Pesanan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function updateStatus(status) {
        let statusText = '';
        let statusColor = '';
        
        switch(status) {
            case 'processing':
                statusText = 'Diproses';
                statusColor = 'blue';
                break;
            case 'shipped':
                statusText = 'Dikirim';
                statusColor = 'green';
                break;
            case 'completed':
                statusText = 'Selesai';
                statusColor = 'purple';
                break;
        }
        
        if(confirm(`Ubah status pesanan menjadi "${statusText}"?`)) {
            // Add logic to update status via AJAX or form submission
            alert(`Status berhasil diubah menjadi ${statusText}`);
        }
    }
    </script>
</x-app-layout>