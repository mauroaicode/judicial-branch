<?php

namespace Core\BoundedContext\Admin\School\Infrastructure\Controllers;

use Throwable;
use Illuminate\Http\JsonResponse;
use Core\Shared\Infrastructure\Controllers\AppBaseController;
use Core\BoundedContext\Admin\School\{
    Application\Actions\ListSchoolUseCase,
    Infrastructure\Persistence\Eloquent\EloquentSchoolRepository
};

class ListSchoolController extends AppBaseController
{
    public function __construct(private EloquentSchoolRepository $repository)
    {
    }

    /**
     * Manages the application to list all available schools in the system.
     *
     * @return JsonResponse A JSON response containing the list of schools or an error message.
     */
    public function __invoke(): JsonResponse
    {
        try {

            $schools = (new ListSchoolUseCase($this->repository))()->toArray();

            return $this->sendSuccess($schools);

        } catch (Throwable $th) {
           return $this->sendError($th->getMessage(), $th->getCode());
        }
    }
}
