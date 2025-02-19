<?php

namespace Core\BoundedContext\Tenant\Role\Applications\Responses;

use Core\BoundedContext\Tenant\Role\Domain\Roles;

final class RolesResponse
{
    public function __construct(private array $roles){}

    public static function fromRoles(Roles $roles): RolesResponse
    {
        $roleResponse = array_map(
            function ($role) {
                return RoleResponse::fromRol($role);
            },
            $roles->all()
        );

        return new self($roleResponse);
    }

    public function toArray()
    {
        return array_map(function (RoleResponse $roleResponse) {
            return $roleResponse->toArray();
        }, $this->roles);
    }
}
