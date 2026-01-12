<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/menu/cart', [MenuController::class, 'cart_view'])->name('menu.cart');
Route::get('/menu/checkout', [MenuController::class, 'checkout_view'])->name('menu.checkout');