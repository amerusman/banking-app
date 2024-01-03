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
        'balance_before',
        'balance_after'
    ];

    public function transfer()
    {
        return $this->hasOne('App\Models\Transfers', 'transaction_id');
    }

    public function getTransactionDetails()
    {
        $type = [
            'debit' => ['Transfer to', 'recipient', 'Withdraw'],
            'credit' => ['Transfer from', 'sender', 'Deposit']
        ];
        if (optional($this->transfer)->id) {
            return $type[$this->type][0] . ' ' . $this->transfer->{$type[$this->type][1]}->user->name . ' (' . $this->transfer->{$type[$this->type][1]}->account_no . ')';
        } else {
            return $type[$this->type][2];
        }
    }
}
