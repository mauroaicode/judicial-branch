<?php

namespace Core\BoundedContext\Admin\User\Application\Response;

use Core\BoundedContext\Admin\User\Domain\User;

class UserResponse
{


    public function __construct(private string $id, private string $email){}

    public static function fromUser(User $user): self
    {
        return new self(
            $user->id()->value(),
            $user->email()->value(),
        );
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }
}
