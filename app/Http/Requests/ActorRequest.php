<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer|min:1',
            'fecha_nacimiento' => 'required|date',
            'pais' => 'required|string|max:255',
            'peliculas' => 'array|required',
            'peliculas.*' => 'exists:peliculas,id'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'           => 'El nombre es obligatorio.',
            'edad.required'             => 'La edad es obligatoria.',
            'edad.integer'              => 'La edad debe ser un número entero.',
            'edad.min'                  => 'La edad debe ser mayor a 0.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date'     => 'La fecha de nacimiento debe ser una fecha válida.',
            'pais.required'             => 'El país es obligatorio.',
        ];
    }
}
