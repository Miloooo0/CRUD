<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePeliculaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Ctrueontracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'nombre' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'fecha' => 'required|date',
            'duracion' => 'required|integer|min:1',
            'genero' => 'required|string|max:255',
            'idioma' => 'required|string|max:255',
            'actores' => 'array',
            'actores.*' => 'distinct|exists:actors,id', // Evita duplicados
        ];
    }
    

    public function messages()
    {
        return [
            // 'nombre.required' => 'El nombre es obligatorio.', ESTOS SON OMISIBLES POR SER POR DEFECTO
            ];
    }
}
