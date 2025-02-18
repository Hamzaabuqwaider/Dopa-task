<?php

namespace App\Providers;

use App\Services\Logging\AccessLogService;
use App\Services\Logging\AccessLogServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            AccessLogServiceInterface::class,
            AccessLogService::class
        );
    }

    public function boot(): void
    {
        //
    }
}
