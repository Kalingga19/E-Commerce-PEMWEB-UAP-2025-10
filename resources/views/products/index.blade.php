@foreach ($products as $product)
    <div class="product-card">

        <img 
            src="{{ asset('storage/' . ($product->images->first()->path ?? 'defaults/default.png')) }}" 
            alt="{{ $product->name }}"
        />

        <h3>{{ $product->name }}</h3>
        <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>

    </div>
@endforeach

<style>
    .product-card {
        border: 1px solid #ccc;
        padding: 16px;
        margin: 16px;
        text-align: center;
    }

    .product-card img {
        max-width: 100%;
        height: auto;
    }
</style>
