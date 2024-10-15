<?php

namespace App\Providers;

use App\Repositories\Contracts\kycRepositoryInterface;
use App\Repositories\KycRepository;
use Illuminate\Support\ServiceProvider;

class KycRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
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
