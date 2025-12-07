<x-app-layout>
<div class="py-6">

    <h2 class="text-2xl font-bold mb-4">Semua Produk</h2>

    <div class="grid grid-cols-4 gap-6">
        @foreach($products as $product)
            <a href="/product/{{ $product->slug }}" class="block bg-white p-4 shadow rounded">

                @php
                    $thumb = $product->productImages->where('is_thumbnail', true)->first();
                    if (!$thumb) $thumb = $product->productImages->first();
                @endphp

                @if($thumb)
                    <img src="{{ asset('storage/'.$thumb->image) }}" class="h-40 w-full object-cover mb-3">
                @else
                    <div class="h-40 bg-gray-200 mb-3 flex items-center justify-center">No Image</div>
                @endif

                <h3 class="font-semibold">{{ $product->name }}</h3>
                <p class="text-md text-green-600">Rp {{ number_format($product->price,0,',','.') }}</p>
            </a>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>

</div>
</x-app-layout>