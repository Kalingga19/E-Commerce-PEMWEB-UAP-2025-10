<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Tampilkan halaman cart
     */
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())
                        ->with('product')
                        ->get();

        $subtotal = $cartItems->sum(fn ($item) =>
            $item->quantity * $item->product->price
        );

        return view('pages.cart', compact('cartItems', 'subtotal'));
    }

    /**
     * Tambah ke cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        $product = Product::find($request->product_id);

        // Cek stok
        if ($request->quantity > $product->stock) {
            return back()->with('error', 'Stok produk tidak mencukupi.');
        }

        // Cek apakah item sudah ada dalam cart
        $existing = Cart::where('user_id', auth()->id())
                        ->where('product_id', $request->product_id)
                        ->first();

        if ($existing) {
            // Update qty
            $newQty = $existing->quantity + $request->quantity;

            if ($newQty > $product->stock) {
                return back()->with('error', 'Jumlah melebihi stok.');
            }

            $existing->update(['quantity' => $newQty]);
        } else {
            // Buat baru
            Cart::create([
                'user_id'    => auth()->id(),
                'product_id' => $request->product_id,
                'quantity'   => $request->quantity
            ]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /**
     * Update jumlah item
     */
    public function update(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())
                    ->where('id', $request->cart_id)
                    ->firstOrFail();

        $product = $cart->product;

        if ($request->quantity > $product->stock) {
            return back()->with('error', 'Stok tidak cukup.');
        }

        $cart->update([
            'quantity' => $request->quantity
        ]);

        return back()->with('success', 'Jumlah berhasil diperbarui.');
    }

    /**
     * Hapus item cart
     */
    public function remove($id)
    {
        Cart::where('user_id', auth()->id())
            ->where('id', $id)
            ->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    /**
     * Hapus seluruh cart
     */
    public function clear()
    {
        Cart::where('user_id', auth()->id())->delete();

        return back()->with('success', 'Keranjang dikosongkan.');
    }
}
