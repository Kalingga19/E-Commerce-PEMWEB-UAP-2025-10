<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort;

        $products = Product::with('productImages');

        if ($sort == 'price_asc') $products->orderBy('price');
        elseif ($sort == 'price_desc') $products->orderByDesc('price');
        elseif ($sort == 'name_asc') $products->orderBy('name');
        else $products->latest();

        // 🔥 MASUKKAN DI SINI — DI DALAM FUNCTION!
        $latestProducts = Product::with('productImages')
            ->latest()
            ->take(5)
            ->get();
        // 🔥 END

        return view('customer.home', [
            'categories' => ProductCategory::all(),
            'products' => $products->paginate(12),
            'latestProducts' => $latestProducts,
        ]);
    }

    public function search(Request $request)
    {
        $q = $request->q;

        $products = Product::where('name', 'like', "%$q%")
            ->orWhere('description', 'like', "%$q%")
            ->paginate(12);

        return view('customer.home', [
            'products' => $products,
            'categories' => ProductCategory::all(),
        ]);
    }

    public function category($slug)
    {
        $category = ProductCategory::where('slug', $slug)->firstOrFail();

        $products = Product::where('product_category_id', $category->id)->paginate(12);

        return view('customer.home', [
            'categories' => ProductCategory::all(),
            'products' => $products,
            'selectedCategory' => $category,
        ]);
    }
}