<?php

namespace Core\BoundedContext\Admin\Customer\Infrastructure\Controllers;

use Throwable;
use Core\Shared\Infrastructure\Controllers\AppBaseController;
use Core\BoundedContext\Admin\Customer\{
    Application\Actions\FindCustomerUseCase,
    Infrastructure\Persistence\Eloquent\EloquentCustomerRepository
};

class FindCustomerController extends AppBaseController
{
    public function __construct(private EloquentCustomerRepository $repository){}

    /**
     * Handles the request to search for a customer by its id.
     *
     * @param string $customerId The id of the customer being searched.
     *
     * @return object A JSON response containing the data of the customer found.
     */
    public function __invoke(string $customerId): object
    {

        try {

            $customer = (new FindCustomerUseCase($this->repository))($customerId)->toArray();

            return $this->sendSuccess($customer);

        } catch (Throwable $th) {

            return $this->sendError($th->getMessage(), $th->getCode());
        }
    }
}
