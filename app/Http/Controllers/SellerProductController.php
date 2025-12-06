<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SellerProductController extends Controller
{
    public function index(Request $request)
    {
        $storeId = auth()->user()->store->id;

        $query = Product::where('store_id', $storeId)->with('images');

        // SEARCH
        if ($request->search) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // FILTER CATEGORY
        if ($request->category) {
            $query->where('product_category_id', $request->category);
        }

        // FILTER STATUS
        if ($request->status === 'active') {
            $query->where('stock', '>', 0);
        }

        if ($request->status === 'inactive') {
            $query->where('stock', 0);
        }

        if ($request->status === 'out_of_stock') {
            $query->where('stock', 0);
        }

        $products = $query->latest()->paginate(10);
        $categories = ProductCategory::all();

        return view('seller.products', compact('products', 'categories'));
    }


    public function create()
    {
        $categories = ProductCategory::all();
        return view('seller.products-create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'product_category_id' => 'required|exists:product_categories,id',
            'description' => 'required',
            'condition'   => 'required|in:new,second',
            'price'       => 'required|numeric|min:1',
            'weight'      => 'required|numeric|min:1',
            'stock'       => 'required|integer|min:1',
            'thumbnail'   => 'required|image|max:2048',
            'images.*'    => 'nullable|image|max:2048',
        ]);

        $storeId = auth()->user()->store->id;

        $product = Product::create([
            'store_id' => $storeId,
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'description' => $request->description,
            'condition' => $request->condition,
            'price' => $request->price,
            'weight' => $request->weight,
            'stock' => $request->stock,
        ]);

        // Upload thumbnail
        $path = $request->file('thumbnail')->store('products', 'public');

        ProductImage::create([
            'product_id' => $product->id,
            'path' => $path,
            'is_thumbnail' => true
        ]);

        // Upload gallery images (optional)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $p = $img->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $p,
                    'is_thumbnail' => false
                ]);
            }
        }

        return redirect()->route('seller.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $storeId = auth()->user()->store->id;

        $product = Product::where('store_id', $storeId)->with('images')->findOrFail($id);
        $categories = ProductCategory::all();

        return view('seller.products-edit', compact('product', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $storeId = auth()->user()->store->id;

        $product = Product::where('store_id', $storeId)->findOrFail($id);

        $request->validate([
            'name'        => 'required',
            'product_category_id' => 'required',
            'description' => 'required',
            'condition'   => 'required|in:new,second',
            'price'       => 'required|numeric',
            'weight'      => 'required|numeric',
            'stock'       => 'required|integer',
            'thumbnail'   => 'nullable|image|max:2048',
        ]);

        // Only update slug if name changed
        $slug = $product->name !== $request->name
            ? Str::slug($request->name) . '-' . time()
            : $product->slug;

        $product->update([
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'condition' => $request->condition,
            'price' => $request->price,
            'weight' => $request->weight,
            'stock' => $request->stock,
        ]);

        // Update thumbnail (optional)
        if ($request->hasFile('thumbnail')) {

            $old = $product->images()->where('is_thumbnail', true)->first();

            if ($old) {
                Storage::disk('public')->delete($old->path);
                $old->delete();
            }

            $path = $request->file('thumbnail')->store('products', 'public');

            ProductImage::create([
                'product_id' => $product->id,
                'path' => $path,
                'is_thumbnail' => true
            ]);
        }

        return redirect()->route('seller.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $storeId = auth()->user()->store->id;

        $product = Product::where('store_id', $storeId)->with('images')->findOrFail($id);

        // Delete all images from storage
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->path);
            $img->delete();
        }

        $product->delete();

        return redirect()->route('seller.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
