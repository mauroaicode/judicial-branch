<?php

namespace Core\BoundedContext\Tenant\Filing\Infrastructure\Database\Seeders;

use Core\BoundedContext\Tenant\Filing\Infrastructure\Persistence\Eloquent\FilingModel;
use Illuminate\Database\Seeder;

class FilingModelTableSeed extends Seeder
{
    public function run()
    {
        FilingModel::factory()->count(1)->create([
            'code' => '76001310301420230025400'
        ]);
    }
}
