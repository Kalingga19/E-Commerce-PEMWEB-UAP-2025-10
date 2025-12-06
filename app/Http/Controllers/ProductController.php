<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // List semua produk
    public function index()
    {
        $products = Product::with(['images' => function($q) {
            $q->where('is_thumbnail', true);
        }])->latest()->get();

        $categories = ProductCategory::all();

        return view('products.index', compact('products', 'categories'));
    }

    // Detail produk
    public function show($slug)
    {
        $product = Product::with([
            'images',
            'store',
            'reviews.user'
        ])->where('slug', $slug)->firstOrFail();

        return view('products.show', compact('product'));
    }
}
