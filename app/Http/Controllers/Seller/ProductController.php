<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /** LIST PRODUK */
    public function index()
    {
        $products = Auth::user()->store->products()->latest()->paginate(12);
        return view('seller.products.index', compact('products'));
    }

    /** FORM CREATE */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('seller.products.create', compact('categories'));
    }

    /** SIMPAN PRODUK BARU */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'product_category_id' => 'required|exists:product_categories,id',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
            'stock' => 'required|integer',
            'images.*' => 'nullable|image|max:5120',
        ]);

        $store = Auth::user()->store;

        /** SIMPAN PRODUK */
        $product = Product::create([
            'store_id' => $store->id,
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'condition' => $request->condition ?? 'new',
            'price' => $request->price,
            'weight' => $request->weight,
            'stock' => $request->stock,
        ]);

        /** SIMPAN GAMBAR */
        if ($request->hasFile('images')) {
            $i = 0;
            foreach ($request->file('images') as $file) {
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'is_thumbnail' => $i === 0, // foto pertama thumbnail
                ]);
                $i++;
            }
        }

        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil dibuat.');
    }

    /** FORM EDIT PRODUK */
    public function edit(Product $product)
    {
        $this->authorizeProduct($product);
        $categories = ProductCategory::all();
        return view('seller.products.edit', compact('product', 'categories'));
    }

    /** UPDATE PRODUK */
    public function update(Request $request, Product $product)
    {
        $this->authorizeProduct($product);

        $request->validate([
            'name' => 'required',
            'product_category_id' => 'required|exists:product_categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'weight' => 'nullable|numeric',
            'images.*' => 'nullable|image|max:5120',
        ]);

        /** UPDATE FIELD PRODUK */
        $product->update([
            'name' => $request->name,
            'product_category_id' => $request->product_category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'weight' => $request->weight,
            'description' => $request->description,
            'is_active' => $request->is_active ?? 1,
        ]);

        /** CEK APAKAH PRODUK SUDAH PUNYA THUMBNAIL */
        $hasThumbnail = $product->productImages()->where('is_thumbnail', 1)->exists();

        /** UPLOAD GAMBAR BARU */
        if ($request->hasFile('images')) {

            $i = 0;

            foreach ($request->file('images') as $file) {

                $path = $file->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,

                    // Jika produk BELUM punya thumbnail, gambar pertama jadi thumbnail
                    'is_thumbnail' => (!$hasThumbnail && $i === 0) ? 1 : 0,
                ]);

                $i++;
            }
        }

        return redirect()->route('seller.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /** HAPUS GAMBAR SATUAN */
    public function deleteImage($id)
    {
        $img = ProductImage::findOrFail($id);

        // hapus file fisik
        Storage::disk('public')->delete($img->image);

        $product_id = $img->product_id;
        $wasThumbnail = $img->is_thumbnail;

        $img->delete();

        /** Jika thumbnail dihapus → buat thumbnail baru dari gambar lain jika ada */
        if ($wasThumbnail) {
            $newThumb = ProductImage::where('product_id', $product_id)->first();
            if ($newThumb) {
                $newThumb->is_thumbnail = 1;
                $newThumb->save();
            }
        }

        return back()->with('success', 'Gambar berhasil dihapus.');
    }

    /** HAPUS PRODUK */
    public function destroy(Product $product)
    {
        $this->authorizeProduct($product);

        foreach ($product->productImages as $img) {
            Storage::disk('public')->delete($img->image);
            $img->delete();
        }

        $product->delete();

        return redirect()->route('seller.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    /** CEK APAKAH PRODUK MILIK SELLER */
    private function authorizeProduct(Product $product)
    {
        if ($product->store_id !== Auth::user()->store->id) {
            abort(403, "Unauthorized product access.");
        }
    }
}
