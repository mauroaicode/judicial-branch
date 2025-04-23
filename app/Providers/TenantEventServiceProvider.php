<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Core\BoundedContext\Tenant\Filing\Domain\Events\FilingWasObtained;
use Core\BoundedContext\Tenant\Filing\Application\Listener\FetchFilingDetailAfterObtainedListener;


class TenantEventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        FilingWasObtained::class => [
            FetchFilingDetailAfterObtainedListener::class
        ]
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
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
