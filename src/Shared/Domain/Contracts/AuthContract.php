<?php

namespace Core\Shared\Domain\Contracts;

interface AuthContract
{
    /**
     * Credentials the user with the credentials provided.
     *
     * @param array $credentials The authentication credentials.
     * @param string $type The type of authentication guard to use.
     * @return bool True if authentication is successful, false otherwise.
     */
    public function authenticate(array $credentials, string $type): bool;

    /**
     * Generate a token for the authenticated user.
     *
     * @param string $type The type of authentication guard to use.
     * @return string The generated token.
     */
    public function generateToken(string $type): string;

    /**
     * Get the authenticated user.
     *
     * @param string $type The type of authentication guard to use.
     * @return mixed The authenticated user, or null if not authenticated.
     */
    public function getAuthenticatedUser(string $type): mixed;

    /**
     * Log out the user.
     *
     * @param string $type The type of authentication guard to use.
     * @return void
     */
    public function logout(string $type): void;
}
