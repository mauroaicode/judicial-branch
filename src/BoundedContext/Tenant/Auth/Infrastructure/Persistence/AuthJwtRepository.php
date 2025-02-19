<?php

namespace Core\BoundedContext\Tenant\Auth\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Core\Shared\Domain\Contracts\AuthContract;
use Core\BoundedContext\Tenant\Auth\Domain\{Auth,
    Credentials,
    Contracts\AuthRepositoryContract,
    Exceptions\IncorrectCredentialsException,
};
use Core\BoundedContext\Tenant\User\Infrastructure\Persistence\Eloquent\UserModel;
use Core\BoundedContext\Tenant\Role\{Domain\Role, Infrastructure\Persistence\Eloquent\RoleModel};


class AuthJwtRepository implements AuthRepositoryContract
{
    const TYPE_AUTH = 'tenant';

    public function __construct(private AuthContract $authContract){}

    /**
     * Converts an Eloquent user model and a collection of Eloquent role models into a domain Auth object.
     *
     * @param string $token The authentication token for the user.
     * @param UserModel $user An instance of the `UserModel` class representing the authenticated user.
     * @param array $roles An array of `RoleModel` objects representing the user's roles.
     *
     * @return Auth An instance of the `Auth` domain object containing the authentication token, user ID, email, and roles.
     */
    private function toDomainUser(string $token, UserModel $user, array $roles): Auth
    {
        return Auth::fromPrimitives($token, $user->id, $user->email, $roles);
    }

    /**
     * Converts a collection of Eloquent role models into an array of domain Role objects.
     *
     * @param Collection $roles A collection of `RoleModel` objects representing the roles to be converted.
     * @return array An array of `Role` domain objects representing the roles.
     */
    private function toDomainRoles(Collection $roles): array
    {
        return $roles->map(
            function (RoleModel $roleModel) {
                return Role::fromPrimitives($roleModel->id, $roleModel->name);
            }
        )->toArray();
    }

    /**
     * Performs the login process and generates an authentication token.
     *
     * @param Credentials $credentials
     * @return Auth An object with the authentication token and the authenticated user's data.
     * @throws IncorrectCredentialsException If the credentials are incorrect, an exception is thrown.
     */
    public function login(Credentials $credentials): Auth
    {
        $credentials = [
            'email' => $credentials->email()->value(),
            'password' => $credentials->password()->value()
        ];

        $isAuthenticated = $this->authContract->authenticate($credentials, self::TYPE_AUTH);

        if (!$isAuthenticated) {
            throw new IncorrectCredentialsException('', Response::HTTP_UNAUTHORIZED);
        }

        $token = $this->authContract->generateToken(self::TYPE_AUTH);

        $user = $this->authContract->getAuthenticatedUser(self::TYPE_AUTH);

        $roles = $this->toDomainRoles($user->roles);

        return $this->toDomainUser($token, $user, $roles);
    }

    /**
     * Logs the user out and returns a confirmation message.
     *
     * @return string Logout confirmation message.
     */
    public function logout(): string
    {
        $this->authContract->logout(self::TYPE_AUTH);
        return 'Ha cerrado sesión';
    }
}
