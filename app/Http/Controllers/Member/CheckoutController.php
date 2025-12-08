<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\VirtualAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $productId = $request->get('product_id');
        $qty = (int) $request->get('qty', 1);

        if ($qty < 1) $qty = 1;

        // ============================
        // 1) MODE BUY NOW
        // ============================
        if ($productId) {
            $product = Product::with('productImages', 'store')->findOrFail($productId);
            $subtotal = $product->price * $qty;

            return view('customer.checkout.index', [
                'balance'   => Auth::user()->balance->balance ?? 0,
                'product'   => $product,
                'qty'       => $qty,
                'subtotal'  => $subtotal,
                'cart'      => null, // BIAR BLADE GAK ERROR
            ]);
        }

        // ============================
        // 2) MODE CHECKOUT DARI CART
        // ============================
        $cartSession = session()->get('cart', []);

        if (empty($cartSession)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang kosong.');
        }

        // Convert session array → object untuk akses product
        $cart = collect($cartSession)->map(function ($item) {
            $product = Product::find($item['product_id']);
            return (object)[
                'product' => $product,
                'qty'     => $item['qty'],
            ];
        });

        $subtotal = $cart->sum(fn($c) => $c->product->price * $c->qty);

        return view('customer.checkout.index', [
            'balance'  => Auth::user()->balance->balance ?? 0,
            'cart'     => $cart,
            'subtotal' => $subtotal,
            'product'  => null, // supaya blade tahu ini bukan buy-now mode
            'qty'      => null
        ]);
    }


    public function store(Request $request)
    {
        // ========== 1. VALIDASI DASAR ==========
        $baseValidation = [
            'address'        => 'required',
            'city'           => 'required',
            'postal_code'    => 'required',
            'shipping_type'  => 'required',
            'shipping_cost'  => 'required|numeric',
            'service_fee'    => 'nullable|numeric',
            'payment_method' => 'required',
        ];

        // Kalau BUY NOW → butuh product_id & qty
        if ($request->product_id) {
            $request->validate(array_merge($baseValidation, [
                'product_id' => 'required|exists:products,id',
                'qty'        => 'required|integer|min:1',
            ]));
        }
        // Kalau checkout dari CART
        else {
            $request->validate($baseValidation);
        }


        $user = Auth::user();
        $serviceFee = $request->service_fee ?? 5000;
        $shipping   = (float) $request->shipping_cost;

        $items = []; // menampung produk yang akan disimpan ke transaksi


        // ========== 2. BUY NOW MODE ==========
        if ($request->product_id) {

            $product = Product::findOrFail($request->product_id);
            $qty     = (int) $request->qty;

            $items[] = [
                'product' => $product,
                'qty'     => $qty,
            ];

            $subtotal = $product->price * $qty;
        }

        // ========== 3. CART MODE (MULTI PRODUK) ==========
        else {

            $cart = session()->get('cart', []);

            if (empty($cart)) {
                return redirect()->route('cart.index')
                    ->with('error', 'Keranjang kosong.');
            }

            foreach ($cart as $c) {
                $items[] = [
                    'product' => Product::find($c['product_id']),
                    'qty'     => $c['qty'],
                ];
            }

            $subtotal = array_sum(
                array_map(fn($i) => $i['product']->price * $i['qty'], $items)
            );
        }


        // ========== 4. HITUNG GRAND TOTAL ==========
        $grand_total = $subtotal + $shipping + $serviceFee;


        // ========== 5. SIMPAN TRANSAKSI ==========
        $transaction = Transaction::create([
            'code'            => 'TRX' . rand(100000, 999999),
            'buyer_id'        => $user->id,
            'store_id'        => $items[0]['product']->store_id,
            'address'         => $request->address,
            'address_id'      => 'ADDR001',
            'city'            => $request->city,
            'postal_code'     => $request->postal_code,
            'shipping'        => 'CUSTOM',
            'shipping_type'   => $request->shipping_type,
            'shipping_cost'   => $shipping,
            'tracking_number' => '',
            'tax'             => $serviceFee,
            'grand_total'     => $grand_total,
            'payment_status'  => 'unpaid',
        ]);


        // ========== 6. SIMPAN TRANSACTION DETAIL ==========
        foreach ($items as $row) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id'     => $row['product']->id,
                'qty'            => $row['qty'],
                'subtotal'       => $row['product']->price * $row['qty'],
            ]);
        }


        // ========== 7. PAYMENT METHOD HANDLING ==========

        // --- Virtual Account ---
        if ($request->payment_method === 'va') {

            $va_code = "VA-" . rand(100000, 999999);

            VirtualAccount::create([
                'user_id'        => $user->id,
                'transaction_id' => $transaction->id,
                'va_code'        => $va_code,
                'amount'         => $grand_total,
                'type'           => 'transaction',
                'is_paid'        => false,
            ]);

            session()->forget('cart'); // hapus keranjang setelah berhasil buat transaksi

            return redirect()->route('payment', ['va' => $va_code]);
        }


        // --- Wallet ---
        if ($request->payment_method === 'wallet') {

            if (!$user->balance || $user->balance->balance < $grand_total) {
                return back()->with('error', 'Saldo tidak cukup.');
            }

            $user->balance->balance -= $grand_total;
            $user->balance->save();

            $transaction->update(['payment_status' => 'paid']);

            session()->forget('cart');

            return redirect()->route('history.show', $transaction->id)
                            ->with('success', 'Pembayaran menggunakan saldo berhasil!');
        }


        // --- QRIS ---
        if ($request->payment_method === 'qris') {

            $qris_code = "QRIS-" . rand(100000, 999999);

            session()->forget('cart');

            return redirect()->route('payment.qris', [
                'trx'  => $transaction->id,
                'code' => $qris_code,
            ]);
        }


        // Fallback
        session()->forget('cart');

        return redirect()->route('payment')
            ->with('success', 'Silakan lanjutkan pembayaran Anda.');
    }

    public function updateQty(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return back()->with('error', 'Produk tidak ditemukan.');
        }

        $qty = max(1, (int)$request->qty); // cegah qty < 1
        $cart[$id]['qty'] = $qty;

        session()->put('cart', $cart);

        return back()->with('success', 'Jumlah produk diperbarui.');
    }

}
