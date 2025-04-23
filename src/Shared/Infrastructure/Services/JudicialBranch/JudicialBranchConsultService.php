<?php

namespace Core\Shared\Infrastructure\Services\JudicialBranch;

use Illuminate\Support\Facades\{
    Log,
    Http
};
use Throwable;
use Core\Shared\Domain\Contracts\TenantContextContract;

class JudicialBranchConsultService
{
    /**
     * Fetches a list of processes by filing code.
     *
     * @param string $code Filing code (radicado number).
     * @return object Response with status and process list.
     */
    public function fetchProcesses(string $code): object
    {
        $data = [];
        $isSuccessful = true;

        /** @var TenantContextContract $tenantContext */
        $tenantContext = app(TenantContextContract::class);

        try {

            $baseUrl = config('judicial-branch.api_url') . '/Procesos/Consulta/NumeroRadicacion';
            $params = [
                'numero' => $code,
                'SoloActivos' => 'false'
            ];

            $endpoint = "{$baseUrl}?" . http_build_query($params);

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->get($endpoint)->json();

            $data = $response['procesos'];

        } catch (Throwable $th) {
            $isSuccessful = false;

            Log::channel('filings_process')->error('Error processing filing ' , [
                'class' => $th->getFile(),
                'line' => $th->getLine(),
                'message' => $th->getMessage(),
                'tenant' => $tenantContext->tenantKey()
            ]);
        }

        return (object)compact('isSuccessful', 'data');
    }

    /**
     * Fetches detailed information of a specific process.
     *
     * @param int $processId Unique ID of the process.
     * @return object Response with status and detailed data.
     */
    public function fetchDetailProcess(int $processId): object
    {
        $data = [];
        $isSuccessful = true;

        /** @var TenantContextContract $tenantContext */
        $tenantContext = app(TenantContextContract::class);

        try {

            $endpoint = config('judicial-branch.api_url') . "/Proceso/Detalle/{$processId}";

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->get($endpoint)->json();

            $data = $response;

        } catch (Throwable $th) {
            $isSuccessful = false;

            Log::channel('filings_process')->error('Error processing filing ' , [
                'class' => $th->getFile(),
                'line' => $th->getLine(),
                'message' => $th->getMessage(),
                'tenant' => $tenantContext->tenantKey()
            ]);
        }

        return (object)compact('isSuccessful', 'data');
    }
}
