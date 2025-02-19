<?php

namespace Core\BoundedContext\Admin\School\Infrastructure\Controllers;

use Throwable;
use Illuminate\Http\JsonResponse;
use Core\Shared\Infrastructure\Controllers\AppBaseController;
use Core\BoundedContext\Admin\School\{
    Application\Actions\DeleteSchoolUseCase,
    Infrastructure\Persistence\Eloquent\EloquentSchoolRepository,
};


class DeleteSchoolController extends AppBaseController
{
    public function __construct(private EloquentSchoolRepository $repository){}

    /**
     * Executes the action of eliminating a school.
     *
     * @param string $schoolId The ID of the school to delete.
     * @return JsonResponse JSON response indicating the result of the action.
     */
    public function __invoke(string $schoolId): JsonResponse
    {
        try {

            $response = (new DeleteSchoolUseCase($this->repository))($schoolId);

            return $this->sendSuccess($response);

        } catch (Throwable $th) {

            return $this->sendError($th->getMessage(), $th->getCode());
        }
    }
}
