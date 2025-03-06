<?php
namespace App\Http\Controllers\Api;

use App\Models\Pelicula;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PeliculaResource;

class PeliculaController extends Controller
{
    public function index()
    {
        // return PeliculaResource::collection(Pelicula::paginate(10));
        return response()->json(Pelicula::with('actores')->get(), 200);
    }
    
    // public function show($id)
    // {
    //     $pelicula = Pelicula::find($id);
    //     if (!$pelicula) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Película no encontrada'
    //         ], Response::HTTP_NOT_FOUND);
    //     }
    
    //     return new PeliculaResource($pelicula);
    // }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'fecha' => 'required|date',
            'duracion' => 'required|integer|min:1',
            'genero' => 'required|string|max:100',
            'idioma' => 'required|string|max:100',
            'actores' => 'array',
            'actores.*' => 'exists:actors,id',
        ]);

        $pelicula = Pelicula::create($validated);
        $pelicula->actores()->sync($request->actores ?? []);

        return response()->json($pelicula->load('actores'), 201);
    }

    public function show(Pelicula $pelicula)
    {
        return response()->json($pelicula->load('actores'), 200);
    }

    public function update(Request $request, Pelicula $pelicula)
    {
        $validated = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'director' => 'sometimes|required|string|max:255',
            'fecha' => 'sometimes|required|date',
            'duracion' => 'sometimes|required|integer|min:1',
            'genero' => 'sometimes|required|string|max:100',
            'idioma' => 'sometimes|required|string|max:100',
            'actores' => 'array',
            'actores.*' => 'exists:actors,id',
        ]);

        $pelicula->update($validated);
        if ($request->has('actores')) {
            $pelicula->actores()->sync($request->actores);
        }

        return response()->json($pelicula->load('actores'), 200);
    }

    public function destroy(Pelicula $pelicula)
    {
        $pelicula->delete();
        return response()->json(['message' => 'Película eliminada'], 200);
    }
}

