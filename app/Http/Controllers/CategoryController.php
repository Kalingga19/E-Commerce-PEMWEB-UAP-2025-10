<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = ProductCategory::where('slug', $slug)->firstOrFail();

        $products = Product::with('images')
            ->where('product_category_id', $category->id)
            ->paginate(12);

        return view('pages.category', compact('category', 'products'));
    }
}
