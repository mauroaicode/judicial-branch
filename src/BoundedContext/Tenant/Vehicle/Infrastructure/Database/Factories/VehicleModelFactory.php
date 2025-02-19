<?php

namespace Core\BoundedContext\Tenant\Vehicle\Infrastructure\Database\Factories;

use Core\BoundedContext\Tenant\Vehicle\Infrastructure\Persistence\Eloquent\VehicleModel;
use Illuminate\Database\Eloquent\Factories\Factory;


class VehicleModelFactory extends Factory
{
    protected $model = VehicleModel::class;


    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
        ];
    }
}
