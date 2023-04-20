<?php

namespace Database\Factories;

use App\Models\Detalleventaproducto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DetalleventaproductoFactory extends Factory
{
    protected $model = Detalleventaproducto::class;

    public function definition()
    {
        return [
			'venta_id' => $this->faker->name,
			'producto_id' => $this->faker->name,
			'cantidad' => $this->faker->name,
			'valor' => $this->faker->name,
			'total' => $this->faker->name,
        ];
    }
}
