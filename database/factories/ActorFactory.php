<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Actor;

class ActorFactory extends Factory
{
    protected $model = Actor::class;

    public function definition(): array
    {
        $actores = [
            'Leonardo DiCaprio', 'Meryl Streep', 'Robert De Niro', 'Scarlett Johansson', 
            'Tom Hanks', 'Natalie Portman', 'Morgan Freeman', 'Angelina Jolie',
            'Johnny Depp', 'Brad Pitt', 'Denzel Washington', 'Jennifer Lawrence',
            'Will Smith', 'Nicole Kidman', 'Al Pacino', 'Julia Roberts',
            'Harrison Ford', 'Charlize Theron', 'Keanu Reeves', 'Anne Hathaway',
            'Samuel L. Jackson', 'Emma Stone', 'Benedict Cumberbatch', 'Cate Blanchett',
            'Christian Bale', 'Hugh Jackman', 'Joaquin Phoenix', 'Sandra Bullock',
            'Chris Hemsworth', 'Matt Damon', 'Javier Bardem', 'Penélope Cruz'
        ];

        return [
            'nombre' => $this->faker->randomElement($actores), // Elegir un actor real de la lista
            'edad' => $this->faker->numberBetween(30, 90), // Edad más realista para actores
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-90 years', '-30 years')->format('Y-m-d'), 
            'pais' => $this->faker->randomElement(['Estados Unidos', 'Reino Unido', 'España', 'Francia', 'Alemania', 'México', 'Italia'])
        ];
    }
}
