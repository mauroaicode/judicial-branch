<?php

namespace Core\BoundedContext\Tenant\Auth\Domain\Contracts;

use Core\BoundedContext\Tenant\Auth\Domain\Credentials;

interface AuthRepositoryContract
{
    /**
     * Performs a login attempt with the credentials provided.
     *
     * @param Credentials $credentials The user's credentials for the login.
     *
     * @return object An object representing the authenticated user's information.
     */
    public function login(Credentials $credentials): object;

    /**
     * Logs out the user's current session.
     *
     * @return string A confirmation message or indication of successful logout.
     */
    public function logout(): string;
}
