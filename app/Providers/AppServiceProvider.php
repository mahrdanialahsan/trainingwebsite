<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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

        // Create table only if it does not exist (avoids "Base table or view already exists")
        Schema::macro('createIfNotExists', function (string $table, \Closure $callback) {
            if (!Schema::hasTable($table)) {
                Schema::create($table, $callback);
            }
        });
    }
}
