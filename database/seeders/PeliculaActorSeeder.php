<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Actor;
use App\Models\Pelicula;

class PeliculaActorSeeder extends Seeder
{
    public function run()
    {
        $actores = Actor::all();
        $peliculas = Pelicula::all();

        // Verificar que hay actores y películas
        if ($actores->count() === 0 || $peliculas->count() === 0) {
            return;
        }

        // Asignar aleatoriamente actores a películas
        foreach ($peliculas as $pelicula) {
            $pelicula->actores()->attach(
                $actores->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
