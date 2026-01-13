<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::get('/', function () {
    return redirect()->route('menu');
});

Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/menu/cart', [MenuController::class, 'cart_view'])->name('menu.cart');
Route::post('/menu/cart/add', [MenuController::class, 'addToCart'])->name('menu.cart.add');
Route::get('/menu/cart/clear', [MenuController::class, 'clearCart'])->name('menu.cart.clear');
Route::post('/menu/cart/update', [MenuController::class, 'updateCart'])->name('menu.cart.update');
Route::post('/menu/cart/delete', [MenuController::class, 'removeCart'])->name('menu.cart.delete');
Route::get('/menu/checkout', [MenuController::class, 'checkout_view'])->name('menu.checkout');
