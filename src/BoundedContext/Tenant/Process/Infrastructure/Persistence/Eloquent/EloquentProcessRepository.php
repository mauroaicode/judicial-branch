<?php

namespace Core\BoundedContext\Tenant\Process\Infrastructure\Persistence\Eloquent;

use Core\Shared\Domain\Contracts\{
    TransactionContract,
    TenantContextContract
};
use Core\BoundedContext\Tenant\Process\Domain\{
    Process,
    Contracts\ProcessRepositoryContract
};
use Exception;
use Throwable;
use Illuminate\Support\Facades\Log;


readonly class EloquentProcessRepository implements ProcessRepositoryContract
{
    public function __construct(private ProcessModel $model, private TransactionContract $transactionContract)
    {
    }

    /**
     * Saves or updates a process using Eloquent.
     *
     * @param Process $process
     * @return void
     * @throws Exception
     */
    public function save(Process $process): void
    {
        $this->transactionContract->beginTransaction();

        try {

            $data = $process->toArray();

            $this->model->updateOrCreate(
                ['process_id' => $data['process_id']],
                $data
            );

            $this->transactionContract->commit();
        } catch (Throwable $th) {
            $this->transactionContract->rollback();

            /** @var TenantContextContract $tenantContext */
            $tenantContext = app(TenantContextContract::class);

            Log::channel('filings_process')->error('Error transaction: DATABASE FAILED' , [
                'class' => $th->getFile(),
                'line' => $th->getLine(),
                'message' => $th->getMessage(),
                'tenant' => $tenantContext->tenantKey()
            ]);
        }
    }

    /**
     * Finds a process by its filing code.
     *
     * @param string $filingCode
     * @return Process
     */
    public function byFilingCode(string $filingCode): Process
    {
        // TODO: Implement byFilingCode() method.
    }
}
