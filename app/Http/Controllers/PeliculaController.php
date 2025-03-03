<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use App\Models\Actor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePeliculaRequest;

class PeliculaController extends Controller
{
    /**
     * Protege las rutas, excepto index y show
     */

     public function __construct()
     {
         $this->middleware('auth')->except(['index']);
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
        $pelicula->update(attributes: $request->all());
    
        // Solo actualizar si se enviaron actores
        if ($request->has('actores')) {
            $pelicula->actores()->sync(array_unique($request->input('actores'))); // Evita duplicados
        }
    
        return redirect()->route('peliculas.index')->with('success', 'Película actualizada correctamente.');
    }



    // Mostrar la vista de importación
    public function importView()
    {
        return view('peliculas.import');
    }

    // Procesar el archivo JSON
    public function import(Request $request)
    {
        // Validar que el archivo es JSON
        $request->validate([
            'json_file' => 'required|file|mimes:json|max:2048',
        ]);

        // Leer el archivo JSON
        $jsonFile = $request->file('json_file');
        $jsonData = file_get_contents($jsonFile->getPathname());
        $data = json_decode($jsonData, true);

        // Verificar que el JSON es válido
        if (!is_array($data)) {
            return back()->withErrors(['json_file' => 'El archivo JSON no es válido']);
        }

        // Guardar las películas en la base de datos
        foreach ($data as $item) {
            Pelicula::create([
                'nombre'   => $item['nombre'],
                'director' => $item['director'],
                'fecha'    => $item['fecha'],
                'duracion' => $item['duracion'],
                'genero'   => $item['genero'],
                'idioma'   => $item['idioma'],
            ]);
        }

        return redirect()->back()->with('success', 'Películas importadas correctamente.');
    }
    /**
     * Elimina una película
     */
    public function destroy(Pelicula $pelicula)
    {
        $pelicula->delete();
        return redirect()->route('peliculas.index')->with('success', 'Película eliminada correctamente.');
    }
}
