<?php

namespace App\Providers;

use App\Services\Contract\KycServiceInterface;
use App\Services\KycService;
use Illuminate\Support\ServiceProvider;

class KycServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(KycServiceInterface::class, KycService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
