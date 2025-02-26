<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pelicula;

/**
 * @extends Factory<Pelicula>
 */
class PeliculaFactory extends Factory
{
    /**
     * Define el modelo que esta fábrica va a generar.
     *
     * @var string
     */
    protected $model = Pelicula::class;

    /**
     * Define el estado por defecto del modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->sentence(3), // Genera un título de película
            'director' => $this->faker->name(),
            'fecha' => $this->faker->date('Y-m-d'),
            'duracion' => $this->faker->numberBetween(60, 240), // Minutos de duración
            'genero' => $this->faker->randomElement(['Acción', 'Drama', 'Comedia', 'Terror', 'Ciencia Ficción']),
            'idioma' => $this->faker->randomElement(['Español', 'Inglés', 'Francés', 'Alemán']),
        ];
    }
}
