<?php

namespace Core\BoundedContext\Tenant\Filing\Infrastructure\Persistence\Eloquent;

use Core\BoundedContext\Tenant\Filing\Domain\{
    Filing,
    Filings,
    Contracts\FilingRepositoryContract
};

class EloquentFilingRepository implements FilingRepositoryContract
{

    public function __construct(private FilingModel $model)
    {
    }

    private function toDomain(FilingModel $eloquentFilingModel): Filing
    {
        return Filing::fromPrimitives(
            $eloquentFilingModel->id,
            $eloquentFilingModel->code
        );
    }

    public function list(): Filings
    {
        $filingModel = $this->model->all();

        $filings = $filingModel->map(function (FilingModel $filingModel) {
            return $this->toDomain($filingModel);
        })->toArray();

        return new Filings($filings);
    }
}
