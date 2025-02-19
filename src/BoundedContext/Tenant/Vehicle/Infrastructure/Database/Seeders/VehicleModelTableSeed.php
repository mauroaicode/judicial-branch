<?php

namespace Core\BoundedContext\Tenant\Vehicle\Infrastructure\Database\Seeders;

use Core\BoundedContext\Tenant\User\Infrastructure\Persistence\Eloquent\UserModel;
use Core\BoundedContext\Tenant\Vehicle\Infrastructure\Persistence\Eloquent\VehicleModel;
use Illuminate\Database\Seeder;

class VehicleModelTableSeed extends Seeder
{
    public function run()
    {
        $user = UserModel::where('name', 'Fernando')->first();

        VehicleModel::factory()->count(1)->create([
            'brand' => 'Kia',
            'year' => '2020',
            'model' => 'Rio',
            'badge' => 'JRQ 378',
            'motor_number' => 'HR16-086097V',
            'create_user_id' => $user->id
        ]);

        VehicleModel::factory()->count(1)->create([
            'brand' => 'Kia',
            'year' => '2021',
            'model' => 'Picanto',
            'badge' => 'ZGO 465',
            'motor_number' => 'HR16-986452V',
            'create_user_id' => $user->id
        ]);
    }
}
