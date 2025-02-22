<?php

namespace Core\BoundedContext\Admin\Customer\Application\Actions;

use Core\BoundedContext\Admin\Customer\{
    Application\Responses\CustomersResponse,
    Domain\Contracts\CustomerRepositoryContract
};

final class ListCustomerUseCase
{
    public function __construct(private CustomerRepositoryContract $repository){}

    /**
     * Execute the action to list all the customers available in the system.
     *
     * @return CustomersResponse A response containing the list of customers.
     */
    public function __invoke(): CustomersResponse
    {
        $customers = $this->repository->list();

        return CustomersResponse::fromCustomers($customers);
    }
}
