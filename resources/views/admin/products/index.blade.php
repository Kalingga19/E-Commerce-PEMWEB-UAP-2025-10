<x-app-layout>
    <div class="min-h-screen bg-gray-50 p-6">
        <div class="max-w-7xl mx-auto">
            
            <h1 class="text-3xl font-bold mb-6">Manajemen Produk</h1>

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

                <div class="px-6 py-4 border-b bg-gray-100">
                    <h2 class="text-lg font-semibold">Semua Produk</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left">Produk</th>
                                <th class="px-6 py-3 text-left">Seller</th>
                                <th class="px-6 py-3 text-left">Kategori</th>
                                <th class="px-6 py-3 text-left">Harga</th>
                                <th class="px-6 py-3 text-left">Stok</th>
                                <th class="px-6 py-3 text-left">Status</th>
                                <th class="px-6 py-3 text-left">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($products as $product)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="font-bold">{{ $product->name }}</div>
                                    <div class="text-xs text-gray-500">ID: {{ $product->id }}</div>
                                </td>

                                <td class="px-6 py-4">
                                    {{ $product->store->name ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $product->category->name ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $product->stock }}
                                </td>

                                <td class="px-6 py-4">
                                    @if($product->status == 'active')
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">Active</span>
                                    @else
                                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs">Suspended</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 flex space-x-3">

                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="text-blue-600 hover:text-blue-800">Edit</a>

                                    @if($product->status == 'active')
                                        <form method="POST"
                                            action="{{ route('admin.products.suspend', $product) }}">
                                            @csrf @method('PATCH')
                                            <button class="text-orange-600 hover:text-orange-800">
                                                Suspend
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST"
                                            action="{{ route('admin.products.activate', $product) }}">
                                            @csrf @method('PATCH')
                                            <button class="text-green-600 hover:text-green-800">
                                                Activate
                                            </button>
                                        </form>
                                    @endif

                                    <form method="POST"
                                        action="{{ route('admin.products.destroy', $product) }}">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:text-red-800">
                                            Hapus
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
