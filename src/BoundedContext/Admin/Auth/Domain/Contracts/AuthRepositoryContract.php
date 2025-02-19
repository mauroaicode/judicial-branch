<?php

namespace Core\BoundedContext\Admin\Auth\Domain\Contracts;

use Core\BoundedContext\Admin\Auth\Domain\Credentials;

interface AuthRepositoryContract
{
    public function login(Credentials $credentials): object;

    public function logout();
}
