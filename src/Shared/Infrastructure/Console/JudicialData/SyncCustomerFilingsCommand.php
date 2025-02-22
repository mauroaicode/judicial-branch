<?php

namespace Core\Shared\Infrastructure\Console\JudicialData;

use Core\BoundedContext\Admin\Customer\Infrastructure\Persistence\Eloquent\CustomerModel;
use Core\BoundedContext\Tenant\Filing\Infrastructure\Persistence\Eloquent\FilingModel;
use Illuminate\Console\Command;
use Tenancy\Facades\Tenancy;

class SyncCustomerFilingsCommand extends Command
{
    protected $signature = 'customers:sync-filings';
    protected $description = 'Obtiene los radicados de cada cliente activo';

    public function handle(): void
    {
        // Obtener los clientes activos
        $customers = CustomerModel::all();

        foreach ($customers as $customer) {
            $databaseName = $customer->slug;

            $this->info("Conectando a la base de datos: {$databaseName}");

            Tenancy::setTenant($customer);

            $filings = FilingModel::all();

            foreach ($filings as $filing) {
                $this->info("Radicado encontrado: {$filing->radicado}");
            }
        }

        $this->info('Proceso completado.');
    }
}
