<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Core\BoundedContext\Tenant\Filing\Domain\Contracts\FilingRepositoryContract;
use Core\BoundedContext\Tenant\Filing\Infrastructure\Persistence\Eloquent\EloquentFilingRepository;


class FilingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            FilingRepositoryContract::class,
            EloquentFilingRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
