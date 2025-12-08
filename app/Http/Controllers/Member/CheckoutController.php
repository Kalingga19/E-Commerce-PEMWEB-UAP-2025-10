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
    public function index()
    {
        return view('customer.checkout.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'shipping_type' => 'required',
            'shipping_cost' => 'required|numeric',
            'payment_method' => 'required',
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $product = Product::findOrFail($request->product_id);

        $subtotal = $product->price * $request->qty;
        $grand_total = $subtotal + $request->shipping_cost;

        // 1. SIMPAN TRANSAKSI
        $transaction = Transaction::create([
            'code' => 'TRX' . rand(100000, 999999),
            'buyer_id' => $user->id,
            'store_id' => $product->store_id,
            'address' => $request->address,
            'address_id' => 'ADDR001',
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'shipping' => 'CUSTOM',
            'shipping_type' => $request->shipping_type,
            'shipping_cost' => $request->shipping_cost,
            'tracking_number' => '',
            'tax' => 0,
            'grand_total' => $grand_total,
            'payment_status' => 'unpaid',
        ]);

        // 2. SIMPAN TRANSACTION DETAILS
        TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'product_id' => $product->id,
            'qty' => $request->qty,
            'subtotal' => $subtotal,
        ]);

        // 3. JIKA METODE BAYAR VIA VA, BUAT VA
        if ($request->payment_method === 'va') {
            $va_code = "VA-" . rand(100000, 999999);

            VirtualAccount::create([
                'user_id' => $user->id,
                'transaction_id' => $transaction->id,
                'va_code' => $va_code,
                'amount' => $grand_total,
                'type' => 'transaction',
                'is_paid' => false,
            ]);

            return redirect()->route('payment')->with('success', 'VA berhasil dibuat: ' . $va_code);
        }

        // 4. BAYAR MENGGUNAKAN SALDO
        if ($request->payment_method === 'wallet') {
            if ($user->balance->balance < $grand_total) {
                return back()->with('error', 'Saldo tidak cukup');
            }

            // Kurangi saldo user
            $user->balance->balance -= $grand_total;
            $user->balance->save();

            // Tandai sebagai paid
            $transaction->payment_status = 'paid';
            $transaction->save();

            return redirect()->route('history')->with('success', 'Pembayaran berhasil!');
        }
        return redirect()->route('payment')->with('success', 'Silakan lakukan pembayaran.');
    }
}
