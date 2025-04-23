<?php

namespace Core\BoundedContext\Tenant\Process\Application\Jobs;

use Illuminate\Bus\{
    Batchable,
    Queueable
};
use Core\Shared\Domain\Contracts\TenantContextContract;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\{
    SerializesModels,
    InteractsWithQueue
};
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Core\BoundedContext\Tenant\Filing\Domain\Events\FilingWasObtained;

class CreateOrUpdateProcessJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public string $tenant_key,
        public string $tenant_identifier,
        public string $filingId,
        public array  $processesData,
    )
    {
    }

    /**
     * Handle the job.
     *
     * Dispatches a FilingWasObtained domain event for each process.
     *
     * @return void
     */
    public function handle(): void
    {
        foreach ($this->processesData as $process) {

            FilingWasObtained::dispatch(
                $this->tenant_key,
                $this->tenant_identifier,
                $this->filingId,
                $process['idProceso']
            );
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(Exception $exception): void
    {
        /** @var TenantContextContract $tenantContext */
        $tenantContext = app(TenantContextContract::class);

        Log::channel('filings_process')->error('Error processing filing: JOB FAILED ' , [
            'class' => $exception->getFile(),
            'line' => $exception->getLine(),
            'message' => $exception->getMessage(),
            'tenant' => $tenantContext->tenantKey()
        ]);
    }
}
