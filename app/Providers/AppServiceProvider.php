<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\RemoteInvoiceService;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(RemoteInvoiceService::class, function ($app) {
            return new RemoteInvoiceService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191); // Set default string length
    }
}
