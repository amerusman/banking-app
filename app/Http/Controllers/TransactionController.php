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

    /**
     * @param Request $request
     * @return View
     */
    public function depositForm(Request $request): View
    {
        return view('deposit.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function withdrawForm(Request $request): View
    {
        return view('withdraw.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function depositStore(Request $request): RedirectResponse
    {

        $request->validate([
            'amount' => 'required',
        ]);
        PaymentService::getInstance()->deposit(Auth::user()->accounts->account_no, $request->amount);

        return redirect(RouteServiceProvider::DEPOSIT);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function withdrawStore(Request $request): RedirectResponse
    {
        $request->validate([
            'amount' => 'required',
        ]);
        PaymentService::getInstance()->withdraw(Auth::user()->accounts->account_no, $request->amount);
        return redirect(RouteServiceProvider::WITHDRAW);
    }
}
