<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product.images')
            ->where('user_id', auth()->id())
            ->get();

        $subtotal = $cartItems->sum(
            fn($item) => $item->quantity * $item->product->price
        );

        return view('pages.cart.index', compact('cartItems', 'subtotal'));
    }


    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required|integer']);

        $cart = Cart::where('user_id', auth()->id())
                ->where('product_id', $request->product_id)
                ->first();

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => 1,
            ]);
        }

        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }


    public function update(Request $request, $id)
    {
        $cart = Cart::where('user_id', auth()->id())->findOrFail($id);

        $cart->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Jumlah diperbarui.');
    }


    public function delete($id)
    {
        $cart = Cart::where('user_id', auth()->id())->findOrFail($id);
        $cart->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
