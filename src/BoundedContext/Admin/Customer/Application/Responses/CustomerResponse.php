<?php

namespace Core\BoundedContext\Admin\Customer\Application\Responses;

use Core\BoundedContext\Admin\Customer\Domain\Customer;

final class CustomerResponse
{

    public function __construct(private string $id, private string $name, private string $slug){}

    public static function fromCustomer(Customer $customer): self
    {
        return new self(
            $customer->id()->value(),
            $customer->name()->value(),
            $customer->slug()->value(),
        );
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug
        ];
    }
}
