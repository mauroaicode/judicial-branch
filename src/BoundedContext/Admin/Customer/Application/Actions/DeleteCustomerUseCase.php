<?php

namespace Core\BoundedContext\Admin\Customer\Application\Actions;

use Core\BoundedContext\Admin\Customer\{
    Domain\ValueObjects\CustomerId,
    Application\Responses\FilingResponse,
    Domain\Contracts\CustomerRepositoryContract,
    Domain\Exceptions\CustomerNotFoundException,
};

class DeleteCustomerUseCase
{
    public function __construct(private CustomerRepositoryContract $repository){}

    /**
     * Executes the action of eliminating a customer.
     *
     * @param string $customerId
     * @return FilingResponse The response of the delete action.
     *
     * @throws CustomerNotFoundException If the customer with the provided ID is not found.
     */
    public function __invoke(string $customerId): FilingResponse
    {
        $id = new CustomerId($customerId);

        $customer = $this->repository->delete($id);

        if (is_null($customer)){

            throw new CustomerNotFoundException();
        }

        return FilingResponse::fromCustomer($customer);
    }
}
