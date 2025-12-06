<?php

use Illuminate\Support\Facades\Route;

// Controllers User
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileDashboardController;
use App\Http\Controllers\CustomerOrderController;

// Controllers Payment & Wallet
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\PaymentController;

// Controllers Admin & Seller
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerProductController;
use App\Http\Controllers\SellerProfileController;
use App\Http\Controllers\ProfileDashboardController as SellerDashboardController;


Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');

// Homepage
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

// Category page
Route::get('/category/{slug}', [\App\Http\Controllers\CategoryController::class, 'show'])
    ->name('category.show');


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

    // Payment VA
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('/payment/{transactionId}', [PaymentController::class, 'showForTransaction'])->name('payment.page');
    Route::post('/payment/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/add/{product_id}', [\App\Http\Controllers\CartController::class, 'add'])
        ->name('cart.add');

    Route::post('/cart/update/{item_id}', [\App\Http\Controllers\CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/remove/{item_id}', [\App\Http\Controllers\CartController::class, 'remove'])
        ->name('cart.remove');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Users
        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])
            ->name('users.index');

        // Stores
        Route::get('/stores', [\App\Http\Controllers\Admin\StoreController::class, 'index'])
            ->name('stores.index');
        Route::post('/stores/{id}/verify', [\App\Http\Controllers\Admin\StoreController::class, 'verify'])
            ->name('stores.verify');

        // Categories
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);

        // Products
        Route::get('/products', [\App\Http\Controllers\Admin\ProductController::class, 'index'])
            ->name('products.index');

        // Transactions
        Route::get('/transactions', [\App\Http\Controllers\Admin\TransactionController::class, 'index'])
            ->name('transactions.index');
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
        Route::get('/orders', [\App\Http\Controllers\SellerOrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/{id}', [\App\Http\Controllers\SellerOrderController::class, 'show'])
            ->name('orders.show');

        Route::put('/orders/{id}/status', [\App\Http\Controllers\SellerOrderController::class, 'updateStatus'])
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

Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/orders', [\App\Http\Controllers\CustomerOrderController::class, 'index'])
        ->name('customer.orders');

        Route::get('/orders/{id}', [\App\Http\Controllers\CustomerOrderController::class, 'detail'])
            ->name('customer.orders.detail');

        Route::post('/orders/{id}/complete', [\App\Http\Controllers\CustomerOrderController::class, 'complete'])
            ->name('customer.orders.complete');

        Route::post('/orders/{id}/review', [\App\Http\Controllers\CustomerOrderController::class, 'review'])
            ->name('customer.orders.review');

        Route::delete('/orders/{id}/cancel', [\App\Http\Controllers\CustomerOrderController::class, 'cancel'])
            ->name('customer.orders.cancel');
});

Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {

    // daftar pesanan
    Route::get('/orders', [CustomerOrderController::class, 'index'])
        ->name('orders');

    // detail pesanan
    Route::get('/orders/{id}', [CustomerOrderController::class, 'detail'])
        ->name('orders.detail');

    // konfirmasi pesanan diterima
    Route::post('/orders/{id}/complete', [CustomerOrderController::class, 'complete'])
        ->name('orders.complete');

    // beri ulasan
    Route::post('/orders/{id}/review', [CustomerOrderController::class, 'review'])
        ->name('orders.review');

    // batalkan pesanan
    Route::delete('/orders/{id}/cancel', [CustomerOrderController::class, 'cancel'])
        ->name('orders.cancel');
});


require __DIR__.'/auth.php';
