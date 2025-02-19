<?php

namespace Core\Shared\Infrastructure\Handlers;

use Core\Shared\Domain\Contracts\TransactionContract;
use Illuminate\Support\Facades\DB;

final class DatabaseTransactionHandler implements TransactionContract
{

    public function beginTransaction(): void
    {
        DB::beginTransaction();
    }

    public function commit(): void
    {
        DB::commit();
    }

    public function rollback(): void
    {
        DB::rollBack();
    }
}
