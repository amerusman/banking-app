<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransferController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    ///////////
    Route::post('/account', [AccountController::class, 'index']);
    Route::get('/statement', [AccountController::class, 'statement'])->name('statement');


    Route::get('/deposit', [TransactionController::class, 'depositForm'])->name('deposit');
    Route::get('/withdraw', [TransactionController::class, 'withdrawForm'])->name('withdraw');;
    Route::post('/deposit.store', [TransactionController::class, 'depositStore'])->name('deposit.store');
    Route::post('/withdraw.store', [TransactionController::class, 'withdrawStore'])->name('withdraw.store');

    Route::get('/transfer', [TransferController::class, 'transferForm'])->name('transfer');
    Route::post('/transfer.store', [TransferController::class, 'store'])->name('transfer.store');

});

require __DIR__.'/auth.php';
