<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // =====================================================
    // TAMPILKAN CART
    // =====================================================
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        $cartItems = $cart->items()->with('product.images')->get();

        return view('pages.cart', compact('cartItems'));
    }

    // =====================================================
    // ADD PRODUCT TO CART
    // =====================================================
    public function add(Request $request, $product_id)
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product_id)
            ->first();

        if ($item) {
            $item->quantity += 1;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product_id,
                'quantity' => 1
            ]);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Produk ditambahkan ke keranjang!');
    }

    // =====================================================
    // UPDATE ITEM QUANTITY
    // =====================================================
    public function update(Request $request, $item_id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $item = CartItem::findOrFail($item_id);

        $item->quantity = $request->quantity;
        $item->save();

        return back()->with('success', 'Keranjang diperbarui!');
    }

    // =====================================================
    // REMOVE ITEM FROM CART
    // =====================================================
    public function remove($item_id)
    {
        CartItem::findOrFail($item_id)->delete();

        return back()->with('success', 'Item dihapus dari keranjang.');
    }
}
