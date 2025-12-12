<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Member\ProductController;
use App\Http\Controllers\Member\ProductCatalogController;
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
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Member\CartController;

use App\Http\Controllers\Admin\AdminTransactionController;
use App\Http\Controllers\Admin\AdminWithdrawalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\ProfileController;


/*
|--------------------------------------------------------------------------
| PROFILE ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| HOME / DASHBOARD
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role === 'member' && $user->store && $user->store->is_verified) {
        return redirect()->route('seller.dashboard');
    }

    return redirect()->route('home');
})->middleware(['auth'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| PUBLIC PRODUCT DETAIL
|--------------------------------------------------------------------------
*/
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/products', [ProductCatalogController::class, 'index'])->name('products.index');


/*
|--------------------------------------------------------------------------
| MEMBER ROUTES (Customer)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'member'])->group(function () {

    // Register Store
    Route::get('/store/register', [StoreRegistrationController::class, 'create'])->name('store.register');
    Route::post('/store/register', [StoreRegistrationController::class, 'store'])->name('store.register.store');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store']);

    // History
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::get('/history/{id}', [HistoryController::class, 'show'])->name('history.show');

    Route::get('/wallet/topup', [WalletController::class, 'create'])->name('wallet.topup');
    Route::post('/wallet/topup', [WalletController::class, 'store'])->name('wallet.topup.store');

    // Payment
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
    Route::post('/payment', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payment/qris', [PaymentController::class, 'qris'])->name('payment.qris');

    // Search & Category
    Route::get('/search', [HomeController::class, 'search'])->name('search');
    Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category.filter');

    // Cart
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add', [CartController::class, 'add'])->name('add');
        Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
    });

    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::patch('/cart/qty/{id}', [CartController::class, 'updateQty'])->name('cart.updateQty');
});


/*
|--------------------------------------------------------------------------
| API WALLET (AJAX)
|--------------------------------------------------------------------------
*/
Route::get('/api/wallet/balance', function () {
    $balance = auth()->user()->balance->balance ?? 0;

    return [
        'balance' => $balance,
        'balance_formatted' => 'Rp ' . number_format($balance, 0, ',', '.')
    ];
})->name('api.wallet.balance');

Route::get('/api/wallet/stats', function () {
    $user = auth()->user();

    $topups = \App\Models\VirtualAccount::where('user_id', $user->id)
        ->where('type', 'topup')
        ->where('is_paid', true)
        ->orderBy('created_at', 'desc')
        ->get();

    $last = $topups->first();
    $total = $topups->sum('amount');

    return [
        'last_topup'  => $last ? 'Rp ' . number_format($last->amount, 0, ',', '.') : 'Rp 0',
        'last_date'   => $last ? $last->created_at->diffForHumans() : '-',
        'total_topup' => 'Rp ' . number_format($total, 0, ',', '.'),
    ];
})->name('api.wallet.stats');



/*
|--------------------------------------------------------------------------
| SELLER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Produk CRUD
    Route::resource('/products', SellerProductController::class);

    // Hapus foto produk (WAJIB)
    Route::delete('/products/images/{id}', [SellerProductController::class, 'deleteImage'])
        ->name('products.images.delete');

    Route::delete('/seller/products/images/{id}', 
        action: [SellerProductController::class, 'deleteImage']
    )->name('seller.products.images.delete');

    // Pesanan
    Route::resource('/orders', OrderController::class);

    // Saldo Toko
    Route::get('/balance', [BallanceController::class, 'index'])->name('balance');

    Route::resource('/withdrawals', WithdrawalController::class);

    // Edit Store
    Route::get('/store/edit', [StoreRegistrationController::class, 'edit'])->name('store.edit');
    Route::put('/store/update', [StoreRegistrationController::class, 'update'])->name('store.update');

    // Register Store Steps
    Route::get('/seller/store/register', [StoreRegistrationController::class, 'create'])->name('seller.store.create');
    Route::post('/seller/store/register', [StoreRegistrationController::class, 'store'])->name('seller.store.store');

    Route::get('/seller/store/verify', [StoreRegistrationController::class, 'verify'])->name('seller.store.verify');
    Route::post('/seller/store/verify', [StoreRegistrationController::class, 'submitVerification'])->name('seller.store.verify.submit');

    Route::get('/seller/store/complete', [StoreRegistrationController::class, 'complete'])->name('seller.store.complete');

    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

Route::get('/orders', [OrderController::class, 'customerIndex'])->name('orders.customerIndex');
Route::get('/seller/balance', function () {
    $store = Auth::user()->store;

    $balance = $store->storeBalance->balance ?? 0;

    return response()->json([
        'balance' => $balance,
        'formatted' => number_format($balance, 0, ',', '.'),
    ]);
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Verifikasi Toko
    Route::get('/verification', [StoreVerificationController::class, 'index'])->name('verification');
    Route::post('/verification/{store}/approve', [StoreVerificationController::class, 'approve'])->name('verification.approve');
    Route::post('/verification/{store}/reject', [StoreVerificationController::class, 'reject'])->name('verification.reject');

    // Manajemen User
    Route::resource('/users', AdminUserController::class);

    // Kategori
    Route::resource('/categories', AdminCategoryController::class);

    // Produk Global
    Route::resource('/products', AdminProductController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::patch('products/{product}/activate', [AdminProductController::class, 'activate'])
    ->name('products.activate');
    Route::patch('products/{product}/suspend', [AdminProductController::class, 'suspend'])
    ->name('products.suspend');


    // Transaksi
    Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{id}', [AdminTransactionController::class, 'show'])->name('transactions.show');
    Route::post('/transactions/{id}/approve', [AdminTransactionController::class, 'approve'])->name('transactions.approve');
    Route::post('/transactions/{id}/reject', [AdminTransactionController::class, 'reject'])->name('transactions.reject');
    Route::post('/transactions/{id}/status', [AdminTransactionController::class, 'updateStatus'])->name('transactions.updateStatus');

    Route::get('/withdrawals', [AdminWithdrawalController::class, 'index'])->name('withdrawals.index');
    Route::get('/withdrawals/{id}', [AdminWithdrawalController::class, 'show'])->name('withdrawals.show');
    Route::post('/withdrawals/{withdrawal}/approve',
        [AdminWithdrawalController::class, 'approve'])->name('withdrawals.approve');

    Route::post('/withdrawals/{withdrawal}/reject',
        [AdminWithdrawalController::class, 'reject'])->name('withdrawals.reject');
});


require __DIR__ . '/auth.php';
