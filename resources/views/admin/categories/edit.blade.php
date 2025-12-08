<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <div class="flex items-center mb-2">
                            <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <h1 class="text-3xl font-bold text-gray-900">Edit Kategori</h1>
                        </div>
                        <p class="text-gray-600 ml-11">Memperbarui informasi kategori <span class="font-semibold text-blue-600">{{ $category->name }}</span></p>
                    </div>
                    
                    <!-- Status Badge -->
                    <div class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                        <span class="flex items-center">
                            <span class="w-2 h-2 bg-blue-600 rounded-full mr-2 animate-pulse"></span>
                            ID: {{ $category->id }}
                        </span>
                    </div>
                </div>

                <!-- Last Updated Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm text-blue-700">
                            Terakhir diperbarui: {{ $category->updated_at ? $category->updated_at->format('d M Y H:i') : 'Belum pernah diperbarui' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="px-8 py-6 bg-gradient-to-r from-indigo-50 to-purple-50">
                    <h2 class="text-xl font-semibold text-gray-800">Informasi Kategori</h2>
                    <p class="text-gray-600 text-sm">Perbarui detail kategori sesuai kebutuhan</p>
                </div>

                <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="p-8">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nama Kategori -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-3">
                            <label class="block text-sm font-medium text-gray-700 flex items-center">
                                Nama Kategori
                                <span class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Required</span>
                            </label>
                            <span class="text-xs text-gray-500">Karakter: {{ strlen($category->name) }}</span>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   name="name" 
                                   class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out"
                                   value="{{ $category->name }}"
                                   required>
                        </div>
                    </div>

                    <!-- Slug -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-3">
                            <label class="block text-sm font-medium text-gray-700 flex items-center">
                                Slug
                                <span class="ml-2 px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">URL-friendly</span>
                            </label>
                            <span class="text-xs text-gray-500">Format: kebab-case</span>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   name="slug" 
                                   class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out"
                                   value="{{ $category->slug }}">
                        </div>
                        <div class="mt-2 text-sm text-gray-500 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            URL: /categories/{{ $category->slug }}
                        </div>
                    </div>

                    <!-- Tagline -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-3">
                            <label class="block text-sm font-medium text-gray-700 flex items-center">
                                Tagline
                                <span class="ml-2 px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Optional</span>
                            </label>
                            <span class="text-xs text-gray-500">Maks. 60 karakter</span>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   name="tagline" 
                                   class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out"
                                   value="{{ $category->tagline }}"
                                   placeholder="Tambah tagline menarik...">
                        </div>
                        <div class="mt-2">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Tagline akan ditampilkan di halaman kategori
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-10">
                        <div class="flex items-center justify-between mb-3">
                            <label class="block text-sm font-medium text-gray-700 flex items-center">
                                Deskripsi
                                <span class="ml-2 px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">Recommended</span>
                            </label>
                            <span class="text-xs text-gray-500">Maks. 500 karakter</span>
                        </div>
                        <div class="relative">
                            <div class="absolute top-3 left-3 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                                </svg>
                            </div>
                            <textarea name="description" 
                                      rows="6"
                                      class="pl-10 pt-3 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out resize-none">{{ $category->description }}</textarea>
                        </div>
                        <div class="flex justify-between items-center mt-2">
                            <p class="text-sm text-gray-500">Deskripsi mendetail tentang kategori</p>
                            <span class="text-xs text-gray-400">{{ strlen($category->description) }}/500 karakter</span>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-8 border-t border-gray-200">
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.categories.index') }}" 
                               class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition duration-200 ease-in-out flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali
                            </a>
                            <button type="reset" 
                                    class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition duration-200 ease-in-out flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Reset
                            </button>
                        </div>
                        
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.categories.show', $category) }}" 
                               class="px-6 py-3 border border-blue-300 text-blue-700 font-medium rounded-xl hover:bg-blue-50 transition duration-200 ease-in-out flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Preview
                            </a>
                            <button type="submit" 
                                    class="px-8 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-medium rounded-xl hover:from-indigo-600 hover:to-purple-700 transition duration-200 ease-in-out shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Kategori
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Danger Zone -->
            <div class="mt-8">
                <div class="bg-red-50 border border-red-200 rounded-2xl overflow-hidden">
                    <div class="px-8 py-6 bg-gradient-to-r from-red-50 to-pink-50">
                        <h2 class="text-xl font-semibold text-red-800 flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            Zona Berbahaya
                        </h2>
                        <p class="text-red-600 text-sm mt-1">Aksi ini tidak dapat dibatalkan</p>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="font-medium text-gray-800">Hapus Kategori</h3>
                                <p class="text-sm text-gray-600 mt-1">Menghapus kategori akan menghapus semua data terkait</p>
                            </div>
                            <button type="button"
                                    onclick="confirmDelete()"
                                    class="px-6 py-3 bg-gradient-to-r from-red-500 to-pink-600 text-white font-medium rounded-xl hover:from-red-600 hover:to-pink-700 transition duration-200 ease-in-out flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus Kategori
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function confirmDelete() {
        if (confirm('Apakah Anda yakin ingin menghapus kategori "{{ $category->name }}"?\n\nAksi ini tidak dapat dibatalkan!')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("admin.categories.destroy", $category) }}';
            form.style.display = 'none';
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            const method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(method);
            document.body.appendChild(form);
            form.submit();
        }
    }
    </script>
</x-app-layout>