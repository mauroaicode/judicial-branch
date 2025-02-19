<?php

namespace Core\BoundedContext\Tenant\Role\Infrastructure\Database\Seeders;

use Core\BoundedContext\Admin\Role\Infrastructure\Persistence\Eloquent\RoleModel;
use Illuminate\Database\Seeder;

class RoleModelTableSeed extends Seeder
{
    public function run()
    {
        RoleModel::create(['name' => 'Administrator']);
        RoleModel::create(['name' => 'Student']);
    }
}
