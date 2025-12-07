<x-app-layout>

<div class="py-6 grid grid-cols-2 gap-6">
    <div>
        @php
            $thumb = $product->productImages->where('is_thumbnail', true)->first() ?? $product->productImages->first();
        @endphp

        @if($thumb)
            <img src="{{ asset('storage/'.$thumb->image) }}" class="w-full rounded shadow mb-4">
        @endif

        <div class="grid grid-cols-4 gap-2">
            @foreach($product->productImages as $img)
                <img src="{{ asset('storage/'.$img->image) }}" class="h-16 object-cover border rounded">
            @endforeach
        </div>
    </div>

    <div>
        <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
        <p class="text-xl text-green-600 mb-4">Rp {{ number_format($product->price) }}</p>

        <p class="mb-4">{{ $product->description }}</p>

        <form method="POST" action="/checkout">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <label class="block mb-2">Jumlah:</label>
            <input type="number" name="qty" value="1" min="1" class="border rounded p-2 mb-4">

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Beli Sekarang</button>
        </form>
    </div>
</div>
</x-app-layout>