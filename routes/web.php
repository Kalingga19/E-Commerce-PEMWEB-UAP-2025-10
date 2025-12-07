<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']);
    Route::resource('/admin/categories', AdminCategoryController::class);
    Route::resource('/admin/users', AdminUserController::class);
    Route::get('/admin/verification', [StoreVerificationController::class, 'index']);
});

Route::middleware(['seller'])->group(function () {
    Route::get('/seller/dashboard', [SellerDashboardController::class, 'index']);
    Route::resource('/seller/products', SellerProductController::class);
    Route::resource('/seller/categories', SellerCategoryController::class);
    Route::resource('/seller/orders', SellerOrderController::class);
    Route::resource('/seller/withdrawals', SellerWithdrawalController::class);
});

Route::middleware(['member'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/checkout', [CheckoutController::class, 'store']);
    Route::get('/history', [HistoryController::class, 'index']);
    Route::get('/wallet/topup', [WalletController::class, 'create']);
    Route::post('/wallet/topup', [WalletController::class, 'store']);
});

Route::middleware(['member'])->group(function () {
    Route::get('/store/register', [StoreRegistrationController::class, 'create']);
    Route::post('/store/register', [StoreRegistrationController::class, 'store']);
});

require __DIR__.'/auth.php';
