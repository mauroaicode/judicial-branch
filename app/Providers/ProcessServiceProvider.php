<?php

namespace App\Providers;

use Core\BoundedContext\Tenant\Process\Domain\Contracts\ProcessRepositoryContract;
use Core\BoundedContext\Tenant\Process\Infrastructure\Persistence\Eloquent\EloquentProcessRepository;
use Illuminate\Support\ServiceProvider;

class ProcessServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            ProcessRepositoryContract::class,
            EloquentProcessRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
    }
}
