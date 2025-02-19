<?php

namespace Core\BoundedContext\Admin\School\Infrastructure\Controllers;

use Throwable;
use Illuminate\Http\JsonResponse;
use Core\Shared\Domain\Contracts\UuidGeneratorContract;
use Core\Shared\Infrastructure\Controllers\AppBaseController;
use Core\BoundedContext\Admin\School\{Application\Actions\CreateSchoolUseCase,
    Infrastructure\FormRequest\CreateSchoolRequest,
    Infrastructure\Persistence\Eloquent\EloquentSchoolRepository};

final class CreateSchoolController extends AppBaseController
{
    public function __construct(
        private EloquentSchoolRepository $repository,
        private UuidGeneratorContract    $uuidGenerator,
    ){}

    /**
     * Handles the creation of a school through an HTTP request.
     *
     * @param CreateSchoolRequest $request The HTTP request that contains the school data.
     *
     * @return JsonResponse A JSON response indicating the result of the operation.
     */
    public function __invoke(CreateSchoolRequest $request): JsonResponse
    {
        try {

            $id = $request->get('id', $this->uuidGenerator->generate());

            $schoolResponse = (new CreateSchoolUseCase(
                $this->repository
            ))(
                $id,
                $request->get('name'),
                $request->get('slug'),
            );

            return $this->sendSuccess($schoolResponse->toArray());

        } catch (Throwable $th) {

            return $this->sendError($th->getMessage(), $th->getCode());
        }
    }
}
