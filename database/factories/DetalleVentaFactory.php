<?php

namespace Database\Factories;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetalleVenta>
 */
class DetalleVentaFactory extends Factory
{
    public function definition(): array
    {
        $producto = Producto::inRandomOrder()->first();

        return [
            'venta_id' => Venta::inRandomOrder()->value('id'),
            'producto_id' => $producto?->id ?? Producto::factory(),
            'cantidad' => $this->faker->numberBetween(1, 5),
            'precio_unitario' => $producto?->precio ?? $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
