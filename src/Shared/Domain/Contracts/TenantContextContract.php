<?php

namespace Core\Shared\Domain\Contracts;

interface TenantContextContract
{
    /**
     * Get the current tenant key or identifier.
     *
     * @return string|null
     */
    public function tenantKey(): ?string;

    /**
     * Get the full tenant model if needed.
     *
     * @return mixed
     */
    public function tenant(): mixed;
}
