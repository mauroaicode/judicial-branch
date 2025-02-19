<?php

namespace Core\BoundedContext\Admin\User\Infrastructure\Persistence\Eloquent;

use Core\BoundedContext\Admin\User\Domain\User;
use Core\BoundedContext\Admin\User\Domain\UserInterfaceRepository;
use Core\BoundedContext\Admin\User\Domain\ValueObjects\UserEmail;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository implements UserInterfaceRepository
{
    private $model;

    public function __construct(UserModel $model)
    {
        $this->model = $model; //Obtenemos el modelo el cual tiene funcionalidades de eloquent
    }

    //Para recibir los valores primitivos
    private function toDomain(UserModel $eloquentUserModel): User
    {
        return User::fromPrimitives(
            $eloquentUserModel->id,
            $eloquentUserModel->email,
            $eloquentUserModel->password
        );
    }

//    public function list(): User
//    {
//        // TODO: Implement list() method.
//    }
//
//    public function save(User $user): void
//    {
//        // TODO: Implement save() method.
//    }
//
//    public function find(UserId $id): ?User
//    {
//
//    }
//
//    public function delete(UserId $id): void
//    {
//        // TODO: Implement delete() method.
//    }

    public function findForEmail(UserEmail $email): ?User
    {
        $userModel = $this->model->whereEmail($email->value())->first();
        return $this->toDomain($userModel);
    }
}
