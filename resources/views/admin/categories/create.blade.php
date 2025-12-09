<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Tambah Kategori Baru</h1>
                        <p class="text-gray-600 mt-2">Buat kategori produk baru untuk sistem e-commerce</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-full">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                
                <!-- Progress Steps -->
                <div class="flex items-center mb-8">
                    <div class="flex-1 border-t-2 border-blue-500"></div>
                    <div class="mx-4">
                        <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">
                            1
                        </div>
                        <p class="text-xs text-blue-600 mt-2 text-center">Form</p>
                    </div>
                    <div class="flex-1 border-t-2 border-gray-300"></div>
                    <div class="mx-4">
                        <div class="w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold">
                            2
                        </div>
                        <p class="text-xs text-gray-500 mt-2 text-center">Review</p>
                    </div>
                    <div class="flex-1 border-t-2 border-gray-300"></div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="px-8 py-6 bg-gradient-to-r from-blue-50 to-indigo-50">
                    <h2 class="text-xl font-semibold text-gray-800">Detail Kategori</h2>
                    <p class="text-gray-600 text-sm">Isi semua informasi yang diperlukan</p>
                </div>

                <form method="POST" action="{{ route('admin.categories.store') }}" class="p-8">
                    @csrf
                    
                    <!-- Nama Kategori -->
                    <div class="mb-8">
                        <div class="flex items-center mb-3">
                            <label class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                            <span class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Required</span>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                name="name" 
                                class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out"
                                placeholder="Contoh: Elektronik, Fashion, Makanan"
                                required>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Nama kategori akan ditampilkan di halaman depan</p>
                    </div>

                    <!-- Slug -->
                    <div class="mb-8">
                        <div class="flex items-center mb-3">
                            <label class="block text-sm font-medium text-gray-700">Slug</label>
                            <span class="ml-2 px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Auto-generate</span>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   name="slug" 
                                   class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out"
                                   placeholder="elektronik, fashion-pria, makanan-sehat">
                        </div>
                        <p class="mt-2 text-sm text-gray-500">URL-friendly version untuk kategori (gunakan huruf kecil dan tanda hubung)</p>
                    </div>

                    <!-- Tagline -->
                    <div class="mb-8">
                        <div class="flex items-center mb-3">
                            <label class="block text-sm font-medium text-gray-700">Tagline</label>
                            <span class="ml-2 px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Optional</span>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   name="tagline" 
                                   class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out"
                                   placeholder="Slogan menarik untuk kategori ini">
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Teks singkat yang menarik untuk kategori (maksimal 60 karakter)</p>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-10">
                        <div class="flex items-center mb-3">
                            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <span class="ml-2 px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">Recommended</span>
                        </div>
                        <div class="relative">
                            <div class="absolute top-3 left-3 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <textarea name="description" 
                                      rows="5"
                                      class="pl-10 pt-3 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out resize-none"
                                      placeholder="Jelaskan secara detail tentang kategori ini..."></textarea>
                        </div>
                        <div class="flex justify-between items-center mt-2">
                            <p class="text-sm text-gray-500">Deskripsi lengkap tentang kategori (maksimal 500 karakter)</p>
                            <span class="text-xs text-gray-400">0/500 karakter</span>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-8 border-t border-gray-200">
                        <a href="{{ route('admin.categories.index') }}" 
                           class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition duration-200 ease-in-out flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                        <div class="flex space-x-4">
                            <button type="reset" 
                                    class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition duration-200 ease-in-out">
                                Reset Form
                            </button>
                            <form method="POST" action="{{ route('admin.categories.store') }}">
                                <button type="submit"
                                        class="px-8 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-medium rounded-xl hover:from-green-600 hover:to-emerald-700 transition duration-200 ease-in-out shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Simpan Kategori
                                </button>
                            </form>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Help Text -->
            <div class="mt-8 p-6 bg-blue-50 rounded-2xl border border-blue-200">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-blue-600 mt-1 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h3 class="font-medium text-blue-900">Tips Membuat Kategori yang Baik</h3>
                        <ul class="mt-2 text-sm text-blue-800 space-y-1">
                            <li>• Gunakan nama kategori yang singkat dan jelas</li>
                            <li>• Slug akan otomatis dibuat dari nama kategori</li>
                            <li>• Tagline membantu meningkatkan konversi penjualan</li>
                            <li>• Deskripsi detail membantu SEO dan pemahaman pengguna</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>