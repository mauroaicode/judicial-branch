<?php

namespace Core\BoundedContext\Tenant\User\Infrastructure\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Core\BoundedContext\Tenant\User\Infrastructure\Persistence\Eloquent\UserModel;

class UserModelFactory extends Factory
{
    protected $model = UserModel::class;

    public function definition(): array
    {
        $name = $this->faker->name();
        $lastName = $this->faker->lastName;
        return [
            'id' => $this->faker->uuid,
            'name' => $name,
            'last_name' => $lastName,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'slug' => Str::slug(strtolower($name) . '-' . strtolower($lastName) . Str::random(5), '-'),
        ];
    }
}
