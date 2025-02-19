<?php

namespace Core\BoundedContext\Admin\School\Infrastructure\Listeners;

use Illuminate\Support\Facades\Log;
use Tenancy\Hooks\Database\Events\Drivers\Configuring;

class ConfigureTenantDatabase
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Configuring  $event
     * @return void
     */
    public function handle(Configuring $event): void
    {
        $event->useConnection('mysql', $event->defaults($event->tenant));
    }
}
