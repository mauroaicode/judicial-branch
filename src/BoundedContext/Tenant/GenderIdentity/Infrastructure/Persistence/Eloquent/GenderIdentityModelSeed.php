<?php

namespace Core\BoundedContext\Tenant\GenderIdentity\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Seeder;

class GenderIdentityModelSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*=============================================
             CREAMOS GÉNEROS
         =============================================*/
        GenderIdentityModel::factory()->count(1)->create([
            'name' => 'Masculino'
        ]);
        GenderIdentityModel::factory()->count(1)->create([
            'name' => 'Femenino'
        ]);
        GenderIdentityModel::factory()->count(1)->create([
            'name' => 'Otro'
        ]);
    }
}
