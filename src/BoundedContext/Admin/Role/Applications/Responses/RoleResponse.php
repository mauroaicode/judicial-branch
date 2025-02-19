<?php

namespace Core\BoundedContext\Admin\Role\Applications\Responses;

use Core\BoundedContext\Admin\Role\Domain\Role;

final class RoleResponse
{
    public function __construct(private string $id, private string $name){}

    public static function fromRol(Role $role): self
    {
        return new self(
            $role->id()->value(),
            $role->name()->value()
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

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
