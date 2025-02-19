<?php

namespace Core\Shared\Infrastructure\Persistence\Auth\Jwt;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Core\Shared\Domain\Contracts\AuthContract;
use Illuminate\Contracts\Auth\Authenticatable;


final class AuthJwt implements AuthContract
{
    /**
     * Credentials the user with the credentials provided.
     *
     * @param array $credentials The authentication credentials.
     * @param string $type The type of authentication guard to use.
     * @return bool True if authentication is successful, false otherwise.
     */
    public function authenticate(array $credentials, string $type): bool
    {
        return Auth::guard($type)->attempt($credentials);
    }

    /**
     * Generate a JWT token for the authenticated user.
     *
     * @param string $type The type of authentication guard to use.
     * @return string The generated JWT token.
     */
    public function generateToken(string $type): string
    {
        $authUser = $this->getAuthenticatedUser($type);

        return JWTAuth::fromUser($authUser);
    }

    /**
     * Get the authenticated user.
     *
     * @param string $type The type of authentication guard to use.
     * @return Authenticatable|null The authenticated user or null if not authenticated.
     */
    public function getAuthenticatedUser(string $type): ?Authenticatable
    {
        return Auth::guard($type)->user();
    }

    /**
     * Log out the user.
     *
     * @param string $type The type of authentication guard to use.
     * @return void
     */
    public function logout(string $type): void
    {
        Auth::guard($type)->logout();
    }
}
