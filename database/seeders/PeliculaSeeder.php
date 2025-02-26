<?php

namespace Database\Seeders;
use App\Models\Pelicula;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeliculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */    public function run() {
        Pelicula::factory(10)->create();
    }
}
