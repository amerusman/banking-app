<?php

namespace App\Http\Controllers;


use App\Providers\RouteServiceProvider;
use App\Services\PaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransactionController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function depositForm(Request $request): View
    {
        return view('deposit.index', [
            'user' => $request->user(),
        ]);
    }

    public function withdrawForm(Request $request): View
    {
        return view('withdraw.index', [
            'user' => $request->user(),
        ]);
    }

    public function depositStore(Request $request): RedirectResponse
    {

        $request->validate([
            'amount' => 'required',
        ]);
        PaymentService::getInstance()->deposit($this->user->accounts->account_no, $request->amount);

        return redirect(RouteServiceProvider::DEPOSIT);
    }

    public function withdrawStore(Request $request): RedirectResponse
    {
        $request->validate([
            'amount' => 'required',
        ]);
        PaymentService::getInstance()->withdraw($this->user->accounts->account_no, $request->amount);
        return redirect(RouteServiceProvider::WITHDRAW);
    }
}
