<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $path = $request->file('image')->store('product_images', 'public');

        ProductImage::create([
            'product_id' => $product->id,
            'image' => $path,
            'is_thumbnail' => false
        ]);

        return back()->with('success', 'Gambar berhasil ditambahkan.');
    }

    public function makeThumbnail(ProductImage $image)
    {
        $image->is_thumbnail = true;
        $image->save();

        return back()->with('success', 'Thumbnail diperbarui.');
    }

    public function destroy(ProductImage $image)
    {
        Storage::disk('public')->delete($image->image);
        $image->delete();

        return back()->with('success', 'Gambar dihapus.');
    }
}
