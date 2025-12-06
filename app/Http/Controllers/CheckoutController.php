<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\VirtualAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    /**
     * Halaman checkout
     */
    public function index()
    {
        $user = auth()->user();

        $cartItems = Cart::where('user_id', $user->id)
                        ->with('product.store')
                        ->get();

        if ($cartItems->count() == 0) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('pages.checkout', compact('cartItems', 'subtotal'));
    }


    /**
     * PROSES CHECKOUT
     */
    public function process(Request $request)
    {
        $request->validate([
            'receiver_name'  => 'required',
            'address'        => 'required',
            'city'           => 'required',
            'postal_code'    => 'required',
            'phone'          => 'required',
            'payment_method' => 'required|in:wallet,va',
            'total_amount'   => 'required|numeric',
        ]);

        $user = auth()->user();

        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->count() == 0) {
            return back()->with('error', 'Keranjang kosong!');
        }

        // Ambil store ID dari produk pertama
        $store_id = $cartItems->first()->product->store_id;

        // Buat kode transaksi unik
        $transaction_code = 'TRX-' . strtoupper(Str::random(10));

        // Buat TRANSACTION
        $transaction = Transaction::create([
            'code'          => $transaction_code,
            'buyer_id'      => $user->id,
            'store_id'      => $store_id,
            'address'       => $request->address,
            'address_id'    => '-',
            'city'          => $request->city,
            'postal_code'   => $request->postal_code,
            'shipping'      => $request->shipping_method,
            'shipping_type' => $request->shipping_method,
            'shipping_cost' => $request->shipping_cost,
            'tax'           => 0,
            'grand_total'   => $request->total_amount,
            'payment_status'=> 'unpaid',
        ]);

        // SIMPAN DETAIL TRANSAKSI
        foreach ($cartItems as $item) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id'     => $item->product_id,
                'qty'            => $item->quantity,
                'subtotal'       => $item->quantity * $item->product->price
            ]);

            // Kurangi stok
            $item->product->decrement('stock', $item->quantity);
        }

        // HAPUS KERANJANG
        Cart::where('user_id', $user->id)->delete();


        /**
         * 🔥 PAYMENT METODE 1 — WALLET
         */
        if ($request->payment_method === 'wallet') {
            if ($user->balance < $request->total_amount) {
                return back()->with('error', 'Saldo tidak cukup!');
            }

            $user->balance -= $request->total_amount;
            $user->save();

            $transaction->payment_status = 'paid';
            $transaction->save();

            return redirect()->route('history')->with('success', 'Transaksi berhasil dibayar dengan saldo!');
        }


        /**
         * 🔥 PAYMENT METODE 2 — VIRTUAL ACCOUNT
         */
        $va_code = 'PAY-' . $transaction->id . '-' . time();

        VirtualAccount::create([
            'va_code'        => $va_code,
            'type'           => 'purchase',
            'user_id'        => $user->id,
            'transaction_id' => $transaction->id,
            'amount'         => $transaction->grand_total,
            'status'         => 'pending',
        ]);

        return redirect()->route('payment.index', ['va_code' => $va_code]);
    }
}
