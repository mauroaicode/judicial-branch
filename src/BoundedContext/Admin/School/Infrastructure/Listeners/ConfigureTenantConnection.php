<?php

namespace Core\BoundedContext\Admin\School\Infrastructure\Listeners;

use Illuminate\Support\Facades\DB;
use Tenancy\Affects\Connections\Events\Drivers\Configuring;

class ConfigureTenantConnection
{
    public function handle(Configuring $event)
    {
        $event->useConnection('mysql', $event->defaults($event->tenant));
    }
}
