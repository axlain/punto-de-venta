<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartado>
 */
class ApartadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cliente' => $this->faker->name(),
            'fecha' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'total' => $this->faker->randomFloat(2, 50, 1500),
            'pagado' => $this->faker->boolean(30), 
        ];
    }
}
