<?php

namespace Core\Shared\Infrastructure\Services\Tenant;

use Tenancy\Facades\Tenancy;
use Tenancy\Identification\Contracts\Tenant;
use Core\Shared\Domain\Contracts\TenantContextContract;


class LaravelTenantContext implements TenantContextContract
{
    /**
     * Get the unique tenant key of the currently resolved tenant.
     *
     * @return string|null The tenant key or null if no tenant is resolved.
     */
    public function tenantKey(): ?string
    {
        return Tenancy::getTenant()?->getTenantKey();
    }

    /**
     * Get the current tenant instance.
     *
     * @return Tenant|null The tenant model or null if no tenant is resolved.
     */
    public function tenant(): ?Tenant
    {
        return Tenancy::getTenant();
    }
}
