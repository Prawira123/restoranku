<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('menu');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::middleware('auth')->group( function (){
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware(['role:admin,chef,cashier']);
    Route::get('/dashboard/penjualan_perbulan', [DashboardController::class, 'penjualan_perbulan'])->name('dashboard.penjualan-perbulan')->middleware(['role:admin']);

    Route::resource('admin/categories', App\Http\Controllers\CategoryController::class)->middleware(['role:admin']);
    Route::resource('items', App\Http\Controllers\ItemController::class)->middleware(['role:admin,chef,cashier']);
    Route::get('admin/items/status/change/{id}', [App\Http\Controllers\ItemController::class, 'changeStatus'])->name('items.status.change')->middleware(['role:admin']);
    Route::resource('orders', App\Http\Controllers\OrderController::class)->middleware(['role:admin,chef,cashier']);
    Route::resource('admin/users', App\Http\Controllers\UserController::class)->middleware(['role:admin']);
    Route::resource('order-items', App\Http\Controllers\OrderItemController::class)->middleware(['role:admin,chef,cashier']);
    Route::resource('admin/roles', App\Http\Controllers\RoleController::class)->middleware(['role:admin']);

    Route::put('admin/order/cooked_status/{id}', [OrderController::class, 'status_cooked'])->name('order.cooked_status')->middleware(['role:admin,chef']);
    Route::put('admin/order/confirm_status/{id}', [OrderController::class, 'order_confirm'])->name('order.order_confirm')->middleware(['role:admin,cashier']);

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

require __DIR__.'/auth.php';


