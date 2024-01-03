<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_no',
        'amount',
        'type',
        'details',
        'balance_before',
        'balance_after'
    ];
    public function transfer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Transfers','transaction_id');
    }
}
