<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Core\BoundedContext\Admin\Customer\{
    Domain\Contracts\CustomerRepositoryContract,
    Infrastructure\Persistence\Eloquent\EloquentCustomerRepository
};

class CustomerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            CustomerRepositoryContract::class,
            EloquentCustomerRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
