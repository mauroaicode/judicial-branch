<?php

namespace App\Providers;

use Core\BoundedContext\Tenant\Auth\Domain\Contracts\AuthRepositoryContract as AuthContractTenant;
use Core\BoundedContext\Tenant\Auth\Infrastructure\Persistence\AuthJwtRepository as AuthJwtRepositoryTenant;

use Core\BoundedContext\Admin\Auth\Domain\Contracts\AuthRepositoryContract;
use Core\BoundedContext\Admin\Auth\Infrastructure\Persistence\AuthJwtRepository;

use Core\Shared\Domain\Contracts\AuthContract;
use Core\Shared\Infrastructure\Persistence\Auth\Jwt\AuthJwt;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function register()
    {
        $this->app->bind(
          AuthContract::class,
          AuthJwt::class
        );
        $this->app->bind(
            AuthContractTenant::class,
            AuthJwtRepositoryTenant::class
        );
        $this->app->bind(
            AuthRepositoryContract::class,
            AuthJwtRepository::class
        );
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
