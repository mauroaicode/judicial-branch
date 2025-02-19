<?php

namespace Core\BoundedContext\Admin\School\Infrastructure\Listeners;

use Tenancy\Affects\Connections\Contracts\ProvidesConfiguration;
use Tenancy\Affects\Connections\Events\Resolving;
use Tenancy\Affects\Connections\Events\Drivers\Configuring;
use Tenancy\Identification\Contracts\Tenant;

class ResolveTenantConnection implements ProvidesConfiguration
{
    public function handle(Resolving $event): static
    {
        return $this;
    }

    public function configure(Tenant $tenant): array
    {
        $config = [];

        event(new Configuring($tenant, $config, $this));

        return $config;
    }
}
