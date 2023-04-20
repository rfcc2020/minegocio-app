<?php

namespace Database\Factories;

use App\Models\Saldo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SaldoFactory extends Factory
{
    protected $model = Saldo::class;

    public function definition()
    {
        return [
			'venta_id' => $this->faker->name,
			'valor' => $this->faker->name,
			'estado' => $this->faker->name,
        ];
    }
}
