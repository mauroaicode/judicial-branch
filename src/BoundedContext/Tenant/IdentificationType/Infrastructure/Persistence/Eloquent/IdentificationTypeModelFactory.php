<?php

namespace Core\BoundedContext\Tenant\IdentificationType\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\Factory;

class IdentificationTypeModelFactory extends Factory
{
    protected $model = IdentificationTypeModel::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'description' => $this->faker->sentence,
        ];
    }
}
