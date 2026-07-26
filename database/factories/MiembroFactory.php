<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Miembro>
 */
class MiembroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'iglesia_id' => fake()->numerify(),
            'iglesia_id' => \App\Models\Iglesia::inRandomOrder()->value('id'),
            'nombre' => fake()->name(),
            'nombre_whatsapp' => fake()->name(),
            'telefono' => fake()->phoneNumber(),
            // 'email' => fake()->safeEmail(),
            'estado' => true,
        ];
    }
}
