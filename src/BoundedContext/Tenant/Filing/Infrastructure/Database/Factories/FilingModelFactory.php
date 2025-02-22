<?php

namespace Core\BoundedContext\Tenant\Filing\Infrastructure\Database\Factories;

use Core\BoundedContext\Tenant\Filing\Infrastructure\Persistence\Eloquent\FilingModel;
use Illuminate\Database\Eloquent\Factories\Factory;


class FilingModelFactory extends Factory
{
    protected $model = FilingModel::class;


    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
        ];
    }
}
