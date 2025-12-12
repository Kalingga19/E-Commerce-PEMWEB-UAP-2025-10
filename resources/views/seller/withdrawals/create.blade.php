<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center mb-6">
                    <div class="p-3 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl shadow-lg mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Penarikan Dana</h1>
                        <p class="text-gray-600 mt-1">Tarik dana hasil penjualan Anda dengan mudah</p>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Form -->
                <div class="lg:col-span-2">
                    <!-- Balance Info -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100 rounded-2xl p-6 mb-8">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Saldo Tersedia</p>
                                <p class="text-3xl font-bold text-gray-900">Rp <span id="balance-text">{{ number_format($balance, 0, ',', '.') }}</span></p>
                                <p class="text-sm text-gray-500 mt-1">Minimum penarikan: Rp 50.000</p>
                            </div>
                            <div class="p-3 bg-green-100 rounded-full">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Form Card -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                            <h2 class="text-xl font-semibold text-gray-900">Ajukan Penarikan Baru</h2>
                            <p class="text-sm text-gray-500 mt-1">Isi detail penarikan Anda</p>
                        </div>

                        <form method="POST" action="{{ route('seller.withdrawals.store') }}" class="px-6 py-8">
                            @csrf

                            <div class="space-y-6">
                                <!-- Amount Input -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">
                                        <span class="flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Jumlah Penarikan
                                            <span class="text-red-500 ml-1">*</span>
                                        </span>
                                    </label>
                                    
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <span class="text-gray-500 font-medium">Rp</span>
                                        </div>
                                        <input type="number" 
                                               name="amount" 
                                               required
                                               min="50000"
                                               step="1000"
                                               placeholder="Masukkan jumlah penarikan"
                                               class="block w-full pl-14 pr-4 py-4 border border-gray-300 rounded-xl
                                                      focus:ring-3 focus:ring-green-500 focus:border-green-500 
                                                      focus:outline-none transition duration-200
                                                      placeholder-gray-400 text-lg font-medium
                                                      @error('amount') border-red-500 @enderror">
                                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                            <span class="text-gray-400">IDR</span>
                                        </div>
                                    </div>
                                    
                                    @error('amount')
                                        <div class="mt-2 flex items-center text-sm text-red-600">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    
                                    <!-- Amount Suggestions -->
                                    <div class="mt-4">
                                        <p class="text-sm font-medium text-gray-600 mb-2">Pilih jumlah cepat:</p>
                                        <div class="grid grid-cols-3 gap-3">
                                            @php
                                                $currentBalance = auth()->user()->balance->amount ?? 0;

                                                $suggestions = [
                                                    $currentBalance >= 50000 ? 50000 : null,
                                                    $currentBalance >= 100000 ? 100000 : null,
                                                    $currentBalance >= 200000 ? 200000 : null,
                                                ];
                                            @endphp
                                            
                                            @foreach(array_filter($suggestions) as $amount)
                                                <button type="button" 
                                                        onclick="document.getElementsByName('amount')[0].value = {{ $amount }}"
                                                        class="text-center px-4 py-3 border border-gray-300 rounded-lg 
                                                               hover:border-green-500 hover:bg-green-50 
                                                               transition duration-200">
                                                    <span class="font-medium text-gray-900">Rp {{ number_format($amount) }}</span>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Bank Account Info -->
                                <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 p-2 bg-blue-100 rounded-lg">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="font-medium text-gray-900">Informasi Rekening</h4>
                                            <p class="text-sm text-gray-600 mt-1">
                                                Dana akan ditransfer ke rekening terdaftar Anda:
                                                <strong class="text-blue-700">{{ auth()->user()->bank_account ?? 'Belum diatur' }}</strong>
                                            </p>
                                            <a href="{{ route('profile.edit') }}" 
                                               class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 mt-2">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                </svg>
                                                Ubah informasi rekening
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Estimated Time -->
                                <div class="bg-amber-50 border border-amber-100 rounded-xl p-5">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 p-2 bg-amber-100 rounded-lg">
                                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="font-medium text-gray-900">Perkiraan Waktu Proses</h4>
                                            <p class="text-sm text-gray-600 mt-1">
                                                Penarikan akan diproses dalam <strong>1-3 hari kerja</strong> setelah permintaan diajukan.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="pt-4">
                                    <button type="submit"
                                            class="w-full flex justify-center items-center px-8 py-4 bg-gradient-to-r from-green-600 to-emerald-600 
                                                   text-white font-semibold rounded-xl shadow-lg 
                                                   hover:from-green-700 hover:to-emerald-700 
                                                   focus:outline-none focus:ring-4 focus:ring-green-500 focus:ring-opacity-50 
                                                   transform hover:-translate-y-0.5 transition-all duration-200
                                                   disabled:opacity-50 disabled:cursor-not-allowed">
                                        Ajukan Penarikan
                                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                        </svg>
                                    </button>
                                    
                                    <p class="mt-4 text-center text-sm text-gray-600">
                                        Dengan mengajukan penarikan, Anda menyetujui 
                                        <a href="#" class="font-medium text-green-600 hover:text-green-800">syarat dan ketentuan</a> kami.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Column - Info & History -->
                <div class="space-y-8">
                    <!-- Recent Withdrawals -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                            <h3 class="font-semibold text-gray-900">Penarikan Terakhir</h3>
                        </div>
                        <div class="p-6">
                            @if(auth()->user()->withdrawals()->count() > 0)
                                <div class="space-y-4">
                                    @foreach(auth()->user()->withdrawals()->latest()->take(3)->get() as $withdrawal)
                                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition duration-200">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <p class="font-medium text-gray-900">Rp {{ number_format($withdrawal->amount) }}</p>
                                                    <p class="text-sm text-gray-500 mt-1">
                                                        {{ $withdrawal->created_at->format('d M Y') }}
                                                    </p>
                                                </div>
                                                <div>
                                                    @if($withdrawal->status == 'pending')
                                                        <span class="px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                                            Diproses
                                                        </span>
                                                    @elseif($withdrawal->status == 'completed')
                                                        <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                                            Selesai
                                                        </span>
                                                    @else
                                                        <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                                            Ditolak
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <a href="{{ route('seller.withdrawals.index') }}" 
                                   class="mt-6 w-full block text-center px-4 py-3 border border-gray-300 
                                          text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition duration-200">
                                    Lihat Semua Riwayat
                                </a>
                            @else
                                <div class="text-center py-8">
                                    <div class="p-3 bg-gray-100 rounded-full inline-flex mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-600">Belum ada riwayat penarikan</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Information Card -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 rounded-2xl p-6">
                        <h4 class="font-semibold text-gray-900 mb-4">Tips Penarikan Dana</h4>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Pastikan saldo mencukupi untuk minimum penarikan</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Verifikasi informasi rekening sebelum mengajukan</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Proses penarikan membutuhkan 1-3 hari kerja</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Penarikan di hari libur akan diproses hari kerja berikutnya</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    const balance = {{ $balance }};
    const display = document.getElementById('amount_display');
    const real = document.getElementById('amount');
    const submitBtn = document.getElementById('submit-btn');

    function formatRupiah(value) {
        return value ? Number(value).toLocaleString('id-ID') : '';
    }

    function checkBalance() {
        const amount = parseInt(real.value || 0);

        if (amount >= 50000 && amount <= balance) {
            submitBtn.disabled = false;
            submitBtn.innerText = 'Ajukan Penarikan';
        } else {
            submitBtn.disabled = true;
            submitBtn.innerText = 'Saldo Tidak Mencukupi';
        }
    }

    display.addEventListener('input', function () {
        let raw = this.value.replace(/\D/g, '');
        real.value = raw;
        this.value = formatRupiah(raw);
        checkBalance();
    });

    function setAmount(val) {
        real.value = val;
        display.value = formatRupiah(val);
        checkBalance();
    }
</script>

</x-app-layout>