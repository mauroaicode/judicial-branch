<?php

namespace Core\BoundedContext\Admin\Customer\Infrastructure\Controllers;

use Throwable;
use Illuminate\Http\JsonResponse;
use Core\Shared\Infrastructure\Controllers\AppBaseController;
use Core\BoundedContext\Admin\Customer\{
    Application\Actions\DeleteCustomerUseCase,
    Infrastructure\Persistence\Eloquent\EloquentCustomerRepository,
};


class DeleteCustomerController extends AppBaseController
{
    public function __construct(private EloquentCustomerRepository $repository){}

    /**
     * Executes the action of eliminating a customer.
     *
     * @param string $customerId The ID of the customer to delete.
     * @return JsonResponse JSON response indicating the result of the action.
     */
    public function __invoke(string $customerId): JsonResponse
    {
        try {

            $response = (new DeleteCustomerUseCase($this->repository))($customerId);

            return $this->sendSuccess($response);

        } catch (Throwable $th) {

            return $this->sendError($th->getMessage(), $th->getCode());
        }
    }
}
