<?php

namespace Core\BoundedContext\Admin\Customer\Infrastructure\Listeners;

use Core\BoundedContext\Tenant\{
    Role\Infrastructure\Database\Seeders\RoleModelTableSeed,
    User\Infrastructure\Database\Seeders\UserModelTableSeed,
    Filing\Infrastructure\Database\Seeders\FilingModelTableSeed,
    IdentificationType\Infrastructure\Persistence\Eloquent\IdentificationTypeModelSeed,
};
use Tenancy\Hooks\Migration\Events\ConfigureSeeds;

class ConfigureTenantSeeds
{
    public function handle(ConfigureSeeds $event): void
    {
        $event->seed(IdentificationTypeModelSeed::class);
        $event->seed(RoleModelTableSeed::class);
        $event->seed(UserModelTableSeed::class);
        $event->seed(FilingModelTableSeed::class);
    }
}
