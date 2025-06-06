<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe.store');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/search', [HomeController::class, 'search'])->name('search.products');

// Routes that require authentication
Route::middleware(['auth'])->group(function () {
    // Product detail and checkout routes
    Route::get('/shop/product/{id}', [HomeController::class, 'show'])->name('product.show');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/cart/save-for-checkout', [CheckoutController::class, 'saveCartForCheckout'])->name('cart.save-for-checkout');
    Route::get('/order/success', [CheckoutController::class, 'success'])->name('order.success');

    // Auth check route
    Route::get('/check-auth', [AuthController::class, 'checkAuth'])->name('check.auth');

    // Logout route
    Route::post('/logout', function () {
        Auth::logout();
        return redirect()->route('index');
    })->name('logout');
});

// User routes (for USR role)
Route::middleware(['auth', 'auth.user'])->group(function () {
    Route::get('/account-dashboard', [UserController::class, 'index'])->name('customer-user.index');
    Route::patch('/account/update-password', [UserController::class, 'updatePassword'])->name('account.update-password');
    Route::patch('/account/update-telephone', [UserController::class, 'updateTelephone'])->name('account.update-telephone');
});
Route::middleware(\App\Http\Middleware\AuthUser::class)->get('/customer-user/dashboard', [UserController::class, 'index'])->name('customer-user.index');


// Admin routes (for ADM role)
Route::middleware(['auth', 'auth.admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
});
Route::middleware(\App\Http\Middleware\AuthAdmin::class)->get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');

// Owner routes (for OWN role)
Route::middleware(['auth', 'auth.owner'])->group(function () {
    Route::get('/owner/dashboard', [AdminController::class, 'ownerDashboard'])->name('owner.index');
});

