<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\PaymentService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function transferForm(Request $request)
    {
        $user = User::get();
        return view('transfer.index', [
            'user' => $user
        ]);

    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'amount' => 'required',
            'email' => 'required',
        ]);
        PaymentService::getInstance()->transferToAccount($request->email, $request->amount);
        return redirect(RouteServiceProvider::TRANSFER);

    }
}
