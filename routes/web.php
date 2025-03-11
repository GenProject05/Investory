<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\InvestmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');


Route::get('/investments', [InvestmentController::class, 'index'])->name('investments.index');



// Route::get('/user/login', function () {
//     return view('user.login');
// });

// Route::get('/user/register', function () {
//     return view('user.register');
// });


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
