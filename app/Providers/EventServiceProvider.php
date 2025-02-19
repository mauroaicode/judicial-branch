<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        \Illuminate\Auth\Events\Registered::class => [
            \Illuminate\Auth\Listeners\SendEmailVerificationNotification::class,
        ],
        \Tenancy\Hooks\Database\Events\Drivers\Configuring::class => [
            \Core\BoundedContext\Admin\School\Infrastructure\Listeners\ConfigureTenantDatabase::class
        ],
        \Tenancy\Affects\Connections\Events\Resolving::class => [
            \Core\BoundedContext\Admin\School\Infrastructure\Listeners\ResolveTenantConnection::class
        ],
        \Tenancy\Affects\Connections\Events\Drivers\Configuring::class => [
            \Core\BoundedContext\Admin\School\Infrastructure\Listeners\ConfigureTenantConnection::class
        ],
        \Tenancy\Hooks\Migration\Events\ConfigureMigrations::class => [
            \Core\BoundedContext\Admin\School\Infrastructure\Listeners\ConfigureTenantMigrations::class
        ],
        \Tenancy\Hooks\Migration\Events\ConfigureSeeds::class => [
            \Core\BoundedContext\Admin\School\Infrastructure\Listeners\ConfigureTenantSeeds::class
        ],
        \Tenancy\Affects\URLs\Events\ConfigureURL::class => [
            \Core\BoundedContext\Admin\School\Infrastructure\Listeners\ConfigureApplicationUrl::class
        ],
        \Tenancy\Affects\Routes\Events\ConfigureRoutes::class => [
            \Core\BoundedContext\Admin\School\Infrastructure\Listeners\ConfigureTenantRoutes::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
