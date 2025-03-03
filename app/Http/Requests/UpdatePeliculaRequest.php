<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePeliculaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre'   => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'fecha'    => 'required|date',
            'duracion' => 'required|integer|min:1',
            'genero'   => 'required|string|max:100',
            'idioma'   => ['required', 'string', 'max:255', Rule::in($this->paisesDisponibles())],
            'actores'  => 'required|array',
            'actores.*' => 'exists:actors,id'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'   => 'El nombre de la película es obligatorio.',
            'nombre.string'     => 'El nombre debe ser una cadena de texto.',
            'nombre.max'        => 'El nombre no debe superar los 255 caracteres.',

            'director.required' => 'El director es obligatorio.',
            'director.string'   => 'El nombre del director debe ser una cadena de texto.',
            'director.max'      => 'El nombre del director no debe superar los 255 caracteres.',

            'fecha.required'    => 'La fecha de estreno es obligatoria.',
            'fecha.date'        => 'La fecha de estreno debe ser una fecha válida.',

            'duracion.required' => 'La duración de la película es obligatoria.',
            'duracion.integer'  => 'La duración debe ser un número entero en minutos.',
            'duracion.min'      => 'La duración debe ser mayor a 0 minutos.',

            'genero.required'   => 'El género de la película es obligatorio.',
            'genero.string'     => 'El género debe ser una cadena de texto.',
            'genero.max'        => 'El género no debe superar los 100 caracteres.',

            'idioma.required'   => 'El idioma es obligatorio.',
            'idioma.string'     => 'El idioma debe ser un texto válido.',
            'idioma.max'        => 'El idioma no debe superar los 255 caracteres.',
            'idioma.in'         => 'El idioma seleccionado no es válido.',

            'actores.required'  => 'Debe seleccionar al menos un actor.',
            'actores.array'     => 'Los actores deben enviarse en un formato válido.',
            'actores.*.exists'  => 'Alguno de los actores seleccionados no existe en la base de datos.'
        ];
    }

    /**
     * Lista de todos los idiomas disponibles (según países).
     */
    private function paisesDisponibles()
    {
        return [
            'Afganistán', 'Albania', 'Alemania', 'Andorra', 'Angola', 'Antigua y Barbuda', 'Arabia Saudita', 'Argelia', 'Argentina', 
            'Armenia', 'Australia', 'Austria', 'Azerbaiyán', 'Bahamas', 'Bangladés', 'Barbados', 'Baréin', 'Bélgica', 'Belice', 
            'Benín', 'Bielorrusia', 'Birmania', 'Bolivia', 'Bosnia y Herzegovina', 'Botsuana', 'Brasil', 'Brunéi', 'Bulgaria', 
            'Burkina Faso', 'Burundi', 'Bután', 'Cabo Verde', 'Camboya', 'Camerún', 'Canadá', 'Catar', 'Chad', 'Chile', 'China', 
            'Chipre', 'Colombia', 'Comoras', 'Corea del Norte', 'Corea del Sur', 'Costa de Marfil', 'Costa Rica', 'Croacia', 'Cuba', 
            'Dinamarca', 'Dominica', 'Ecuador', 'Egipto', 'El Salvador', 'Emiratos Árabes Unidos', 'Eritrea', 'Eslovaquia', 'Eslovenia', 
            'España', 'Estados Unidos', 'Estonia', 'Esuatini', 'Etiopía', 'Filipinas', 'Finlandia', 'Fiyi', 'Francia', 'Gabón', 'Gambia', 
            'Georgia', 'Ghana', 'Granada', 'Grecia', 'Guatemala', 'Guyana', 'Guinea', 'Guinea-Bisáu', 'Guinea Ecuatorial', 'Haití', 
            'Honduras', 'Hungría', 'India', 'Indonesia', 'Irak', 'Irán', 'Irlanda', 'Islandia', 'Islas Marshall', 'Islas Salomón', 
            'Israel', 'Italia', 'Jamaica', 'Japón', 'Jordania', 'Kazajistán', 'Kenia', 'Kirguistán', 'Kiribati', 'Kuwait', 'Laos', 
            'Lesoto', 'Letonia', 'Líbano', 'Liberia', 'Libia', 'Liechtenstein', 'Lituania', 'Luxemburgo', 'Madagascar', 'Malasia', 
            'Malaui', 'Maldivas', 'Malí', 'Malta', 'Marruecos', 'Mauricio', 'Mauritania', 'México', 'Micronesia', 'Moldavia', 'Mónaco', 
            'Mongolia', 'Montenegro', 'Mozambique', 'Namibia', 'Nauru', 'Nepal', 'Nicaragua', 'Níger', 'Nigeria', 'Noruega', 'Nueva Zelanda', 
            'Omán', 'Países Bajos', 'Pakistán', 'Palaos', 'Palestina', 'Panamá', 'Papúa Nueva Guinea', 'Paraguay', 'Perú', 'Polonia', 
            'Portugal', 'Reino Unido', 'República Centroafricana', 'República Checa', 'República del Congo', 'República Democrática del Congo', 
            'República Dominicana', 'Ruanda', 'Rumania', 'Rusia', 'Samoa', 'San Cristóbal y Nieves', 'San Marino', 'San Vicente y las Granadinas', 
            'Santa Lucía', 'Santo Tomé y Príncipe', 'Senegal', 'Serbia', 'Seychelles', 'Sierra Leona', 'Singapur', 'Siria', 'Somalia', 
            'Sri Lanka', 'Sudáfrica', 'Sudán', 'Sudán del Sur', 'Suecia', 'Suiza', 'Surinam', 'Tailandia', 'Tanzania', 'Tayikistán', 
            'Timor Oriental', 'Togo', 'Tonga', 'Trinidad y Tobago', 'Túnez', 'Turkmenistán', 'Turquía', 'Tuvalu', 'Ucrania', 'Uganda', 
            'Uruguay', 'Uzbekistán', 'Vanuatu', 'Vaticano', 'Venezuela', 'Vietnam', 'Yemen', 'Yibuti', 'Zambia', 'Zimbabue'
        ];
    }
}

