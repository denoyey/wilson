<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        // Gate: Hanya Admin yang bisa mengelola transaksi (inbound/outbound)
        Gate::define('manage-transactions', function ($user) {
            return $user->isAdmin();
        });
    }
}
