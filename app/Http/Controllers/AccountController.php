<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function statement(Request $request)
    {
        $account_no = Auth::user()->accounts->account_no;
        $transactions = Transactions::WHERE('account_no', $account_no)->orderByDesc('id')->paginate(7);
        return view('account.index', ['statement' => $transactions]);

    }
}
