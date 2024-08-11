<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Docente>
 */
class DocenteFactory extends Factory
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
            'ci_docente' => $this->faker->nationalId(),
            'nombre_docente' => $this->faker->name(),
            'apellido_docente' => $this->faker->lastName(),
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
