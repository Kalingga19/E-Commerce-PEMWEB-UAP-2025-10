<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\VirtualAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    // ========================================================
    // TAMPILKAN HALAMAN CHECKOUT
    // ========================================================
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product.images')
            ->get();

        if ($cartItems->count() === 0) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang kosong.');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('pages.checkout', [
            'cartItems' => $cartItems,
            'subtotal'  => $subtotal,
        ]);
    }


    // ========================================================
    // PROSES CHECKOUT
    // ========================================================
    public function process(Request $request)
    {
        $request->validate([
            'receiver_name'  => 'required',
            'address'        => 'required',
            'city'           => 'required',
            'postal_code'    => 'required',
            'phone'          => 'required',
            'shipping_method'=> 'required',
            'shipping_cost'  => 'required|numeric',
            'payment_method' => 'required|in:wallet,va',
        ]);

        $cart = Cart::where('user_id', auth()->id())->get();

        if ($cart->count() === 0) {
            return back()->with('error', 'Keranjang kosong.');
        }

        // Hitung subtotal
        $subtotal = $cart->sum(fn ($c) => $c->quantity * $c->product->price);

        $grandTotal = $subtotal + $request->shipping_cost;

        // Tentukan store_id (karena sistemmu marketplace single-store per item)
        $storeId = $cart->first()->product->store_id;

        // ========================================================
        // BUAT TRANSAKSI
        // ========================================================
        $transaction = Transaction::create([
            'code'              => 'TRX-' . time() . '-' . rand(100, 999),
            'buyer_id'          => auth()->id(),
            'store_id'          => $storeId,
            'address'           => $request->address,
            'address_id'        => 'N/A',
            'city'              => $request->city,
            'postal_code'       => $request->postal_code,
            'shipping'          => $request->shipping_method,
            'shipping_type'     => $request->shipping_method,
            'shipping_cost'     => $request->shipping_cost,
            'tracking_number'   => null,
            'tax'               => 0,
            'grand_total'       => $grandTotal,
            'payment_status'    => 'unpaid',
            'status'            => 'pending',
            'payment_method'    => $request->payment_method,
        ]);

        // ========================================================
        // BUAT DETAIL TRANSAKSI
        // ========================================================
        foreach ($cart as $item) {

            // Kurangi stok dulu
            $item->product->decrement('stock', $item->quantity);

            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id'     => $item->product_id,
                'qty'            => $item->quantity,
                'subtotal'       => $item->quantity * $item->product->price,
            ]);
        }

        // ========================================================
        // HAPUS CART
        // ========================================================
        Cart::where('user_id', auth()->id())->delete();


        // ========================================================
        // METODE BAYAR: WALLET
        // ========================================================
        if ($request->payment_method === 'wallet') {

            if (auth()->user()->balance < $grandTotal) {
                return back()->with('error', 'Saldo tidak cukup untuk pembayaran.');
            }

            // Kurangi saldo
            auth()->user()->decrement('balance', $grandTotal);

            $transaction->payment_status = 'paid';
            $transaction->paid_at = now();
            $transaction->save();

            return redirect()->route('customer.orders.detail', $transaction->id)
                ->with('success', 'Pembayaran berhasil menggunakan saldo!');
        }


        // ========================================================
        // METODE BAYAR: VIRTUAL ACCOUNT
        // ========================================================
        $vaCode = "VA-" . auth()->id() . "-" . time();

        VirtualAccount::create([
            'va_code'        => $vaCode,
            'type'           => 'purchase',
            'user_id'        => auth()->id(),
            'transaction_id' => $transaction->id,
            'amount'         => $grandTotal,
        ]);

        return redirect()->route('payment.page', ['va_code' => $vaCode])
            ->with('success', 'Virtual Account berhasil dibuat.');
    }
}
