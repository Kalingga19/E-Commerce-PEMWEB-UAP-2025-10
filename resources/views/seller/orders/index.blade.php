<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                            <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Daftar Pesanan Masuk
                        </h1>
                        <p class="text-gray-600 mt-2 ml-11">Kelola semua pesanan pelanggan Anda</p>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-200">
                            <span class="text-sm text-gray-600">Total Pesanan:</span>
                            <span class="ml-2 font-bold text-gray-800">{{ $orders->count() }}</span>
                        </div>
                        <button class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition duration-200 ease-in-out transform hover:-translate-y-0.5 flex items-center font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Export Excel
                        </button>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-xl p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Menunggu Diproses</p>
                                <p class="text-xl font-bold text-gray-800">{{ $orders->where('payment_status', 'pending')->count() }}</p>
                            </div>
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100 rounded-xl p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Diproses</p>
                                <p class="text-xl font-bold text-gray-800">{{ $orders->where('payment_status', 'processing')->count() }}</p>
                            </div>
                            <div class="p-2 bg-green-100 rounded-lg">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-100 rounded-xl p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Dikirim</p>
                                <p class="text-xl font-bold text-gray-800">{{ $orders->where('payment_status', 'shipped')->count() }}</p>
                            </div>
                            <div class="p-2 bg-amber-100 rounded-lg">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-100 rounded-xl p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Selesai</p>
                                <p class="text-xl font-bold text-gray-800">{{ $orders->where('payment_status', 'completed')->count() }}</p>
                            </div>
                            <div class="p-2 bg-purple-100 rounded-lg">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            <span class="text-gray-700 font-medium">Filter Pesanan</span>
                        </div>
                        
                        <div class="flex flex-wrap items-center gap-3">
                            <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <option value="">Semua Status</option>
                                <option value="pending">Menunggu</option>
                                <option value="processing">Diproses</option>
                                <option value="shipped">Dikirim</option>
                                <option value="completed">Selesai</option>
                                <option value="cancelled">Dibatalkan</option>
                            </select>
                            
                            <input type="date" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            
                            <input type="text" 
                                   placeholder="Cari nomor pesanan..." 
                                   class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm w-full sm:w-48">
                            
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 text-sm font-medium">
                                Terapkan Filter
                            </button>
                            <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200 text-sm">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            @if($orders->isEmpty())
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="text-center py-16">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="mt-6 text-xl font-medium text-gray-900">Belum ada pesanan</h3>
                    <p class="mt-2 text-gray-500">Pesanan dari pelanggan akan muncul di sini.</p>
                </div>
            </div>
            @else
            <!-- Orders List -->
            <div class="space-y-6">
                @foreach($orders as $order)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <!-- Order Header -->
                    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="flex items-center">
                                <div class="p-2 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-lg mr-4">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">Order #{{ $order->code }}</h3>
                                    <div class="flex items-center mt-1">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <!-- Status Badge -->
                                @if($order->payment_status == 'pending')
                                <span class="px-4 py-2 bg-amber-100 text-amber-800 text-sm font-medium rounded-full flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Menunggu Pembayaran
                                </span>
                                @elseif($order->payment_status == 'processing')
                                <span class="px-4 py-2 bg-blue-100 text-blue-800 text-sm font-medium rounded-full flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                    </svg>
                                    Diproses
                                </span>
                                @elseif($order->payment_status == 'shipped')
                                <span class="px-4 py-2 bg-green-100 text-green-800 text-sm font-medium rounded-full flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                    </svg>
                                    Dikirim
                                </span>
                                @elseif($order->payment_status == 'completed')
                                <span class="px-4 py-2 bg-purple-100 text-purple-800 text-sm font-medium rounded-full flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Selesai
                                </span>
                                @else
                                <span class="px-4 py-2 bg-red-100 text-red-800 text-sm font-medium rounded-full flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Dibatalkan
                                </span>
                                @endif
                                
                                <!-- Total Amount -->
                                <div class="text-right">
                                    <p class="text-sm text-gray-600">Total</p>
                                    <p class="text-xl font-bold text-gray-900">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Content -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <!-- Customer Info -->
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-3">Informasi Pelanggan</h4>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-600">Nama: <span class="font-medium text-gray-800">{{ $order->buyer->name ?? 'Pelanggan' }}</span></span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-600">Email: <span class="font-medium text-gray-800">{{ $order->buyer->email ?? '-' }}</span></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Info -->
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-3">Pengiriman</h4>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-600">{{ $order->city }}, {{ $order->address }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                        </svg>
                                        <span class="text-sm text-gray-600">Kurir: <span class="font-medium text-gray-800">{{ strtoupper($order->shipping_type) }}</span></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Info -->
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-3">Pembayaran</h4>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-600">Metode: <span class="font-medium text-gray-800">{{ ucfirst($order->payment_method) }}</span></span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-600">Status: <span class="font-medium text-gray-800">{{ ucfirst($order->payment_status) }}</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Products Summary -->
                        <div class="mb-6">
                            <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-3">Produk Dipesan</h4>
                            <div class="space-y-3">
                                @foreach($order->transactionDetails as $detail)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-gradient-to-r from-gray-100 to-gray-200 rounded-lg flex items-center justify-center mr-3">
                                            @if($detail->product->productImages->first())
                                            <img src="{{ asset('storage/' . $detail->product->productImages->first()->image) }}" 
                                                 class="w-full h-full object-cover rounded-lg"
                                                 alt="{{ $detail->product->name }}">
                                            @else
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <h5 class="font-medium text-gray-800">{{ $detail->product->name }}</h5>
                                            <p class="text-sm text-gray-500">Qty: {{ $detail->qty }} × Rp {{ number_format($detail->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <span class="font-bold text-gray-900">Rp {{ number_format($detail->price * $detail->qty, 0, ',', '.') }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-6 border-t border-gray-200">
                            <div class="text-sm text-gray-500">
                                ID: {{ $order->id }} • Items: {{ $order->transactionDetails->count() }}
                            </div>
                            <div class="flex flex-wrap gap-3">
                                @if($order->payment_status == 'pending')
                                <form method="POST" action="{{ route('seller.orders.updateStatus', $order) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="px-5 py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-medium rounded-lg hover:from-green-600 hover:to-emerald-700 transition duration-200 ease-in-out flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Konfirmasi Pembayaran
                                    </button>
                                </form>
                                @endif
                                
                                @if(in_array($order->payment_status, ['paid', 'processing']))
                                <form method="POST" action="{{ route('seller.orders.updateStatus', $order) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="px-5 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium rounded-lg hover:from-blue-600 hover:to-indigo-700 transition duration-200 ease-in-out flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                        </svg>
                                        Proses Pengiriman
                                    </button>
                                </form>
                                @endif
                                
                                <a href="{{ route('seller.orders.show', $order) }}" 
                                   class="px-5 py-2 bg-gradient-to-r from-purple-500 to-pink-600 text-white font-medium rounded-lg hover:from-purple-600 hover:to-pink-700 transition duration-200 ease-in-out flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Detail Pesanan
                                </a>
                                <form action="{{ route('seller.orders.updateStatus', $order) }}" method="POST" onsubmit="return confirm('Batalkan pesanan ini?');">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button class="px-5 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition duration-200 ease-in-out flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Batalkan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($orders->hasPages())
            <div class="mt-8">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                            Menampilkan <span class="font-medium">{{ $orders->firstItem() }}</span> - 
                            <span class="font-medium">{{ $orders->lastItem() }}</span> dari 
                            <span class="font-medium">{{ $orders->total() }}</span> pesanan
                        </div>
                        <div class="flex items-center space-x-2">
                            @if($orders->onFirstPage())
                            <span class="px-4 py-2 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed">
                                Sebelumnya
                            </span>
                            @else
                            <a href="{{ $orders->previousPageUrl() }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                                Sebelumnya
                            </a>
                            @endif

                            @foreach(range(1, min(5, $orders->lastPage())) as $page)
                                @if($page == $orders->currentPage())
                                <span class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium">
                                    {{ $page }}
                                </span>
                                @else
                                <a href="{{ $orders->url($page) }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                                    {{ $page }}
                                </a>
                                @endif
                            @endforeach

                            @if($orders->hasMorePages())
                            <a href="{{ $orders->nextPageUrl() }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                                Selanjutnya
                            </a>
                            @else
                            <span class="px-4 py-2 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed">
                                Selanjutnya
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endif

            <!-- Quick Actions -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="#" class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-white/20 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Pesanan Baru</h4>
                    <p class="text-sm opacity-90">{{ $orders->where('payment_status', 'pending')->count() }} menunggu</p>
                </a>

                <a href="#" class="bg-gradient
</x-app-layout>