<?php

namespace Core\BoundedContext\Admin\School\Infrastructure\Listeners;

use Core\BoundedContext\Tenant\{Role\Infrastructure\Database\Seeders\RoleModelTableSeed,
    User\Infrastructure\Database\Seeders\UserModelTableSeed,
    GenderIdentity\Infrastructure\Persistence\Eloquent\GenderIdentityModelSeed,
    IdentificationType\Infrastructure\Persistence\Eloquent\IdentificationTypeModelSeed,
    Vehicle\Infrastructure\Database\Seeders\VehicleModelTableSeed
};
use Tenancy\Hooks\Migration\Events\ConfigureSeeds;

class ConfigureTenantSeeds
{
    public function handle(ConfigureSeeds $event): void
    {
        $event->seed(GenderIdentityModelSeed::class);
        $event->seed(IdentificationTypeModelSeed::class);
        $event->seed(RoleModelTableSeed::class);
        $event->seed(UserModelTableSeed::class);
        $event->seed(VehicleModelTableSeed::class);
    }
}
