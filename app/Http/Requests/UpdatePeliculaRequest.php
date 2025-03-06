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
            'nombre.required'        => __('messages.nombrepeliculareq'),
            'nombre.string'          => __('messages.nombrepeliculastring'),
            'nombre.max'             => __('messages.nombrepeliculamax'),
        
            'director.required'      => __('messages.directorreq'),
            'director.string'        => __('messages.directorstring'),
            'director.max'           => __('messages.directormax'),
        
            'fecha.required'         => __('messages.fechareq'),
            'fecha.date'             => __('messages.fechadate'),
        
            'duracion.required'      => __('messages.duracionreq'),
            'duracion.integer'       => __('messages.duracioninteger'),
            'duracion.min'           => __('messages.duracionmin'),
        
            'genero.required'        => __('messages.generoreq'),
            'genero.string'          => __('messages.generostring'),
            'genero.max'             => __('messages.generomax'),
        
            'idioma.required'        => __('messages.idiomareq'),
            'idioma.string'          => __('messages.idiomstring'),
            'idioma.max'             => __('messages.idiomamax'),
            'idioma.in'              => __('messages.idiomain'),
        
            'actores.required'       => __('messages.actoresreq'),
            'actores.array'          => __('messages.actoresarray'),
            'actores.*.exists'       => __('messages.actoresexists')
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

