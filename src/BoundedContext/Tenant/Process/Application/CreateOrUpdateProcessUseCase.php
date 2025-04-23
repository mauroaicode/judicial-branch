<?php

namespace Core\BoundedContext\Tenant\Process\Application;

use Core\BoundedContext\Tenant\Process\Domain\{
    Process,
    ValueObjects\ProcessId,
    ValueObjects\Grouped\ProcessData,
    Contracts\ProcessRepositoryContract
};
use Core\Shared\Domain\Contracts\UuidGeneratorContract;

readonly class CreateOrUpdateProcessUseCase
{
    public function __construct(
        private ProcessRepositoryContract $repository,
        private UuidGeneratorContract     $uuidGenerator
    ){
    }

    /**
     * Handles the creation or update of a process entity.
     *
     * Generates a new UUID, creates a Process domain object with the given data,
     * and delegates persistence to the repository.
     *
     * @param ProcessData $processData The data required to create or update the process.
     *
     * @return void
     */
    public function __invoke(ProcessData $processData): void
    {
        $id = new ProcessId($this->uuidGenerator->generate());

        $process = Process::create($id, $processData);

        $this->repository->save($process);
    }
}
