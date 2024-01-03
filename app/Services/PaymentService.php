<?php

namespace App\Services;

use App\Models\Accounts;
use App\Models\Transactions;
use App\Models\Transfers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class PaymentService
 */
class PaymentService
{
    private static $instance;

    protected $user;

    /**
     * @return self
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * @param $account_no
     * @param $amount
     * @return mixed
     */
    public function deposit($account_no, $amount)
    {

        $balance_before = $this->user->accounts->balance;
        $balance_after = ($amount + $balance_before);

        $this->UpdateAccount($account_no, $balance_after);

        $transaction = Transactions::create([
            'amount' => $amount,
            'type' => 'debit',
            'account_no' => $account_no,
            'balance_before' => $balance_before,
            'balance_after' => $balance_after,
        ]);
        return $transaction->id;

    }

    /**
     * @param $account_no
     * @param $balance
     * @return void
     */
    public function UpdateAccount($account_no, $balance)
    {

        $account = Accounts::where('account_no', $account_no)->first();

        $account->balance = $balance;
        $account->save();
    }

    /**
     * @param $account_no
     * @param $amount
     * @return mixed
     */
    public function withdraw($account_no, $amount)
    {
        $balance_before = $this->user->accounts->balance;
        $balance_after = ($balance_before - $amount);
        $this->UpdateAccount($account_no, $balance_after);

        $transaction = Transactions::create([
            'amount' => $amount,
            'type' => 'credit',
            'account_no' => $account_no,
            'balance_before' => $balance_before,
            'balance_after' => $balance_after,
        ]);
        return $transaction->id;
    }

    /**
     * @param $said
     * @param $raid
     * @param $tid
     * @param $amount
     * @return mixed
     */
    public function transfers($said, $raid, $tid, $amount)
    {
        return Transfers::create([
            'sender_account_id' => $said,
            'recipient_account_id' => $raid,
            'transaction_id' => $tid,
            'amount' => $amount
        ]);

    }

    /**
     * @param $email
     * @return mixed
     */
    public function createNewUser($email)
    {
        $user = User::create([
            'name' => explode('@', $email)[0] ?? 'dummy',
            'email' => $email,
            'password' => Hash::make('Password'),
        ]);
        return $this->createAccount($user->id);

    }

    /**
     * @param $user_id
     * @return mixed
     * @throws \Exception
     */
    public function createAccount($user_id)
    {
        $account = Accounts::create([
            'balance' => 0,
            'user_id' => $user_id,
            'account_no' => random_int(1000000, 9999999)
        ]);
        return $account;
    }

    /**
     * @param $email
     * @param $amount
     * @return void
     */
    public function transferToAccount($email, $amount)
    {
        $receiver = User::where('email', $email)->first();
        if (!$receiver) {
            $receiver = $this->createNewUser($email);
        }
        $recipient_account = $receiver->accounts;
        $tid = $this->withdraw($this->user->accounts->balance, $amount);
        $this->transfers($this->user->accounts->id, $receiver->accounts->id, $tid, $amount);

        $tid = $this->deposit($recipient_account->account_no, $amount);
        $this->transfers($recipient_account->id, $this->user->accounts->id, $tid, $amount);

    }

}
