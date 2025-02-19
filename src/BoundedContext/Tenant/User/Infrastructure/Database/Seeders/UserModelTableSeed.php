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
        // Usuario administrador
        UserModel::factory()->count(1)->create([

            'name' => 'Fernando',
            'last_name' => 'Puchana',
            'email' => 'fernando@aciudadablanca.com',
            'slug' => Str::slug(strtolower('Fernando') . '-' . strtolower('Puchana') . '-' . Str::random(10), '-'),

        ])->each(function (UserModel $user) {

            $role = RoleModel::findByName('Administrator');

            $user->roles()->attach($role->id); // Asignamos el rol administrador al usuario
        });
    }
}
