<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::with([
                'productImages',
                'store',
                'productReviews'
            ])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('customer.product.show', compact('product'));
    }
}
