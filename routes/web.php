<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/user/login', function () {
    return view('user.login');
});

Route::get('/user/register', function () {
    return view('user.register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
