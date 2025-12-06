<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\UserBalance;
use App\Models\VirtualAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // biasanya ada cart, tapi kita sederhanakan:
        if (!$request->product_id) {
            return redirect()->route('products.index')->with('error', 'Tidak ada produk yang dipilih.');
        }

        $product = Product::findOrFail($request->product_id);

        return view('checkout', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'      => 'required|exists:products,id',
            'qty'             => 'required|integer|min:1',
            'address'         => 'required|string',
            'shipping_type'   => 'required|string',
            'payment_method'  => 'required|in:wallet,va',
        ]);

        $product = Product::findOrFail($request->product_id);
        $user    = Auth::user();

        $shipping_cost = match ($request->shipping_type) {
            'regular' => 10000,
            'express' => 20000,
            default   => 15000,
        };

        $subtotal = $product->price * $request->qty;
        $total    = $subtotal + $shipping_cost;

        DB::beginTransaction();

        try {
            // 1. Simpan transaksi
            $transaction = Transaction::create([
                'user_id'        => $user->id,
                'store_id'       => $product->store_id,
                'total_price'    => $total,
                'shipping_type'  => $request->shipping_type,
                'shipping_cost'  => $shipping_cost,
                'address'        => $request->address,
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_method === 'wallet'
                                        ? 'paid'
                                        : 'pending',
                'status'         => 'waiting',
            ]);

            // 2. Simpan detail transaksi
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id'     => $product->id,
                'qty'            => $request->qty,
                'price'          => $product->price,
            ]);

            // 3. Jika bayar pakai wallet → potong saldo
            if ($request->payment_method === 'wallet') {
                $balance = UserBalance::firstOrCreate(
                    ['user_id' => $user->id],
                    ['balance' => 0]
                );

                if ($balance->balance < $total) {
                    DB::rollBack();
                    return back()->with('error', 'Saldo Anda tidak mencukupi.');
                }

                $balance->balance -= $total;
                $balance->save();

                DB::commit();
                return redirect()->route('history')->with('success', 'Pembayaran berhasil memakai saldo.');
            }

            // 4. Jika bayar via VA → generate kode VA
            $va_code = "VA-" . $transaction->id . "-" . time();

            VirtualAccount::create([
                'transaction_id' => $transaction->id,
                'user_id'        => $user->id,
                'va_code'        => $va_code,
                'amount'         => $total,
                'status'         => 'pending',
            ]);

            DB::commit();

            return redirect()->route('payment.show', ['va' => $va_code])
                            ->with('success', 'VA berhasil dibuat.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
