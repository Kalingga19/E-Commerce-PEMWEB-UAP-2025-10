<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Member\ProductController;

use App\Http\Controllers\Member\CheckoutController;
use App\Http\Controllers\Member\HistoryController;
use App\Http\Controllers\Member\WalletController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Seller\StoreRegistrationController;

use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\ProductController as SellerProductController;
use App\Http\Controllers\Seller\OrderController;
use App\Http\Controllers\Seller\BallanceController;
use App\Http\Controllers\Seller\WithdrawalController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\StoreVerificationController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', function () {
    $user = auth()->user();

    // Admin → redirect ke halaman admin
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // Seller (member yang punya toko & verified)
    if ($user->role === 'member' && $user->store && $user->store->is_verified) {
        return redirect()->route('seller.dashboard');
    }

    // Member biasa (customer)
    return redirect()->route('home'); // ke homepage
})->middleware(['auth'])->name('dashboard');


// Detail produk
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

Route::middleware(['auth', 'member'])->group(function () {

    // Register Store (khusus member)
    Route::get('/store/register', [StoreRegistrationController::class, 'create'])->name('store.register');
    Route::post('/store/register', [StoreRegistrationController::class, 'store'])->name('store.register.store');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store']);

    // History transaksi
    Route::get('/history', [HistoryController::class, 'index'])->name('history');

    // Wallet Topup
    Route::get('/wallet/topup', [WalletController::class, 'create'])->name('wallet.topup');
    Route::post('/wallet/topup', [WalletController::class, 'store'])->name('wallet.topup.store');

    // PAYMENT PAGE (untuk topup & checkout)
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
    Route::post('/payment', [PaymentController::class, 'process'])->name('payment.process');
});

Route::middleware(['auth', 'seller'])->prefix('seller')->name('seller.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Produk
    Route::resource('/products', SellerProductController::class);

    // Pesanan
    Route::resource('/orders', OrderController::class);

    // Saldo toko
    Route::get('/balance', [BallanceController::class, 'index'])->name('balance');

    // Withdrawals
    Route::resource('/withdrawals', WithdrawalController::class);
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Verifikasi toko
    Route::get('/verification', [StoreVerificationController::class, 'index'])->name('verification');
    Route::post('/verification/{store}/approve', [StoreVerificationController::class, 'approve'])->name('verification.approve');
    Route::post('/verification/{store}/reject', [StoreVerificationController::class, 'reject'])->name('verification.reject');

    // Manajemen user
    Route::resource('/users', AdminUserController::class);

    // Manajemen kategori global
    Route::resource('/categories', AdminCategoryController::class);
});

require __DIR__.'/auth.php';
