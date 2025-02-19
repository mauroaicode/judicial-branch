<?php

namespace Core\BoundedContext\Tenant\Auth\Domain;

use Core\BoundedContext\Tenant\Role\Domain\Roles;

class Authenticated
{
    public function __construct(
        private Auth $auth,
        private Roles $roles
    ){}

    /**
     * Generate an Auth object from AuthToken, AuthId and AuthEmail value objects.
     *
     * @param Auth $auth
     * @param Roles $roles
     * @return Authenticated Auth object generated from the value objects.
     */
    public
    static function generateAuth(Auth $auth, Roles $roles): Authenticated
    {
        return new self(
            $auth,
            $roles
        );
    }

    /**
     * Gets the authentication token associated with this authentication information.
     *
     * @return Auth Value object representing the authentication token.
     */
    public function auth(): Auth
    {
        return $this->auth;
    }

    /**
     * Gets the authentication ID associated with this authentication information.
     *
     * @return Roles Value object representing the authentication ID.
     */
    public function roles(): Roles
    {
        return $this->roles;
    }

}
