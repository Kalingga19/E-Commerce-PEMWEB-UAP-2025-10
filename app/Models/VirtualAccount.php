<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VirtualAccount extends Model
{
    protected $fillable = [
        'user_id',
        'transaction_id',
        'amount',
        'va_code',
        'is_paid',
        'type',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'is_paid' => 'boolean',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke transaksi (kalau VA untuk checkout)
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
