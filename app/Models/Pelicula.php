<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model {
    use HasFactory;
    protected $fillable = ['nombre', 'director', 'fecha', 'duracion','genero', 'idioma'];


    public function actores() {
        return $this->belongsToMany(Actor::class, 'actor_pelicula');
    }
}
