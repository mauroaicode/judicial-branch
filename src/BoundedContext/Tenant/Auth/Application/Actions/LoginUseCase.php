<?php

namespace Core\BoundedContext\Tenant\Auth\Application\Actions;

use Core\BoundedContext\Tenant\Auth\Application\Responses\AuthResponse;
use Core\BoundedContext\Tenant\Auth\Domain\ValueObjects\{AuthEmail, AuthPassword};
use Core\BoundedContext\Tenant\Auth\Domain\{Auth, Credentials, Contracts\AuthRepositoryContract};

final class LoginUseCase
{
    public function __construct(private AuthRepositoryContract $authRepository){}

    /**
     * Performs user authentication using the credentials provided.
     *
     * @param string $email
     * @param string $password
     * @return AuthResponse An object with the authentication token and the authenticated user's data.
     */
    public function __invoke(string $email, string $password): AuthResponse
    {
        $email = new AuthEmail($email);
        $password = new AuthPassword($password);

        $credentials = Credentials::signIn($email, $password);

        $response = $this->authRepository->login($credentials);

        $authenticated = Auth::generateAuth($response->token(), $response->id(), $response->email(), $response->roles());

        return AuthResponse::fromAuthenticated($authenticated);
    }

}
