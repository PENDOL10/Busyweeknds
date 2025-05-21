<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe.store');

// Route shop
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/shop/product/{id}', [HomeController::class, 'show'])->name('product.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/account-dashboard', [UserController::class, 'index'])->name('customer-user.index');
    Route::patch('/account/update-password', [UserController::class, 'updatePassword'])->name('account.update-password');
    Route::patch('/account/update-telephone', [UserController::class, 'updateTelephone'])->name('account.update-telephone');
});

Route::middleware(['auth', 'auth.admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});
Route::post('/logout', function () { 
        Auth::logout(); 
    return redirect()->route('index'); 
})->name('logout')->middleware('auth');