<?php

namespace Core\BoundedContext\Admin\Customer\Domain;

use Core\BoundedContext\Admin\Customer\Domain\ValueObjects\{
    CustomerId,
    CustomerName,
    CustomerSlug
};

class Customer
{
    public function __construct(
        private CustomerId   $id,
        private CustomerName $name,
        private CustomerSlug $slug,
    )
    {
    }

    public static function fromPrimitives(string $id, string $name, string $slug): self
    {
        return new self(
            new CustomerId($id),
            new CustomerName($name),
            new CustomerSlug($slug)
        );
    }
    public static function create(CustomerId $id, CustomerName $name, CustomerSlug $slug): self
    {
        return new self(
            $id,
            $name,
            $slug
        );
    }
    public function id(): CustomerId
    {
        return $this->id;
    }

    public function name(): CustomerName
    {
        return $this->name;
    }

    public function slug(): CustomerSlug
    {
        return $this->slug;
    }
}
