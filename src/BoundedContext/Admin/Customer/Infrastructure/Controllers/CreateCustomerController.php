<?php

namespace Core\BoundedContext\Admin\Customer\Infrastructure\Controllers;

use Throwable;
use Illuminate\Http\JsonResponse;
use Core\Shared\Domain\Contracts\UuidGeneratorContract;
use Core\Shared\Infrastructure\Controllers\AppBaseController;
use Core\BoundedContext\Admin\Customer\{
    Application\Actions\CreateCustomerUseCase,
    Infrastructure\FormRequest\CreateCustomerRequest,
    Infrastructure\Persistence\Eloquent\EloquentCustomerRepository};

final class CreateCustomerController extends AppBaseController
{
    public function __construct(
        private EloquentCustomerRepository $repository,
        private UuidGeneratorContract      $uuidGenerator,
    ){}

    /**
     * Handles the creation of a customer through an HTTP request.
     *
     * @param CreateCustomerRequest $request The HTTP request that contains the customer data.
     *
     * @return JsonResponse A JSON response indicating the result of the operation.
     */
    public function __invoke(CreateCustomerRequest $request): JsonResponse
    {
        try {

            $id = $request->get('id', $this->uuidGenerator->generate());

            $customerResponse = (new CreateCustomerUseCase(
                $this->repository
            ))(
                $id,
                $request->get('name'),
                $request->get('slug'),
            );

            return $this->sendSuccess($customerResponse->toArray());

        } catch (Throwable $th) {

            return $this->sendError($th->getMessage(), $th->getCode());
        }
    }
}
