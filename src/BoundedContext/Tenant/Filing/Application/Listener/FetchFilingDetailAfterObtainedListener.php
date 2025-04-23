<?php

namespace Core\BoundedContext\Tenant\Filing\Application\Listener;

use Core\BoundedContext\Tenant\Process\{
    Domain\ValueObjects\Grouped\ProcessData,
    Application\CreateOrUpdateProcessUseCase
};
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Core\Shared\Domain\Contracts\TenantContextContract;
use Core\BoundedContext\Tenant\Filing\Domain\Events\FilingWasObtained;
use Core\Shared\Infrastructure\Services\JudicialBranch\JudicialBranchConsultService;




readonly class FetchFilingDetailAfterObtainedListener implements ShouldQueue
{
    public function __construct(
        private CreateOrUpdateProcessUseCase $createOrUpdateProcessUseCase
    ){
    }

    /**
     * Handles the FilingWasObtained event.
     *
     * Fetches process detail data from the external provider.
     * If successful, it maps the data into a value object and
     * invokes the use case to persist or update the process.
     *
     * @param FilingWasObtained $event The domain event containing filing and process info.
     *
     * @return void
     */
    public function handle(FilingWasObtained $event): void
    {
        try {

            $responseProvider = (new JudicialBranchConsultService)->fetchDetailProcess((int)$event->processId);

            if (!$responseProvider->isSuccessful) {
                return;
            }

            $process = $responseProvider->data;

            $processData = new ProcessData(
                processId: $process['idRegProceso'],
                filingId: $event->filingId,
                filingCode: $process['llaveProceso'],
                connectionId: $process['idConexion'],
                isPrivate: $process['esPrivado'],
                processDate: $process['fechaProceso'],
                court: $process['despacho'],
                judge: $process['ponente'],
                processType: $process['tipoProceso'],
                processClass: $process['claseProceso'],
                processSubclass: $process['subclaseProceso'],
                appealType: $process['recurso'],
                location: $process['ubicacion'],
                filingContent: $process['contenidoRadicacion'],
                consultedAt: $process['fechaConsulta'],
                lastUpdatedAt: $process['ultimaActualizacion']
            );

            ($this->createOrUpdateProcessUseCase)($processData);

        }catch (Throwable $th) {

            /** @var TenantContextContract $tenantContext */
            $tenantContext = app(TenantContextContract::class);

            Log::channel('filings_process')->error('Error processing filing: JOB FAILED ' , [
                'class' => $th->getFile(),
                'line' => $th->getLine(),
                'message' => $th->getMessage(),
                'tenant' => $tenantContext->tenantKey()
            ]);
        }
    }

    /**
     * Get the name of the listener's queue.
     *
     * @return string
     */
    public function viaQueue(): string
    {
        return config('queues-map.processes.queue');
    }

}
