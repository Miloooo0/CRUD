<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Actor;

/**
 * @extends Factory<Actor>
 */
class ActorFactory extends Factory
{
    /**
     * Define el modelo que esta fábrica va a generar.
     *
     * @var string
     */
    protected $model = Actor::class;

    /**
     * Define el estado por defecto del modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(), // Genera un título de película
            'edad' => $this->faker->numberBetween(60, 240),
            'fecha_nacimiento' => $this->faker->date('Y-m-d'),
            'pais' => $this->faker->randomElement(['España', 'Reino Unido', 'Francia', 'Alemania']),
        ];
    }
}
