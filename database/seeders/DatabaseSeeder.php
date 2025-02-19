<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Core\BoundedContext\Admin\Role\Infrastructure\Database\Seeders\RoleModelTableSeed;
use Core\BoundedContext\Admin\User\Infrastructure\Database\Seeders\UserModelTableSeed;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleModelTableSeed::class,
            UserModelTableSeed::class

        ]);
    }
}
