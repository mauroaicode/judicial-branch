<?php

namespace Core\BoundedContext\Admin\Role\Domain;

use Core\BoundedContext\Admin\Role\Domain\{ValueObjects\RoleId, ValueObjects\RoleName};

class Role
{
    public function __construct(
        private RoleId   $id,
        private RoleName $name
    ){}

    /**
     * Creates a Role object from its primitive components.
     *
     * @param string $id Role ID as string.
     * @param string $name Name of the role as string.
     *
     * @return Role Role object created from the primitive components.
     */
    public static function fromPrimitives(string $id, string $name): self
    {
        return new self(
            new RoleId($id),
            new RoleName($name)
        );
    }

    /**
     * Gets the role ID.
     *
     * @return RoleId Value object representing the role ID.
     */
    public function id(): RoleId
    {
        return $this->id;
    }

    /**
     * Gets the name of the role.
     *
     * @return RoleName Value object representing the role name.
     */
    public function name(): RoleName
    {
        return $this->name;
    }
}
