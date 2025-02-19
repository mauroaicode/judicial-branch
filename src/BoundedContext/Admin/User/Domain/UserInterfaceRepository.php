<?php

namespace Core\BoundedContext\Admin\User\Domain;

use Core\BoundedContext\Admin\User\Domain\ValueObjects\{
    UserId,
    UserEmail
};

interface UserInterfaceRepository
{

//    public function list(): User;
//
//    public function save(User $user): void;
//
//    public function find(UserId $id): ?User;

    public function findForEmail(UserEmail $email): ?User;

//    public function delete(UserId $id): void;
}
