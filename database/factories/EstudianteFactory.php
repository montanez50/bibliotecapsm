<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estudiante>
 */
class EstudianteFactory extends Factory
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
            'ci_estudiante' => $this->faker->nationalId(),
            'nombre_estudiante' => $this->faker->name(),
            'apellido_estudiante' => $this->faker->lastName(),
            'especialidad' => $this->faker->randomElement(['arquitectura', 
                                                            'sistemas', 
                                                            'civil', 
                                                            'mecánica',
                                                            'eléctrica',
                                                            'electrónica',
                                                            'mto. mecánico']),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10)
        ];
    }
}
