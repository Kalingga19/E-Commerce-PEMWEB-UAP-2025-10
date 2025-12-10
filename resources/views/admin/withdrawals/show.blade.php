<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="md:flex md:items-center md:justify-between mb-8">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        Detail Withdrawal
                    </h2>
                    <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM4.333 4.333a9.964 9.964 0 00-2.86 6.976A9.97 9.97 0 004.334 15.67 9.964 9.964 0 0010 18a9.964 9.964 0 005.667-2.33 9.97 9.97 0 002.86-6.976A9.964 9.964 0 0010 2z" clip-rule="evenodd" />
                            </svg>
                            ID: #{{ $withdrawal->id }}
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            {{ $withdrawal->created_at->format('d M Y') }}
                        </div>
                    </div>
                </div>
                
                @if($withdrawal->status === 'pending')
                <div class="mt-4 flex md:mt-0 md:ml-4 space-x-3">
                    <form action="{{ route('admin.withdrawals.approve', $withdrawal->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Approve
                        </button>
                    </form>
                    
                    <button type="button" data-modal-toggle="rejectModal" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        Tolak
                    </button>
                </div>
                @endif
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Store Information Card -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:px-6 bg-gradient-to-r from-blue-500 to-blue-600">
                        <h3 class="text-lg leading-6 font-medium text-white flex items-center">
                            <svg class="mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Informasi Toko
                        </h3>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                        <dl class="space-y-6">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 flex items-center">
                                    <svg class="mr-2 h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    Nama Toko
                                </dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900 pl-7">{{ $withdrawal->store->store_name }}</dd>
                            </div>
                            
                            <div>
                                <dt class="text-sm font-medium text-gray-500 flex items-center">
                                    <svg class="mr-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                                    </svg>
                                    Saldo Saat Ini
                                </dt>
                                <dd class="mt-1 pl-7">
                                    <span class="text-2xl font-bold text-green-600">
                                        Rp {{ number_format($withdrawal->store->balance, 0, ',', '.') }}
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Withdrawal Information Card -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:px-6 bg-gradient-to-r from-purple-500 to-purple-600">
                        <h3 class="text-lg leading-6 font-medium text-white flex items-center">
                            <svg class="mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Informasi Penarikan
                        </h3>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                        <dl class="space-y-6">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 flex items-center">
                                    <svg class="mr-2 h-5 w-5 text-purple-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                                    </svg>
                                    Jumlah Penarikan
                                </dt>
                                <dd class="mt-1 pl-7">
                                    <span class="text-2xl font-bold text-purple-600">
                                        Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}
                                    </span>
                                </dd>
                            </div>
                            
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="mt-1">
                                    @php
                                        $statusConfig = [
                                            'pending' => ['color' => 'yellow', 'icon' => 'clock'],
                                            'approved' => ['color' => 'green', 'icon' => 'check-circle'],
                                            'rejected' => ['color' => 'red', 'icon' => 'x-circle']
                                        ];
                                        $config = $statusConfig[$withdrawal->status] ?? ['color' => 'gray', 'icon' => 'question-mark-circle'];
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $config['color'] }}-100 text-{{ $config['color'] }}-800">
                                        <svg class="mr-1.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            @if($config['icon'] === 'clock')
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                            @elseif($config['icon'] === 'check-circle')
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            @elseif($config['icon'] === 'x-circle')
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                            @else
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                            @endif
                                        </svg>
                                        {{ ucfirst($withdrawal->status) }}
                                    </span>
                                </dd>
                            </div>
                            
                            @if($withdrawal->reject_reason)
                            <div class="bg-red-50 border-l-4 border-red-400 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">Alasan Ditolak</h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <p>{{ $withdrawal->reject_reason }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Additional Information Card -->
            <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6 bg-gradient-to-r from-gray-600 to-gray-700">
                    <h3 class="text-lg leading-6 font-medium text-white flex items-center">
                        <svg class="mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Detail Lainnya
                    </h3>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Tanggal Permintaan</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $withdrawal->created_at->format('d F Y, H:i') }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">ID Toko</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $withdrawal->store->id }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Saldo Setelah Penarikan</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <span class="font-bold text-green-600">
                                    Rp {{ number_format($withdrawal->store->balance - $withdrawal->amount, 0, ',', '.') }}
                                </span>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto mx-auto flex items-center justify-center">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-lg">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4 rounded-t border-b bg-red-600">
                    <div class="flex items-center">
                        <svg class="mr-2 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.75 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-white">
                            Tolak Withdrawal
                        </h3>
                    </div>
                    <button type="button" class="text-white bg-transparent hover:bg-red-700 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="rejectModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('admin.withdrawals.reject', $withdrawal->id) }}" method="POST">
                    @csrf
                    <div class="p-6 space-y-4">
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        <strong>Perhatian:</strong> Penolakan tidak dapat dibatalkan. Pastikan alasan penolakan jelas dan dapat dipahami.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label for="reason" class="block text-sm font-medium text-gray-700 mb-2">
                                Alasan Penolakan <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="reason" 
                                name="reason" 
                                rows="4" 
                                class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-3 border" 
                                placeholder="Masukkan alasan penolakan withdrawal..."
                                required
                            ></textarea>
                            <p class="mt-2 text-sm text-gray-500">Berikan penjelasan yang jelas kepada pemilik toko.</p>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end p-6 space-x-2 rounded-b border-t border-gray-200">
                        <button type="button" data-modal-toggle="rejectModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150 ease-in-out">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out">
                            Tolak Penarikan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal -->
    <script>
        // Modal toggle functionality
        const modalToggle = document.querySelector('[data-modal-toggle="rejectModal"]');
        const modal = document.getElementById('rejectModal');
        
        if (modalToggle && modal) {
            modalToggle.addEventListener('click', () => {
                modal.classList.toggle('hidden');
            });
            
            // Close modal when clicking outside
            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });
            
            // Close modal with close button
            const closeButton = modal.querySelector('[data-modal-toggle="rejectModal"]');
            if (closeButton) {
                closeButton.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });
            }
            
            // Close with escape key
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                    modal.classList.add('hidden');
                }
            });
        }
    </script>
</x-app-layout>