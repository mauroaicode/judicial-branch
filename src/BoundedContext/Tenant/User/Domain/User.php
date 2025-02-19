<?php

namespace Core\BoundedContext\Tenant\User\Domain;

use Core\BoundedContext\Tenant\User\Domain\ValueObjects\UserEmail;
use Core\BoundedContext\Tenant\User\Domain\ValueObjects\UserId;

class User
{
    public function __construct(
        private UserId $id,
        private UserEmail $email,
    )
    {}

    public static function fromPrimitives(string $id, string $email): self
    {
        return new self(
            new UserId($id),
            new UserEmail($email)
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
}

