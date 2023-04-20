<?php

namespace Database\Factories;

use App\Models\Venta;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VentaFactory extends Factory
{
    protected $model = Venta::class;

    public function definition()
    {
        return [
			'cliente_id' => $this->faker->name,
			'fecha' => $this->faker->name,
			'subtotal' => $this->faker->name,
			'descuento' => $this->faker->name,
			'iva' => $this->faker->name,
			'total' => $this->faker->name,
			'pagado' => $this->faker->name,
			'saldo' => $this->faker->name,
			'observacion' => $this->faker->name,
			'user_id' => $this->faker->name,
        ];
    }
}
