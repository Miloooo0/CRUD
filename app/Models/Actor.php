<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model {
    use HasFactory;
    protected $fillable = ['nombre', 'edad', 'fecha_nacimiento', 'pais'];
    protected $table = 'actors'; // Asegura que Laravel use el nombre correcto
    public function peliculas()
    {
        return $this->belongsToMany(Pelicula::class, 'actor_pelicula');
    }
}