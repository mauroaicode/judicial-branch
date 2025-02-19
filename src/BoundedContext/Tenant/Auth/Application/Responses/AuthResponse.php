<?php

namespace Core\BoundedContext\Tenant\Auth\Application\Responses;

use Core\BoundedContext\Tenant\Auth\Domain\Auth;
use Core\BoundedContext\Tenant\Role\{Applications\Responses\RolesResponse, Domain\Roles};

final class AuthResponse
{
    public function __construct(
        private string $token,
        private string $id,
        private string $email,
        private Roles  $roles
    ){}

    /**
     * Creates an instance of AuthResponse from an Auth object.
     *
     * @param Auth $authenticated Object containing authentication information.
     *
     * @return AuthResponse Instance of AuthResponse created from the Auth object.
     */
    public static function fromAuthenticated(Auth $authenticated): self
    {
        return new self(
            token: $authenticated->token()->value(),
            id: $authenticated->id()->value(),
            email: $authenticated->email()->value(),
            roles: $authenticated->roles()
        );
    }

    /**
     * Gets the authentication token.
     *
     * @return string Authentication token.
     */
    public function token(): string
    {
        return $this->token;
    }

    /**
     * Gets the authentication ID.
     *
     * @return string Authentication ID.
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * Gets the e-mail address.
     *
     * @return string E-mail address.
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * Converts the response into an associative array for representation.
     *
     * @return array Associative array representing the response.
     */
    public function toArray(): array
    {
        return [
            'token' => $this->token,
            'user' => (object)[
                'id' => $this->id,
                'email' => $this->email,
            ],
            'roles' => RolesResponse::fromRoles($this->roles)->toArray()
        ];
    }
}
