<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'transaction_id',
        'user_id',
        'va_number',
        'bank_code',
        'amount',
        'status',
        'expired_at'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
