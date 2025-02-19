<?php

namespace Core\BoundedContext\Admin\User\Domain;

use Core\BoundedContext\Admin\User\Domain\ValueObjects\{UserId, UserEmail, UserPassword};


class User
{
    public function __construct(
        private UserId $id,
        private UserEmail $email,
        private UserPassword $password,
    )
    {}

    public static function fromPrimitives(string $id, string $email, string $password): self
    {
        return new self(
            new UserId($id),
            new UserEmail($email),
            new UserPassword($password),
        );
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }
    public function password(): UserPassword
    {
        return $this->password;
    }
}
