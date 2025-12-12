<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCatalogController extends Controller
{
    public function index(Request $request)
    {
        $categories = ProductCategory::orderBy('name')->get();

        $products = Product::query()
            ->with(['productImages', 'store', 'productCategory'])
            // hanya produk yang stock > 0 (opsional)
            // ->where('stock', '>', 0)
            ->when($request->q, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%');
            })
            ->when($request->category, function ($q) use ($request) {
                $q->whereHas('productCategory', function ($catQ) use ($request) {
                    $catQ->where('slug', $request->category);
                });
            })
            ->when($request->sort, function ($q) use ($request) {
                switch ($request->sort) {
                    case 'price_asc':
                        $q->orderBy('price', 'asc');
                        break;
                    case 'price_desc':
                        $q->orderBy('price', 'desc');
                        break;
                    case 'name_asc':
                        $q->orderBy('name', 'asc');
                        break;
                    case 'name_desc':
                        $q->orderBy('name', 'desc');
                        break;
                    default:
                        $q->latest();
                }
            }, function ($q) {
                $q->latest();
            })
            ->paginate(20);

        return view('customer.product.index', compact('products', 'categories'));
    }
}
