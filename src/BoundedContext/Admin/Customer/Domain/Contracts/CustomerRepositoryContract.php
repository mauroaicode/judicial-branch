<?php

namespace Core\BoundedContext\Admin\Customer\Domain\Contracts;

use Core\BoundedContext\{
    Admin\Customer\Domain\Customer,
    Admin\Customer\Domain\Customers,
    Admin\Customer\Domain\ValueObjects\CustomerId
};

interface CustomerRepositoryContract
{
    public function list(): Customers;

    public function save(Customer $customer): void;

    public function find(CustomerId $customerId): ?Customer;

    public function delete(CustomerId $customerId): ?Customer;
}
