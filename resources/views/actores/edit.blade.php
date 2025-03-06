<style>
    body{
        padding: 0;
        margin:0;
        background-color: #212121;
    }
    .container-form-global{
        display: flex;
        width: 100vw;
        align-items: center;
        align-content: center;
        flex-direction: column;
    }
    .container-form{
        border: solid 1px#e8e8e8;
        border-radius: 10px;
        width: 40vw;
        height: auto;
        display: flex;
        flex-direction: column;
        align-self: center;
        gap: 10px;
        padding: 20px;
        box-sizing: border-box;
    }
    label{
        align-self: center;
        color: white;
    }

    .coolinput {
        display: flex;
        flex-direction: column;
        width: fit-content;
        position: static;
        width: 700px;
        color: white;
    }

    .coolinput label.text {
        font-size: 0.75rem;
        color:rgb(200, 200, 200);
        font-weight: 700;
        position: relative;
        top: 0.5rem;
        margin: 0 0 0 7px;
        padding: 0 3px;
        background: #212121;
        width: fit-content;
    }

    .coolinput input[type=text].input {
        padding: 11px 10px;
        font-size: 1.3rem;
        border: 2px #ffffff solid;
        border-radius: 5px;
        background: #212121;
        color: white;
    }

    .coolinput label.date {
        font-size: 0.75rem;
        color:rgb(200, 200, 200);
        font-weight: 700;
        position: relative;
        top: 0.5rem;
        margin: 0 0 0 7px;
        padding: 0 3px;
        background: #212121;
        width: fit-content;
    }

    .coolinput input[type=date].input {
        padding: 11px 10px;
        font-size: 1.3rem;
        border: 2px #ffffff solid;
        border-radius: 5px;
        background: #212121;
        color: white;
    }

    .coolinput input[type=text].input:focus {
        outline: none;
    }

    .coolinput label.select {
        font-size: 0.75rem;
        color: rgb(200, 200, 200);
        font-weight: 700;
        position: relative;
        top: 0.5rem;
        margin: 0 0 0 7px;
        padding: 0 3px;
        background: #212121;
        width: fit-content;
    }

    .coolinput select.input {
        padding: 11px 10px;
        font-size: 1.3rem;
        border: 2px #ffffff solid;
        border-radius: 5px;
        background: #212121;
        color: white;
        appearance: none; /* Oculta el estilo nativo del sistema */
        -webkit-appearance: none;
        -moz-appearance: none;
        margin-top: 15px;
    }

    .coolinput select.input:focus {
        outline: none;
        border-color: #00bcd4;
    }
    .containerTabla button{
        margin-top: 10px;
    }
    .errors-back{
        color: red;
    }
</style>

<x-global-components.nav/>
<div class="container-form-global">
    <div class="container-form">
<div class="errors-back">
@if (session('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </ul>
            </div>
        @endif
</div>
        <div class="containerTabla">
        <form action="{{ route('actores.update', $actor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="coolinput">
            <label class="text" for="nombre">{{ __('messages.name') }}</label>
            <input type="text" id="nombre" class="input" name="nombre" value="{{ old('nombre', $actor->nombre) }}" required>
        </div>

        <div class="coolinput">
            <label class="text" for="edad">{{ __('messages.age') }}</label>
            <input type="text" id="edad" class="input" name="edad" value="{{ old('edad', $actor->edad) }}" required>
        </div>

        <div class="coolinput">
            <label class="text" for="fecha_nacimiento">{{ __('messages.birthdate') }}</label>
            <input type="date" id="fecha_nacimiento" class="input" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $actor->fecha_nacimiento) }}" required>
        </div>

        <div class="coolinput">
            <label class="text" for="pais">{{ __('messages.country') }}</label>
            <input type="text" id="pais" class="input" name="pais" value="{{ old('pais', $actor->pais) }}" required>
        </div>

         <!-- Contenedor donde se agregarán los selects de películas -->
         <div id="peliculaSelectContainer" class="coolinput">
            @if($actor->peliculas->count() > 0)
                @foreach($actor->peliculas as $selectedPelicula)
                    <div class="pelicula-select">
                        <select name="peliculas[]" required>
                            <option value="">{{ __('messages.selectfilm') }}</option>
                            @foreach($peliculas as $pelicula)
                                <option value="{{ $pelicula->id }}" {{ $pelicula->id == $selectedPelicula->id ? 'selected' : '' }}>
                                    {{ $pelicula->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button" class="removePelicula">X</button>
                    </div>
                @endforeach
            @else
                <div class="pelicula-select">
                    <select name="peliculas[]" class="input" required>
                        <option value="">{{ __('messages.selectfilm') }}</option>
                        @foreach($peliculas as $pelicula)
                            <option value="{{ $pelicula->id }}">{{ $pelicula->nombre }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="removePelicula">X</button>
                </div>
            @endif
        </div>

        <!-- Botón para agregar un nuevo select -->
        <button type="button" id="addPelicula">{{ __('messages.addfilm') }}</button>

        <button type="submit" onclick="return confirm('{{ __('messages.confirmEdit') }}')">{{ __('messages.savechanges') }}</button>
        
        <a href="{{ route('actores.index') }}">{{ __('messages.cancel') }}</a>
    </form>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var container = document.getElementById('peliculaSelectContainer');
    var addButton = document.getElementById('addPelicula');

    // Función para agregar un nuevo select
    addButton.addEventListener('click', function () {
        var firstSelectDiv = container.querySelector('.pelicula-select');
        if (firstSelectDiv) {
            var newSelectDiv = firstSelectDiv.cloneNode(true);
            newSelectDiv.querySelector('select').selectedIndex = 0; // Resetear selección
            container.appendChild(newSelectDiv);
            attachRemoveEvent(newSelectDiv.querySelector('.removePelicula')); // Agregar evento al nuevo botón
        }
    });

    // Función para eliminar un select
    function attachRemoveEvent(button) {
        button.addEventListener('click', function () {
            if (container.getElementsByClassName('pelicula-select').length > 1) {
                button.parentElement.remove();
            } else {
                alert('{{ __('messages.minfilm') }}');
            }
        });
    }

    // Agregar eventos de eliminación a los botones existentes
    document.querySelectorAll('.removePelicula').forEach(attachRemoveEvent);
});
</script>