<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Iglesia>
 */
class IglesiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->name(),
            'direccion' => fake()->address(),
            'ciudad' => fake()->city(),
            // 'email' => fake()->safeEmail(),
            'estado' => true,
        ];
    }
}
