<?php
namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required',
        ]);

        \App\Models\Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'qty' => $request->qty,
        ]);

        return back()->with('success', 'Produk ditambahkan ke keranjang!');
    }
}