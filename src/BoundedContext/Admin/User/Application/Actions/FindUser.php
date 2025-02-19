<?php

namespace Core\BoundedContext\Admin\User\Application\Actions;

use Core\BoundedContext\Admin\User\Application\Response\UserResponse;
use Core\BoundedContext\Admin\User\Domain\UserInterfaceRepository;
use Core\BoundedContext\Admin\User\Domain\ValueObjects\UserEmail;

class FindUser
{
    private $repository;

    public function __construct(UserInterfaceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $email): UserResponse
    {
        $email = new UserEmail($email);
        $user = $this->repository->findForEmail($email);

        return UserResponse::fromGame($user);
    }
}
