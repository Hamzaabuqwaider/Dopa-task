<?php

namespace App\Providers;

use App\Services\Logging\AccessLogService;
use App\Services\Logging\AccessLogServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AccessLogServiceInterface::class,
            AccessLogService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
