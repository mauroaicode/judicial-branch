<?php

namespace Core\BoundedContext\Admin\Customer\Application\Actions;

use Core\BoundedContext\Admin\Customer\Domain\ValueObjects\{
    CustomerId,
    CustomerSlug,
    CustomerName
};
use Core\BoundedContext\Admin\Customer\{
    Application\Responses\CustomerResponse,
    Domain\Customer,
    Domain\Contracts\CustomerRepositoryContract};

final class CreateCustomerUseCase
{
    public function __construct(private CustomerRepositoryContract $repository){}

    /**
     * Creates a new customer with the provided data and stores it in the repository.
     *
     * @param string $id The unique identifier of the customer.
     * @param string $name The customer name.
     * @param string $slug The customer's slug.
     *
     * @return CustomerResponse A response containing the created customer's data.
     */
    public function __invoke(string $id, string $name, string $slug): CustomerResponse
    {
        $id = new CustomerId($id);
        $name = new CustomerName($name);
        $slug = new CustomerSlug($slug);

        $customer = Customer::create($id, $name, $slug);

        $this->repository->save($customer);

        return CustomerResponse::fromcustomer($customer);
    }
}
