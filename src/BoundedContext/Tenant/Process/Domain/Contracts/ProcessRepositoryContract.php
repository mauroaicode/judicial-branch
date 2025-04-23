<?php

namespace Core\BoundedContext\Tenant\Process\Domain\Contracts;

use Core\BoundedContext\Tenant\Process\Domain\Process;

interface ProcessRepositoryContract
{
    public function save(Process $process): void;
    public function byFilingCode(string $filingCode): Process;
}
