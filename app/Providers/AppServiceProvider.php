<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\RemoteInvoiceService;

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
        //
    }
}
