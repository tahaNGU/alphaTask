<?php

namespace App\Providers;

use App\Repositories\Contracts\kycRepositoryInterface;
use App\Repositories\KycRepository;
use App\Services\Contract\KycServiceInterface;
use App\Services\KycService;
use Illuminate\Support\ServiceProvider;

class kycServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(KycServiceInterface::class, KycService::class);
        $this->app->bind(kycRepositoryInterface::class, KycRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
