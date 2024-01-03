<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * @param Request $request
     *
     */
    protected $user;
    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function statement(Request $request)
    {
        $account_no = Auth::user()->accounts->account_no;
        $transactions = Transactions::WHERE('account_no', $account_no)->orderByDesc('id')->paginate(5);
        return view('account.index', ['statement' => $transactions]);

    }
}
