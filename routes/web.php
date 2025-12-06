<?php

use Illuminate\Support\Facades\Route;

// Controllers User
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileDashboardController;

// Controllers Payment & Wallet
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\PaymentController;

// Controllers Admin & Seller
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerProductController;

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::middleware(['auth'])->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard Profile
    Route::get('/profile/dashboard', [ProfileDashboardController::class, 'index'])
        ->name('profile.dashboard');

    // History
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::get('/history/{id}', [HistoryController::class, 'show'])->name('history.show');

    // Wallet (Topup)
    Route::get('/wallet/topup', [WalletController::class, 'topup'])->name('wallet.topup');
    Route::post('/wallet/topup', [WalletController::class, 'processTopup'])->name('wallet.topup.process');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    // Payment VA
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');

});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'seller'])
    ->prefix('seller')
    ->name('seller.')
    ->group(function () {

        // Dashboard Seller
        Route::get('/dashboard', [App\Http\Controllers\SellerDashboardController::class, 'index'])
            ->name('dashboard');

        // Profile Toko
        Route::get('/profile', [App\Http\Controllers\SellerProfileController::class, 'index'])
            ->name('profile');

        Route::put('/profile', [App\Http\Controllers\SellerProfileController::class, 'update'])
            ->name('profile.update');

        // Produk Toko
        Route::get('/products', [App\Http\Controllers\SellerProductController::class, 'index'])
            ->name('products.index');

        Route::get('/products/create', [App\Http\Controllers\SellerProductController::class, 'create'])
            ->name('products.create');

        Route::post('/products', [App\Http\Controllers\SellerProductController::class, 'store'])
            ->name('products.store');

        Route::get('/products/{id}/edit', [App\Http\Controllers\SellerProductController::class, 'edit'])
            ->name('products.edit');

        Route::put('/products/{id}', [App\Http\Controllers\SellerProductController::class, 'update'])
            ->name('products.update');

        Route::delete('/products/{id}', [App\Http\Controllers\SellerProductController::class, 'destroy'])
            ->name('products.destroy');

        // Pesanan Masuk
        Route::get('/orders', [App\Http\Controllers\SellerOrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/{id}', [App\Http\Controllers\SellerOrderController::class, 'show'])
            ->name('orders.show');

        Route::put('/orders/{id}/status', [App\Http\Controllers\SellerOrderController::class, 'updateStatus'])
            ->name('orders.updateStatus');

        // Saldo Toko
        Route::get('/balance', [App\Http\Controllers\SellerBalanceController::class, 'index'])
            ->name('balance.index');

        // Withdraw
        Route::get('/withdrawals', [App\Http\Controllers\SellerWithdrawController::class, 'index'])
            ->name('withdraw.index');

        Route::post('/withdrawals', [App\Http\Controllers\SellerWithdrawController::class, 'store'])
            ->name('withdraw.store');

        Route::get('/profile', [SellerProfileController::class, 'index'])
            ->name('profile');

        Route::put('/profile', [SellerProfileController::class, 'update'])
            ->name('profile.update');
});

// CART
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');


require __DIR__.'/auth.php';
