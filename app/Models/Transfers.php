<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfers extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_account_id',
        'recipient_account_id',
        'transaction_id',
        'amount'
    ];
}
