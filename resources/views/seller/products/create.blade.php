<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                            <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Produk Baru
                        </h1>
                        <p class="text-gray-600 mt-2 ml-11">Lengkapi informasi produk untuk ditambahkan ke toko Anda</p>
                    </div>

                    <!-- Progress Steps -->
                    <div class="hidden md:flex items-center">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center font-bold">
                                1
                            </div>
                            <div class="w-32 h-1 bg-green-600"></div>
                            <div
                                class="w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold">
                                2
                            </div>
                            <div class="w-32 h-1 bg-gray-300"></div>
                            <div
                                class="w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold">
                                3
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Guidance Card -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-2xl p-6 mb-8">
                    <div class="flex items-start">
                        <div class="p-3 bg-white rounded-xl shadow-sm mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-800 mb-2">Tips Produk yang Baik</h3>
                            <ul class="space-y-1 text-sm text-gray-600">
                                <li class="flex items-start">
                                    <span class="text-green-500 mr-2">✓</span>
                                    Gunakan foto produk yang jelas dan menarik
                                </li>
                                <li class="flex items-start">
                                    <span class="text-green-500 mr-2">✓</span>
                                    Deskripsi detail membantu meningkatkan konversi
                                </li>
                                <li class="flex items-start">
                                    <span class="text-green-500 mr-2">✓</span>
                                    Harga yang kompetitif dengan kualitas produk
                                </li>
                                <li class="flex items-start">
                                    <span class="text-green-500 mr-2">✓</span>
                                    Kategori yang tepat membantu pelanggan menemukan produk Anda
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Basic Information Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-100">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Dasar Produk
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <!-- Product Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                        Nama Produk
                                        <span
                                            class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Required</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                        </div>
                                        <input type="text" name="name"
                                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                            placeholder="Contoh: iPhone 13 Pro Max 256GB" required>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">Maksimal 100 karakter</p>
                                </div>

                                <!-- Category -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                        Kategori
                                        <span
                                            class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Required</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                                </path>
                                            </svg>
                                        </div>
                                        <select name="product_category_id"
                                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 appearance-none">
                                            <option value="">Pilih Kategori</option>
                                            @foreach($categories as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                        Harga
                                        <span
                                            class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Required</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 font-bold">Rp</span>
                                        </div>
                                        <input type="number" name="price"
                                            class="pl-12 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                            placeholder="0" min="1" required>
                                    </div>
                                    <div class="mt-2 grid grid-cols-2 gap-2">
                                        <div class="text-center p-2 bg-gray-100 rounded-lg">
                                            <p class="text-xs text-gray-600">Harga Jual</p>
                                            <p class="text-sm font-medium text-gray-800" id="priceDisplay">Rp 0</p>
                                        </div>
                                        <div class="text-center p-2 bg-gray-100 rounded-lg">
                                            <p class="text-xs text-gray-600">Keuntungan</p>
                                            <p class="text-sm font-medium text-green-600" id="profitDisplay">Rp 0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <!-- Weight -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                        Berat
                                        <span
                                            class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Required</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3">
                                                </path>
                                            </svg>
                                        </div>
                                        <input type="number" name="weight"
                                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                            placeholder="500" min="1" required>
                                        <div
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500">gram</span>
                                        </div>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">Berat mempengaruhi biaya pengiriman</p>
                                </div>

                                <!-- Stock -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                        Stok
                                        <span
                                            class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Required</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                                </path>
                                            </svg>
                                        </div>
                                        <input type="number" name="stock"
                                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                            placeholder="0" min="0" required>
                                    </div>
                                    <div class="mt-2">
                                        <div class="flex items-center">
                                            <input type="checkbox" id="preorder"
                                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                            <label for="preorder" class="ml-2 text-sm text-gray-600">Tersedia untuk
                                                pre-order</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Condition -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi Produk</label>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="relative">
                                            <input type="radio" name="condition" id="condition_new" value="new"
                                                class="sr-only" checked>
                                            <label for="condition_new"
                                                class="flex flex-col items-center p-4 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-green-500 transition duration-200 peer-checked:border-green-500 peer-checked:bg-green-50">
                                                <svg class="w-8 h-8 text-green-600 mb-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span class="font-medium text-gray-800">Baru</span>
                                                <span class="text-sm text-gray-600 mt-1">Original & Segel</span>
                                            </label>
                                        </div>

                                        <div class="relative">
                                            <input type="radio" name="condition" id="condition_second" value="second"
                                                class="sr-only">
                                            <label for="condition_second"
                                                class="flex flex-col items-center p-4 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-amber-500 transition duration-200 peer-checked:border-amber-500 peer-checked:bg-amber-50">
                                                <svg class="w-8 h-8 text-amber-600 mb-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span class="font-medium text-gray-800">Bekas</span>
                                                <span class="text-sm text-gray-600 mt-1">Second & Refurbished</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Deskripsi Produk
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                Deskripsi Detail
                                <span
                                    class="ml-2 px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">Recommended</span>
                            </label>
                            <div class="relative">
                                <div class="absolute top-3 left-3 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </div>
                                <textarea name="description" rows="6"
                                    class="pl-10 pt-3 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 resize-none"
                                    placeholder="Deskripsikan produk Anda secara detail..."></textarea>
                            </div>
                            <div class="flex justify-between items-center mt-2">
                                <p class="text-sm text-gray-500">Jelaskan spesifikasi, keunggulan, dan detail produk</p>
                                <span class="text-xs text-gray-400">0/2000 karakter</span>
                            </div>
                        </div>

                        <!-- Key Features -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Fitur Utama</label>
                            <div class="space-y-3" id="featuresContainer">
                                <div class="flex items-center">
                                    <input type="text" placeholder="Fitur 1 (Contoh: Garansi 1 tahun)"
                                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <button type="button" onclick="removeFeature(this)"
                                        class="ml-2 p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <button type="button" onclick="addFeature()"
                                class="mt-3 px-4 py-2 border border-dashed border-gray-300 text-gray-600 rounded-lg hover:bg-gray-50 transition duration-200 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Fitur
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Images Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-purple-100">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <svg class="w-6 h-6 text-purple-600 mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Gambar Produk
                        </h2>
                    </div>

                    <div class="p-6">
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                Upload Gambar
                                <span
                                    class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Required</span>
                            </label>

                            <!-- Hidden Input -->
                            <input type="file" name="images[]" id="productImagesInput" class="hidden" accept="image/*"
                                multiple />

                            <!-- Upload Box -->
                            <div id="uploadBox"
                                class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-purple-500 transition duration-200 cursor-pointer">

                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>

                                <p class="text-gray-600 mb-2">Drag & drop gambar atau klik untuk upload</p>
                                <p class="text-sm text-gray-500 mb-4">Format: JPG, PNG, GIF (Maks 5MB per gambar)</p>

                                <button type="button" id="uploadButton"
                                    class="px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-600 text-white rounded-lg hover:from-purple-600 hover:to-pink-700 transition duration-200">
                                    Pilih File
                                </button>
                            </div>
                        </div>

                        <!-- Image Preview -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Preview Gambar</label>
                            <div id="previewContainer" class="grid grid-cols-2 sm:grid-cols-4 gap-4"></div>

                            <p class="mt-4 text-sm text-gray-500">
                                Minimal 1 gambar, maksimal 8 gambar. Gambar pertama akan menjadi thumbnail.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Preview Script -->
                <script>
                    const input = document.getElementById('productImagesInput');
                    const uploadBox = document.getElementById('uploadBox');
                    const uploadButton = document.getElementById('uploadButton');
                    const previewContainer = document.getElementById('previewContainer');

                    uploadBox.addEventListener('click', () => input.click());
                    uploadButton.addEventListener('click', () => input.click());

                    input.addEventListener('change', () => {
                        previewContainer.innerHTML = '';

                        [...input.files].forEach((file, index) => {
                            const reader = new FileReader();

                            reader.onload = (e) => {
                                previewContainer.innerHTML += `
                    <div class="relative border rounded-xl overflow-hidden">
                        <img src="${e.target.result}" class="w-full h-32 object-cover">
                        <span class="absolute top-2 left-2 text-xs px-2 py-1 rounded bg-black bg-opacity-50 text-white">
                            ${index === 0 ? 'Thumbnail' : 'Gambar ' + (index + 1)}
                        </span>
                    </div>`;
                            };

                            reader.readAsDataURL(file);
                        });
                    });
                </script>

                <!-- Form Actions -->
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="text-sm text-gray-600">
                            <p>Pastikan semua informasi sudah benar sebelum menyimpan.</p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button type="button"
                                class="px-8 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition duration-200 ease-in-out">
                                Simpan sebagai Draft
                            </button>
                            <button type="submit"
                                class="px-8 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-0.5 flex items-center justify-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Publikasi Produk
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Price display formatting
        const priceInput = document.querySelector('input[name="price"]');
        const priceDisplay = document.getElementById('priceDisplay');
        const profitDisplay = document.getElementById('profitDisplay');

        priceInput.addEventListener('input', function () {
            const price = parseInt(this.value) || 0;
            const profit = Math.round(price * 0.7); // Assuming 30% margin

            priceDisplay.textContent = 'Rp ' + price.toLocaleString('id-ID');
            profitDisplay.textContent = 'Rp ' + profit.toLocaleString('id-ID');
        });

        // Initialize price display
        if (priceInput.value) {
            priceInput.dispatchEvent(new Event('input'));
        }

        // Features management
        let featureCount = 1;

        function addFeature() {
            featureCount++;
            const container = document.getElementById('featuresContainer');
            const newFeature = document.createElement('div');
            newFeature.className = 'flex items-center';
            newFeature.innerHTML = `
                <input type="text" 
                       placeholder="Fitur ${featureCount}"
                       class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                <button type="button" onclick="removeFeature(this)" class="ml-2 p-2 text-red-600 hover:bg-red-50 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;
            container.appendChild(newFeature);
        }

        function removeFeature(button) {
            const feature = button.parentElement;
            if (document.querySelectorAll('#featuresContainer > div').length > 1) {
                feature.remove();
            }
        }

        // Character counter for description
        const descriptionTextarea = document.querySelector('textarea[name="description"]');
        const charCounter = document.querySelector('span.text-xs.text-gray-400');

        descriptionTextarea.addEventListener('input', function () {
            const length = this.value.length;
            charCounter.textContent = `${length}/2000 karakter`;

            if (length > 2000) {
                charCounter.classList.remove('text-gray-400');
                charCounter.classList.add('text-red-600');
            } else {
                charCounter.classList.remove('text-red-600');
                charCounter.classList.add('text-gray-400');
            }
        });
    </script>
</x-app-layout>