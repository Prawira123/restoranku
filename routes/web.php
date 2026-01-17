<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\DashboardController;

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
Route::post('/menu/checkout/store', [MenuController::class, 'checkout_store'])->name('menu.checkout.store');
Route::get('/menu/success/{orderId}', [MenuController::class, 'success'])->name('menu.success');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::resource('admin/categories', App\Http\Controllers\CategoryController::class);
Route::resource('admin/items', App\Http\Controllers\ItemController::class);
Route::get('admin/items/status/change/{id}', [App\Http\Controllers\ItemController::class, 'changeStatus'])->name('items.status.change');
Route::resource('admin/orders', App\Http\Controllers\OrderController::class);
Route::resource('admin/users', App\Http\Controllers\UserController::class);
Route::resource('admin/order-items', App\Http\Controllers\OrderItemController::class);
Route::resource('admin/roles', App\Http\Controllers\RoleController::class);

