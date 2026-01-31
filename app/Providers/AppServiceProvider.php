<?php

namespace App\Providers;

use App\Http\Controllers\CartController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // MySQL utf8mb4: max index key length is 1000 bytes (255 chars × 4 bytes exceeds it)
        Schema::defaultStringLength(191);

        View::composer('layouts.app', function ($view) {
            $details = CartController::getCartDetails();
            $view->with([
                'cartDropdownItems' => $details['items'],
                'cartSubtotal' => $details['subtotal'],
                'cartCount' => $details['count'],
            ]);
        });

        // Create table only if it does not exist (avoids "Base table or view already exists")
        Schema::macro('createIfNotExists', function (string $table, \Closure $callback) {
            if (!Schema::hasTable($table)) {
                Schema::create($table, $callback);
            }
        });
    }
}
