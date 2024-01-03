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

    public function transaction()
    {
        return $this->belongsTo('App\Models\Transactions', 'transaction_id');
    }

    public function sender()
    {
        return $this->belongsTo('App\Models\Accounts', 'sender_account_id');
    }

    public function recipient()
    {
        return $this->belongsTo('App\Models\Accounts', 'recipient_account_id');
    }
}
