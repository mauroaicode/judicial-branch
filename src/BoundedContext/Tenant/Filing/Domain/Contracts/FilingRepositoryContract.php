<?php

namespace Core\BoundedContext\Tenant\Filing\Domain\Contracts;

use Core\BoundedContext\Tenant\Filing\Domain\Filings;

interface FilingRepositoryContract
{
    public function list(): Filings;
}
