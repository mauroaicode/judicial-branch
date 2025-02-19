<?php

namespace Core\BoundedContext\Tenant\Auth\Domain;

use Core\BoundedContext\Tenant\{
    Role\Domain\Roles,
    Auth\Domain\ValueObjects\AuthId,
    Auth\Domain\ValueObjects\AuthEmail,
    Auth\Domain\ValueObjects\AuthToken
};

class Auth
{
    public function __construct(
        private AuthToken $token,
        private AuthId    $id,
        private AuthEmail $email,
        private Roles     $roles
    ){}

    /**
     * Creates a new Auth object from its primitive components.
     *
     * @param string $token Authentication token.
     * @param string $id Authentication ID.
     * @param string $email Email address.
     *
     * @return Auth Auth object created with the primitive components.
     */
    public static function fromPrimitives(string $token, string $id, string $email, array $roles): self
    {
        return new self(
            new AuthToken($token),
            new AuthId($id),
            new AuthEmail($email),
            new Roles($roles)
        );
    }

    /**
     * Generate an Auth object from AuthToken, AuthId and AuthEmail value objects.
     *
     * @param AuthToken $token Value object representing the authentication token.
     * @param AuthId $id Value object representing the authentication ID.
     * @param AuthEmail $email Value object representing the email address.
     * @param Roles $roles
     * @return Auth Auth object generated from the value objects.
     */
    public static function generateAuth(AuthToken $token, AuthId $id, AuthEmail $email, Roles $roles): Auth
    {
        return new self(
            $token,
            $id,
            $email,
            $roles
        );
    }

    /**
     * Gets the authentication token associated with this authentication information.
     *
     * @return AuthToken Value object representing the authentication token.
     */
    public function token(): AuthToken
    {
        return $this->token;
    }

    /**
     * Gets the authentication ID associated with this authentication information.
     *
     * @return AuthId Value object representing the authentication ID.
     */
    public function id(): AuthId
    {
        return $this->id;
    }

    /**
     * Gets the e-mail address associated with this authentication information.
     *
     * @return AuthEmail Value object representing the email address.
     */
    public function email(): AuthEmail
    {
        return $this->email;
    }

    /**
     * Gets the roles associated with this authentication information.
     *
     * @return Roles A collection of roles associated with the authentication.
     */
    public function roles(): Roles
    {
        return $this->roles;
    }
}
