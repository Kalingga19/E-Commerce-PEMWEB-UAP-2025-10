<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'code',
        'buyer_id',
        'store_id',
        'address',
        'address_id',
        'city',
        'postal_code',
        'shipping',
        'shipping_type',
        'shipping_cost',
        'tracking_number',
        'tax',
        'grand_total',
        'payment_status',
        'order_status',
        'payout_status'
    ];

    protected $casts = [
        'shipping_cost' => 'decimal:2',
        'tax' => 'decimal:2',
        'grand_total' => 'decimal:2',
    ];

    // PEMBELI
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    // TOKO
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    // DETAIL TRANSAKSI
    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }
    
}
