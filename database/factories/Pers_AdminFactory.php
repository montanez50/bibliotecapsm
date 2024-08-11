<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Pers_AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static ?string $password;
    public function definition(): array
    {
        return [
            'ci_pers-admin' => $this->faker->nationalId(),
            'nombre_pers-admin' => $this->faker->name(),
            'apellido_pers-admin' => $this->faker->lastName(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10)
        ];
    }
}
