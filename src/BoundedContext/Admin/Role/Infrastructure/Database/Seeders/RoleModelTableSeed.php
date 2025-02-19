<?php

namespace Core\BoundedContext\Admin\Role\Infrastructure\Database\Seeders;

use Illuminate\Database\Seeder;
use Core\BoundedContext\Admin\Role\Infrastructure\Persistence\Eloquent\RoleModel;

class RoleModelTableSeed extends Seeder
{
    public function run()
    {
        RoleModel::create(['name' => 'Administrator']);
    }
}
