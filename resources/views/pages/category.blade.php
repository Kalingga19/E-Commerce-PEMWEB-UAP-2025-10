@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="container py-4">

    <h3 class="mb-4">{{ $category->name }}</h3>

    @if($products->count() > 0)

    <div class="row">
        @foreach($products as $product)
        <div class="col-6 col-md-3 mb-4">
            <a href="{{ route('products.show', $product->slug) }}" 
               class="text-decoration-none">
                <div class="card h-100">

                    @if($product->images->count() > 0)
                    <img src="{{ asset('storage/' . $product->images->first()->path) }}"
                         class="card-img-top"
                         style="height: 180px; object-fit: cover;">
                    @else
                    <img src="/default.png" class="card-img-top">
                    @endif

                    <div class="card-body">
                        <h6 class="fw-bold">{{ Str::limit($product->name, 25) }}</h6>
                        <p class="text-danger mb-0">
                            Rp {{ number_format($product->price) }}
                        </p>
                    </div>

                </div>
            </a>
        </div>
        @endforeach
    </div>

    <div class="mt-3">
        {{ $products->links() }}
    </div>

    @else

    <div class="text-center py-5">
        <i class="bi bi-box fs-1 text-muted"></i>
        <h5 class="mt-3">Belum ada produk di kategori ini.</h5>
    </div>

    @endif

</div>
@endsection
