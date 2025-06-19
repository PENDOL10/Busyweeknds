<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\OrderAdminController;
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
    Route::get('/about', [HomeController::class, 'about'])->name('about');
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
Route::middleware(\App\Http\Middleware\AuthUser::class)->get('/customer-user/index', [UserController::class, 'index'])->name('customer-user.index');

// Admin routes (for ADM role)
Route::prefix('admin')->middleware(['auth', 'auth.admin'])->name('admin.')->group(function () {
    // Route utama admin yang redirect ke dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('index');
    
    // Route dashboard admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Profile route
    Route::get('/profile', [AdminDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [AdminDashboardController::class, 'updateProfile'])->name('profile.update');
    
    // Resource routes untuk management
    Route::resource('users', UserAdminController::class)->except(['create', 'store', 'edit', 'update']);
    Route::post('/users/{user}/suspend', [UserAdminController::class, 'suspend'])->name('users.suspend');
    Route::post('/users/{user}/activate', [UserAdminController::class, 'activate'])->name('users.activate');
    Route::get('/dashboard/sales-data', [AdminDashboardController::class, 'getSalesData'])->name('dashboard.sales-data');
    Route::resource('products', ProductAdminController::class);
    Route::resource('orders', OrderAdminController::class)->only(['index', 'show']);
    Route::post('/orders/{order}/status', [OrderAdminController::class, 'updateStatus'])->name('orders.update-status');
});

// Owner routes (for OWN role)
Route::middleware(['auth', 'auth.owner'])->group(function () {
    Route::get('/owner/dashboard', [OwnerController::class, 'index'])->name('owner.index');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');