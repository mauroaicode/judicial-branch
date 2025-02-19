<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Core\BoundedContext\Admin\School\{Domain\Contracts\SchoolRepositoryContract, Infrastructure\Persistence\Eloquent\EloquentSchoolRepository};

class SchoolServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            SchoolRepositoryContract::class,
            EloquentSchoolRepository::class
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
