<?php

namespace Database\Factories;

use App\Models\Compra;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompraFactory extends Factory
{
    protected $model = Compra::class;

    public function definition()
    {
        return [
			'proveedor_id' => $this->faker->name,
			'fecha' => $this->faker->name,
			'subtotal' => $this->faker->name,
			'descuento' => $this->faker->name,
			'iva' => $this->faker->name,
			'total' => $this->faker->name,
			'observacion' => $this->faker->name,
			'user_id' => $this->faker->name,
        ];
    }
}
