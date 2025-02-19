<?php

namespace Core\BoundedContext\Admin\User\Infrastructure\Database\Seeders;

use Core\BoundedContext\Admin\Role\Infrastructure\Persistence\Eloquent\RoleModel;
use Core\BoundedContext\Admin\User\Infrastructure\Persistence\Eloquent\UserModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserModelTableSeed extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Usuario administrador
        UserModel::factory()->count(1)->create([
            'name' => 'Mauricio',
            'last_name' => 'Gutierrez',
            'email' => 'developer.mauricio2310@gmail.com',
            'slug' => Str::slug(strtolower('Mauricio') . '-' . strtolower('Gutierrez') . '-' . Str::random(10), '-'),
        ])->each(function (UserModel $user) {

            $role = RoleModel::findByName('Administrator');

            $user->roles()->attach($role->id); // Asignamos el rol administrador al usuario
        });;
    }
}
