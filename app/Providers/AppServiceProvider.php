<?php

namespace App\Providers;

use Core\BoundedContext\Admin\Role\Infrastructure\Persistence\Eloquent\RoleModel;
use Core\BoundedContext\Admin\School\Infrastructure\Persistence\Eloquent\SchoolModel;
use Core\Shared\Domain\Contracts\TransactionContract;
use Core\Shared\Domain\Contracts\UuidGeneratorContract;
use Core\Shared\Infrastructure\Handlers\DatabaseTransactionHandler;
use Core\Shared\Infrastructure\Handlers\RamseyUuidGenerator;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Tenancy\Identification\Contracts\ResolvesTenants;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->resolving(ResolvesTenants::class, function (ResolvesTenants $resolver) {
            $resolver->addModel(SchoolModel::class);
            return $resolver;
        });

        $this->app->bind(
            TransactionContract::class,
            DatabaseTransactionHandler::class
        );

        $this->app->bind(
            UuidGeneratorContract::class,
            RamseyUuidGenerator::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config('permission.models.role', RoleModel::class);
        /**
         * Cargar migraciones del BoundedContext
         */
        if (!Request::is('api/*')) {
            $this->loadMigrationsFrom(
                \File::allFiles(base_path("src/BoundedContext/Admin/**/Infrastructure/Database/Migrations"))
            );
        }

    }
}
