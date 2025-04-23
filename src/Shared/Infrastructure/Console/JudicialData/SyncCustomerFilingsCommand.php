<?php

namespace Core\Shared\Infrastructure\Console\JudicialData;

use Throwable;
use Illuminate\Bus\Batch;
use Tenancy\Facades\Tenancy;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Bus;
use Core\BoundedContext\Tenant\Filing\Domain\ValueObjects\FilingId;
use Core\BoundedContext\Tenant\Filing\Domain\Contracts\FilingRepositoryContract;
use Core\BoundedContext\Tenant\Process\Application\Jobs\CreateOrUpdateProcessJob;
use Core\BoundedContext\Admin\Customer\Domain\Contracts\CustomerRepositoryContract;
use Core\Shared\Infrastructure\Services\JudicialBranch\JudicialBranchConsultService;
use Core\BoundedContext\Admin\Customer\Infrastructure\Persistence\Eloquent\CustomerModel;


class SyncCustomerFilingsCommand extends Command
{
    private array $jobs = [];

    public function __construct(
        private readonly CustomerRepositoryContract $customerRepository,
        private readonly FilingRepositoryContract   $filingRepository,
    )
    {
        parent::__construct();
    }

    protected $signature = 'customers:sync-filings';
    protected $description = 'Obtiene los radicados de cada cliente activo';

    /**
     * Command handler that processes all active customers' filings
     * and dispatches jobs to sync judicial processes.
     *
     * @return void
     * @throws Throwable
     */
    public function handle(): void
    {
        $customers = $this->customerRepository->list()->all();

        foreach ($customers as $customer) {

            $customerModel = $this->customerRepository->toEloquent($customer);

            Tenancy::setTenant($customerModel);

            $filings = $this->filingRepository->list()->all();

            foreach ($filings as $filing) {

                $processes = (new JudicialBranchConsultService)->fetchProcesses($filing->code()->value());

                $this->info("Radicado encontrado: {$filing->code()->value()}");

                $this->createOrUpdateProcess($processes->data, $filing->id(), $customerModel);
            }
        }
        $this->executeJobs();
        $this->info('Proceso completado.');
    }

    /**
     * Prepares and queues process jobs for a given customer and filing.
     *
     * @param array         $processes
     * @param FilingId      $filingId
     * @param CustomerModel $customerModel
     *
     * @return void
     */
    public function createOrUpdateProcess(array $processes, FilingId $filingId, CustomerModel $customerModel): void
    {
        collect($processes)
            ->chunk(5)
            ->each(fn ($processesBatch) => $this->jobs[] = new CreateOrUpdateProcessJob(
                $customerModel->getTenantKey(),
                $customerModel->getTenantIdentifier(),
                $filingId->value(),
                $processes));

        $this->info("Se guardo o actualizo procesos del cliente {$customerModel->name}.");
    }

    /**
     * Dispatches the batch of queued jobs and handles success or failure callbacks.
     *
     * @return void
     * @throws Throwable
     */
    private function executeJobs(): void
    {
        Bus::batch($this->jobs)
            ->onQueue(config('queues-map.filings.queue'))
            ->then(function (Batch $batch): void {
            })
            ->catch(function (Batch $batch, Throwable $th): void {
                Log::channel('filings_process')->error('Error processing filing: JOB FAILED ' , [
                    'class' => $th->getFile(),
                    'line' => $th->getLine(),
                    'message' => $th->getMessage(),
                ]);
            })
            ->allowFailures()
            ->dispatch();

    }
}

