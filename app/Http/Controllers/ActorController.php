<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActorRequest;
use App\Models\Actor;
use App\Models\Pelicula;
use Illuminate\Http\Request;

class ActorController extends Controller
{

    public function __construct()
{
    $this->middleware('auth')->except(['index']);
}


    // Muestra la lista de actores junto con sus películas
    public function index()
    {
        $actores = Actor::with('peliculas')->get();
        return view('actores.index', compact('actores'));
    }

    // Muestra el formulario para crear un nuevo actor
    public function create()
    {
        $peliculas = Pelicula::all(); // Obtiene todas las películas
        return view('actores.create', compact('peliculas'));
    }

    // Almacena un nuevo actor
    public function store(ActorRequest $request)
    {
        // Crear el actor con los datos validados
        $actor = Actor::create($request->validated());
    
        // Si hay películas seleccionadas, asociarlas con el actor
        if ($request->has('peliculas')) {
            $actor->peliculas()->sync($request->input('peliculas')); 
        }
    
        return redirect()->route('actores.index')->with('success', 'Actor creado correctamente');
    }
    
    // Muestra el formulario para editar un actor existente
    public function edit($id)
    {
        $actor = Actor::findOrFail($id);
        $peliculas = Pelicula::all(); // Obtener todas las películas
        return view('actores.edit', compact('actor', 'peliculas'));
    }
    
    // Actualiza un actor existente
    public function update(ActorRequest $request, $id)
    {
        $actor = Actor::findOrFail($id);
        $actor->update($request->all());
    
        if ($request->has('peliculas')) {
            $actor->peliculas()->sync(array_unique($request->input('peliculas')));
        }
    
        return redirect()->route('actores.index')->with('success', 'Actor actualizado correctamente');
    }

    // Elimina un actor
    public function destroy($id)
    {
        $actor = Actor::findOrFail($id);

        // Eliminar la relación en la tabla pivote antes de eliminar el actor
        $actor->peliculas()->detach();

        // Ahora eliminamos el actor
        $actor->delete();

        return redirect()->route('actores.index')->with('success', 'Actor eliminado correctamente.');
    }

}
