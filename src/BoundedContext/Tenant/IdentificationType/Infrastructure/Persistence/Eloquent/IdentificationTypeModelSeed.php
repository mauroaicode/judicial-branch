<?php

namespace Core\BoundedContext\Tenant\IdentificationType\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Seeder;

class IdentificationTypeModelSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*=============================================
             CREAMOS LOS TIPOS DE DOCUMENTO
         =============================================*/
        IdentificationTypeModel::factory()->count(1)->create([
            'name' => 'Cédula de Ciudadanía'
        ]);
        IdentificationTypeModel::factory()->count(1)->create([
            'name' => 'Cédula de Extranjería'
        ]);
        IdentificationTypeModel::factory()->count(1)->create([
            'name' => 'Tarjeta de Identidad'
        ]);
    }
}
