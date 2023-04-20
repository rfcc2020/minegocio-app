<?php

namespace Database\Factories;

use App\Models\Detalleventaservicio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DetalleventaservicioFactory extends Factory
{
    protected $model = Detalleventaservicio::class;

    public function definition()
    {
        return [
			'venta_id' => $this->faker->name,
			'servicio_id' => $this->faker->name,
			'cantidad' => $this->faker->name,
			'valor' => $this->faker->name,
			'total' => $this->faker->name,
        ];
    }
}
