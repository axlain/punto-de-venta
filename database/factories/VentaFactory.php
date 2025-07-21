<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venta>
 */
class VentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'total' => $this->faker->randomFloat(2, 100, 2000),
            'user_id' => \App\Models\User::inRandomOrder()->value('id'),

        ];
    }
}
