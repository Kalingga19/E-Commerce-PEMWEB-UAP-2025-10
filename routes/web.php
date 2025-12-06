<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ProfileDashboardController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::view('/welcome', 'welcome')->name('welcome');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/history', [HistoryController::class, 'index'])->name('history');

Route::view('/profile/dashboard', 'profile.dashboard')->name('profile.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::view('/dashboard', 'dashboard')->name('dashboard');
});

Route::view('/components/register', 'components.register')->name('components.register');
Route::view('/components/topup', 'components.topup')->name('components.topup');

Route::view('/modals/register', 'partials.modals.register')->name('modal.register');
Route::view('/modals/topup', 'partials.modals.topup')->name('modal.topup');

Route::get('/profile/dashboard', [ProfileDashboardController::class, 'index'])
    ->middleware('auth')
    ->name('profile.dashboard'
);

Route::middleware(['auth'])->group(function () {

    Route::get('/wallet/topup', [WalletController::class, 'topup'])
        ->name('wallet.topup');

    Route::post('/wallet/topup/process', [WalletController::class, 'processTopup'])
        ->name('wallet.topup.process');
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'seller'])->group(function () {
    Route::post('/seller/products', [SellerProductController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'customer'])->group(function () {
    Route::post('/checkout', [CheckoutController::class, 'create']);
});

require __DIR__.'/auth.php';
