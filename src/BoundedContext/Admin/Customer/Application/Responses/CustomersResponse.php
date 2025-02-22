<?php

namespace Core\BoundedContext\Admin\Customer\Application\Responses;

use Core\BoundedContext\Admin\Customer\Domain\Customers;

final class CustomersResponse
{

    public function __construct(private array $customers){}

    public static function fromCustomers(Customers $customers): CustomersResponse
    {
        $customerResponses = array_map(
            function ($customer) {
                return CustomerResponse::fromCustomer($customer);
            },
            $customers->all()
        );
        return new self($customerResponses);
    }

    public function toArray(): array
    {
        return array_map(function (CustomerResponse $customerResponse) {
            return $customerResponse->toArray();
        }, $this->customers);
    }
}
