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
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Member\CartController;

use App\Http\Controllers\Admin\AdminTransactionController;
use App\Http\Controllers\Admin\AdminWithdrawalController;

use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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
    Route::get('/history/{id}', [HistoryController::class, 'show'])->name('history.show');

    // Wallet Topup
    Route::get('/wallet/topup', [WalletController::class, 'create'])->name('wallet.topup');
    Route::post('/wallet/topup', [WalletController::class, 'store'])->name('wallet.topup.store');

    // PAYMENT PAGE (untuk topup & checkout)
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
    Route::post('/payment', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payment/qris', [PaymentController::class, 'qris'])->name('payment.qris');

    Route::get('/search', [HomeController::class, 'search'])->name('search');
    Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category.filter');
    
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add', [CartController::class, 'add'])->name('add');
        Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
    });
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::patch('/cart/qty/{id}', [CartController::class, 'updateQty'])->name('cart.updateQty');
});

Route::get('/api/wallet/balance', function () {
    $balance = auth()->user()->balance->balance ?? 0;

    return [
        'balance' => $balance,
        'balance_formatted' => 'Rp ' . number_format($balance, 0, ',', '.')
    ];
})->name('api.wallet.balance');

Route::get('/api/wallet/stats', function () {
    $user = auth()->user();

    // Ambil semua topup yang sudah paid
    $topups = \App\Models\VirtualAccount::where('user_id', $user->id)
        ->where('type', 'topup')
        ->where('is_paid', true)
        ->orderBy('created_at', 'desc')
        ->get();

    $last = $topups->first();
    $total = $topups->sum('amount');

    return [
        'last_topup' => $last ? 'Rp ' . number_format($last->amount, 0, ',', '.') : 'Rp 0',
        'last_date'  => $last ? $last->created_at->diffForHumans() : '-',
        'total_topup' => 'Rp ' . number_format($total, 0, ',', '.'),
    ];
})->name('api.wallet.stats');


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
    Route::get('/store/edit', [StoreRegistrationController::class, 'edit'])->name('store.edit');
    Route::put('/store/update', [StoreRegistrationController::class, 'update'])->name('store.update');

    // Step 1
    Route::get('/seller/store/register', [StoreRegistrationController::class, 'create'])->name('seller.store.create');
    Route::post('/seller/store/register', [StoreRegistrationController::class, 'store'])->name('seller.store.store');

    // Step 2 - verifikasi toko
    Route::get('/seller/store/verify', [StoreRegistrationController::class, 'verify'])->name('seller.store.verify');
    Route::post('/seller/store/verify', [StoreRegistrationController::class, 'submitVerification'])->name('seller.store.verify.submit');

    // Step 3 - selesai
    Route::get('/seller/store/complete', [StoreRegistrationController::class, 'complete'])->name('seller.store.complete');

    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])
        ->name('orders.updateStatus');
});

Route::prefix('seller/store')->middleware(['auth'])->group(function () {

    // Step 1 sudah ada: register.store

    Route::get('/verify', [StoreRegistrationController::class, 'verify'])
        ->name('store.register.verify');

    Route::post('/verify', [StoreRegistrationController::class, 'verifyStore'])
        ->name('store.register.verify.store');

    Route::get('/completed', [StoreRegistrationController::class, 'completed'])
        ->name('store.register.completed');
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
    Route::resource('categories', AdminCategoryController::class);

    Route::resource('products', \App\Http\Controllers\Admin\AdminProductController::class);
    Route::patch('products/{product}/suspend', [\App\Http\Controllers\Admin\AdminProductController::class, 'suspend'])
        ->name('products.suspend');
    Route::patch('products/{product}/activate', [\App\Http\Controllers\Admin\AdminProductController::class, 'activate'])
        ->name('products.activate');

    // Transactions
    Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{id}', [AdminTransactionController::class, 'show'])->name('transactions.show');
    Route::post('/transactions/{id}/approve', [AdminTransactionController::class, 'approve'])->name('transactions.approve');
    Route::post('/transactions/{id}/reject', [AdminTransactionController::class, 'reject'])->name('transactions.reject');
    Route::post('/transactions/{id}/status', [AdminTransactionController::class, 'updateStatus'])->name('transactions.updateStatus');

    // Withdrawals
    Route::get('/withdrawals', [AdminWithdrawalController::class, 'index'])->name('withdrawals.index');
    Route::get('/withdrawals/{id}', [AdminWithdrawalController::class, 'show'])->name('withdrawals.show');
    Route::post('/withdrawals/{id}/approve', [AdminWithdrawalController::class, 'approve'])->name('withdrawals.approve');
    Route::post('/withdrawals/{id}/reject', [AdminWithdrawalController::class, 'reject'])->name('withdrawals.reject');
});

require __DIR__.'/auth.php';
