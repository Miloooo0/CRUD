<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use App\Models\Actor;

use Illuminate\Http\Request;
use App\Http\Requests\UpdatePeliculaRequest;
use Illuminate\Support\Facades\Validator;

class PeliculaController extends Controller
{
    /**
     * Protege las rutas, excepto index y show
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Muestra todas las películas
     */
    public function index()
    {
        $peliculas = Pelicula::all(); // Obtiene todas las películas
        return view('peliculas.index', compact('peliculas'));
    }

    /**
     * Muestra el formulario para crear una película
     */
    public function create()
    {
        $actores = Actor::all(); // Obtener todos los actores
        return view('peliculas.create', compact('actores'));
    }

    /**
     * Guarda una nueva película en la base de datos
     */
    public function store(UpdatePeliculaRequest $request) {
        $pelicula = Pelicula::create($request->all());
    
        // Solo agregar actores si existen en la solicitud
        if ($request->has('actores')) {
            $pelicula->actores()->sync(array_unique($request->input('actores'))); // Evita duplicados
        }
    
        return redirect()->route('peliculas.index')->with('success', 'Película agregada correctamente.');
    }
    
    /**
     * Muestra los detalles de una película y carga actores
     */
    public function show(Pelicula $pelicula) {
        $pelicula->load('actores'); // Cargar relación actores
        return view('pelicula.show', compact('pelicula'));
    }
    

    /**
     * Muestra el formulario para editar una película
     */
    public function edit(Pelicula $pelicula)
    {
        $actores = Actor::all(); // Obtener todos los actores
        return view('peliculas.edit', compact('pelicula', 'actores'));    }

    /**
     * Actualiza una película
     */
    public function update(UpdatePeliculaRequest $request, Pelicula $pelicula) {
        $pelicula->update($request->all());
    
        // Solo actualizar si se enviaron actores
        if ($request->has('actores')) {
            $pelicula->actores()->sync(array_unique($request->input('actores'))); // Evita duplicados
        }
    
        return redirect()->route('peliculas.index')->with('success', 'Película actualizada correctamente.');
    }
    
    /**
     * Elimina una película
     */
    public function destroy(Pelicula $pelicula)
    {
        $pelicula->delete();
        return redirect()->route('peliculas.index')->with('success', 'Película eliminada correctamente.');
    }

    public function import(Request $request)
    {
        try {
            // Validar si se subió un archivo
            if (!$request->hasFile('jsonFile')) {
                return back()->with('error', 'No se ha seleccionado ningún archivo.');
            }
    
            $file = $request->file('jsonFile');
            $data = json_decode(file_get_contents($file), true);
    
            if ($data === null) {
                return back()->with('error', 'El archivo JSON no es válido.');
            }
    
            // Procesar cada película
            foreach ($data as $item) {
                Pelicula::create([
                    'nombre' => $item['nombre'],
                    'director' => $item['director'],
                    'fecha' => $item['fecha'],
                    'duracion' => $item['duracion'],
                    'genero' => $item['genero'],
                    'idioma' => $item['idioma'],
                ]);
            }
    
            return back()->with('success', 'Películas importadas correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al importar alguno o todos los elementos');
        }
    }    
}
