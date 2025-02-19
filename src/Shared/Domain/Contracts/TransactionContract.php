<?php

namespace Core\Shared\Domain\Contracts;

interface  TransactionContract
{
    public function beginTransaction(): void;

    public function commit(): void;

    public function rollback(): void;
}
