<?php

namespace Core\BoundedContext\Tenant\Auth\Domain;

use Core\BoundedContext\Tenant\Auth\Domain\ValueObjects\{AuthEmail, AuthPassword};

final class Credentials
{
    public function __construct(private AuthEmail $email, private AuthPassword $password){}

    /**
     * Creates a new Credentials object with the credentials provided.
     *
     * @param AuthEmail $email Value object representing the email address.
     * * @param AuthPassword $password Value object representing the user's password.
     *
     * @return Credentials Credentials object created with the specified credentials.
     */
    public static function signIn(AuthEmail $email, AuthPassword $password): self
    {
        return new self(
            $email,
            $password
        );
    }

    /**
     * Gets the e-mail address associated with the credentials.
     *
     * @return AuthEmail Value object representing the email address.
     */
    public function email(): AuthEmail
    {
        return $this->email;
    }

    /**
     * Gets the password associated with the credentials.
     *
     * @return AuthPassword Value object representing the user's password.
     */
    public function password(): AuthPassword
    {
        return $this->password;
    }
}
