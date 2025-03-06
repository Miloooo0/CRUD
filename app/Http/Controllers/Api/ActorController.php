<?php
namespace App\Http\Controllers\Api;

use App\Models\Actor;
use App\Http\Resources\ActorResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActorController extends Controller
{

    public function index()
    {
        // return ActorResource::collection(Actor::all());
        return response()->json(Actor::all(), 200);
        // return ActorResource::collection(Actor::paginate(10));
    }
    
    // public function show($id)
    // {
    //     $actor = Actor::find($id);
    //     if (!$actor) {
    //         return response()->json(['message' => 'Actor no encontrado'], 404);
    //     }
    
    //     return new ActorResource($actor);
    // }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer|min:1|max:125',
            'fecha_nacimiento' => 'required|date|before_or_equal:1900-01-01',
            'pais' => 'required|string|max:255',
        ]);

        $actor = Actor::create($validated);
        return response()->json($actor, 201);
    }

    public function show(Actor $actor)
    {
        return response()->json($actor, 200);
    }

    public function update(Request $request, Actor $actor)
    {
        $validated = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'edad' => 'sometimes|required|integer|min:1|max:125',
            'fecha_nacimiento' => 'sometimes|required|date|before_or_equal:1900-01-01',
            'pais' => 'sometimes|required|string|max:255',
        ]);

        $actor->update($validated);
        return response()->json($actor, 200);
    }

    public function destroy(Actor $actor)
    {
        $actor->delete();
        return response()->json(['message' => 'Actor eliminado'], 200);
    }
}
