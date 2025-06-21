<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    //cart routes
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/delete-multiple', [CartController::class, 'removeMultiple'])->name('cart.removeMultiple');
    Route::get('/cart', [CartController::class, 'getCart'])->name('cart.get');
    Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');



    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/order-tracking', [OrderController::class, 'tracking'])->name('order.tracking');
    Route::post('/order/{orderId}/cancel', [OrderController::class, 'cancelOrder'])->name('order.cancel');
    Route::post('/order/{orderId}/confirm-cancel', [OrderController::class, 'confirmCancelOrder'])->name('order.confirmCancel');
    Route::patch('/order/{id}/shipping', [OrderController::class, 'updateShippingStatus'])->name('order.shipping');
});
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.show');

    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product');

Route::get('/category/{slug}', [CategoryController::class, 'index'])->name('category.show');


// Admin Auth routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users', [\App\Http\Controllers\Admin\AdminController::class, 'users'])->name('admin.users');
        Route::get('/orders', [\App\Http\Controllers\Admin\AdminController::class, 'orders'])->name('admin.orders');
        Route::get('/products', [\App\Http\Controllers\Admin\AdminController::class, 'products'])->name('admin.products');
        Route::delete('/users/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'deleteUser'])->name('admin.users.delete');
        Route::get('/users/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'userDetail'])->name('admin.users.detail');
        Route::get('/users/order/{orderId}', [\App\Http\Controllers\Admin\AdminController::class, 'userOrder'])->name('admin.user.user_order');
        Route::post('/orders/{orderId}/confirm', [\App\Http\Controllers\Admin\AdminController::class, 'confirmOrder'])->name('admin.user.order_confirm');
        Route::post('/orders/{orderId}/reject', [\App\Http\Controllers\Admin\AdminController::class, 'rejectOrder'])->name('admin.user.order_reject');
        Route::delete('/products/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'deleteProduct'])->name('admin.products.delete');
        Route::get('/products/create', [\App\Http\Controllers\Admin\AdminController::class, 'createProduct'])->name('admin.products.create');
        Route::post('/products', [\App\Http\Controllers\Admin\AdminController::class, 'storeProduct'])->name('admin.products.store');
        Route::get('/products/{id}/edit', [\App\Http\Controllers\Admin\AdminController::class, 'editProduct'])->name('admin.products.edit');
        Route::put('/products/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'updateProduct'])->name('admin.products.update');
        Route::post('/admin/order/{id}/shipping', [OrderController::class, 'updateShippingStatus'])->name('admin.user.order_shipping');
    });
});

// Redirect /admin to /admin/login
Route::redirect('/admin', '/admin/login');

require __DIR__.'/auth.php';
