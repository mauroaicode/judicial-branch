<?php

namespace Core\BoundedContext\Tenant\GenderIdentity\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\Factory;

class GenderIdentityModelFactory extends Factory
{
    protected $model = GenderIdentityModel::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'description' => $this->faker->sentence,
        ];
    }
}
