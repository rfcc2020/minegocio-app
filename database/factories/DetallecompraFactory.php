<?php

namespace Database\Factories;

use App\Models\Detallecompra;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DetallecompraFactory extends Factory
{
    protected $model = Detallecompra::class;

    public function definition()
    {
        return [
			'compra_id' => $this->faker->name,
			'producto_id' => $this->faker->name,
			'cantidad' => $this->faker->name,
			'valor' => $this->faker->name,
			'total' => $this->faker->name,
        ];
    }
}
