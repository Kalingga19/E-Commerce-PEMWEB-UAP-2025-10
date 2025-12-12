<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $cart = session('cart', []);

            // total item = jumlah qty semua product
            $cartCount = collect($cart)->sum('qty');

            $view->with('cartCount', $cartCount);
        });
    }
}
