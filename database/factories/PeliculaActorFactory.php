<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Actor;
use App\Models\Pelicula;

class PeliculaActorFactory extends Factory
{
    public function definition()
    {
        return [
            'actor_id' => Actor::inRandomOrder()->first()->id ?? Actor::factory(),
            'pelicula_id' => Pelicula::inRandomOrder()->first()->id ?? Pelicula::factory(),
        ];
    }
}
