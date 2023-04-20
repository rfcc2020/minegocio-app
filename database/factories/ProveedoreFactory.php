<?php

namespace Database\Factories;

use App\Models\Proveedore;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProveedoreFactory extends Factory
{
    protected $model = Proveedore::class;

    public function definition()
    {
        return [
			'cedula' => $this->faker->name,
			'nombre' => $this->faker->name,
			'direccion' => $this->faker->name,
			'telefono' => $this->faker->name,
			'email' => $this->faker->name,
			'foto' => $this->faker->name,
        ];
    }
}
