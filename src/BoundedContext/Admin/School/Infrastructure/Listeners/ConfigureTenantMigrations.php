<?php

namespace Core\BoundedContext\Admin\School\Infrastructure\Listeners;

use Tenancy\Hooks\Migration\Events\ConfigureMigrations;

class ConfigureTenantMigrations
{
    public function handle(ConfigureMigrations $event): void
    {
        $event->path(base_path("src/BoundedContext/Tenant/**/Infrastructure/Database/Migrations"));
    }
}
