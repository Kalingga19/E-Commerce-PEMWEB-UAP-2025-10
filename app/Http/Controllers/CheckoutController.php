<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\VirtualAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->count() === 0) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang Anda kosong.');
        }

        $subtotal = $cartItems->sum(fn($item) =>
            $item->quantity * $item->product->price
        );

        return view('pages.checkout', compact('cartItems', 'subtotal'));
    }
        public function process(Request $request)
    {
        $request->validate([
            'receiver_name' => 'required',
            'address'       => 'required',
            'city'          => 'required',
            'postal_code'   => 'required',
            'phone'         => 'required',
            'shipping_method' => 'required',
            'shipping_cost'   => 'required|numeric',
            'payment_method'  => 'required'
        ]);

        $user = auth()->user();

        // Ambil cart
        $cartItems = Cart::with('product.store')
            ->where('user_id', $user->id)
            ->get();

        if ($cartItems->count() === 0) {
            return back()->with('error', 'Keranjang kosong.');
        }

        // semua produk harus dari 1 toko
        $store = $cartItems->first()->product->store;

        $subtotal = $cartItems->sum(fn($i) => $i->quantity * $i->product->price);
        $grandTotal = $subtotal + $request->shipping_cost;

        DB::beginTransaction();

        try {

            // =============================
            // CREATE TRANSACTION
            // =============================
            $transaction = Transaction::create([
                'code'            => strtoupper(Str::random(10)),
                'buyer_id'        => $user->id,
                'store_id'        => $store->id,
                'address'         => $request->address,
                'address_id'      => now()->timestamp,
                'city'            => $request->city,
                'postal_code'     => $request->postal_code,
                'shipping'        => $request->shipping_method,
                'shipping_type'   => $request->shipping_method,
                'shipping_cost'   => $request->shipping_cost,
                'tracking_number' => null,
                'tax'             => 0,
                'grand_total'     => $grandTotal,
                'payment_status'  => 'unpaid',
            ]);

            // =============================
            // DETAILS
            // =============================
            foreach ($cartItems as $item) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id'     => $item->product_id,
                    'qty'            => $item->quantity,
                    'subtotal'       => $item->quantity * $item->product->price,
                ]);

                // kurangi stok
                $item->product->decrement('stock', $item->quantity);
            }

            // =============================
            // PAYMENT METHOD
            // =============================

            // 1. WALLET
            if ($request->payment_method === 'wallet') {

                if ($user->balance < $grandTotal) {
                    return back()->with('error', 'Saldo tidak mencukupi.');
                }

                $user->balance -= $grandTotal;
                $user->save();

                $transaction->payment_status = 'paid';
                $transaction->save();

            }

            // 2. VA (create virtual account)
            else {

                VirtualAccount::create([
                    'va_code'        => "PAY-{$transaction->id}-" . time(),
                    'type'           => 'purchase',
                    'user_id'        => $user->id,
                    'transaction_id' => $transaction->id,
                    'amount'         => $grandTotal,
                    'status'         => 'pending',
                ]);
            }

            // =============================
            // CLEAR CART
            // =============================
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }

        // =============================
        // REDIRECT
        // =============================
        if ($request->payment_method === 'wallet') {
            return redirect()->route('customer.orders')
                ->with('success', 'Pesanan berhasil dibuat!');
        }

        return redirect()->route('payment.index', ['va_code' => "PAY-{$transaction->id}-" . time()]);
    }
}
