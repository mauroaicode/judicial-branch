<?php

namespace Core\BoundedContext\Admin\Customer\Infrastructure\Controllers;

use Throwable;
use Illuminate\Http\JsonResponse;
use Core\Shared\Infrastructure\Controllers\AppBaseController;
use Core\BoundedContext\Admin\Customer\{
    Application\Actions\ListCustomerUseCase,
    Infrastructure\Persistence\Eloquent\EloquentCustomerRepository
};

class ListCustomerController extends AppBaseController
{
    public function __construct(private EloquentCustomerRepository $repository)
    {
    }

    /**
     * Manages the application to list all available customers in the system.
     *
     * @return JsonResponse A JSON response containing the list of customers or an error message.
     */
    public function __invoke(): JsonResponse
    {
        try {

            $customers = (new ListCustomerUseCase($this->repository))()->toArray();

            return $this->sendSuccess($customers);

        } catch (Throwable $th) {
           return $this->sendError($th->getMessage(), $th->getCode());
        }
    }
}
