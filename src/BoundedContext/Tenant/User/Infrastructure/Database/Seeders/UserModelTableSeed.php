<?php

namespace Core\BoundedContext\Tenant\User\Infrastructure\Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Core\BoundedContext\Tenant\{Role\Infrastructure\Persistence\Eloquent\RoleModel, User\Infrastructure\Persistence\Eloquent\UserModel};

class UserModelTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $name = 'Edwin';
        $lastName = 'Jones';
        // Usuario administrador
        UserModel::factory()->count(1)->create([

            'name' => $name,
            'last_name' => $lastName,
            'email' => 'edwin@aciudadablanca.com',
            'slug' => Str::slug(strtolower($name) . '-' . strtolower($lastName) . '-' . Str::random(10), '-'),

        ])->each(function (UserModel $user) {

            $role = RoleModel::findByName('Administrator');

            $user->roles()->attach($role->id); // Asignamos el rol administrador al usuario
        });
    }
}
