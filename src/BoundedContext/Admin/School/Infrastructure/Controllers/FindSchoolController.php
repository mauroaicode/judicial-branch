<?php

namespace Core\BoundedContext\Admin\School\Infrastructure\Controllers;

use Throwable;
use Core\Shared\Infrastructure\Controllers\AppBaseController;
use Core\BoundedContext\Admin\School\{Application\Actions\FindSchoolUseCase, Infrastructure\Persistence\Eloquent\EloquentSchoolRepository};

class FindSchoolController extends AppBaseController
{
    public function __construct(private EloquentSchoolRepository $repository){}

    /**
     * Handles the request to search for a school by its id.
     *
     * @param string $schoolId The id of the school being searched.
     *
     * @return object A JSON response containing the data of the school found.
     */
    public function __invoke(string $schoolId): object
    {

        try {

            $school = (new FindSchoolUseCase($this->repository))($schoolId)->toArray();

            return $this->sendSuccess($school);

        } catch (Throwable $th) {

            return $this->sendError($th->getMessage(), $th->getCode());
        }
    }
}
