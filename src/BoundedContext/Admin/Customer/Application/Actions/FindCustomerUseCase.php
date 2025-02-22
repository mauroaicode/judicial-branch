<?php

namespace Core\BoundedContext\Admin\Customer\Application\Actions;

use Core\BoundedContext\Admin\Customer\Domain\{
    ValueObjects\CustomerId,
    Contracts\CustomerRepositoryContract,
    Exceptions\CustomerNotFoundException
};
use Core\BoundedContext\Admin\Customer\Application\Responses\CustomerResponse;


class FindCustomerUseCase
{
    public function __construct(private CustomerRepositoryContract $repository){}

    /**
     * Find a customer by its id and return an answer.
     *
     * @param string $customerId The id of the customer being searched for.
     *
     * @return CustomerResponse The response containing the data for the customer found.
     * @throws CustomerNotFoundException If the customer is not found in the database.
     */
    public function __invoke(string $customerId): CustomerResponse
    {
        $id = new CustomerId($customerId);

        $customer = $this->repository->find($id);

        if (is_null($customer)) {

            throw new CustomerNotFoundException();
        }

        return CustomerResponse::fromcustomer($customer);
    }
}
