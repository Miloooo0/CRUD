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
            <form action="{{ route('peliculas.update', $pelicula->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="coolinput">
                    <label class="text" for="nombre">{{ __('messages.titulo') }}</label>
                    <input type="text" id="nombre" class="input" name="nombre" value="{{ old('nombre', $pelicula->nombre) }}" required>
                </div>

                <div class="coolinput">
                    <label class="text" for="director">{{ __('messages.director') }}</label>
                    <input type="text" id="director" class="input" name="director" value="{{ old('director', $pelicula->director) }}" required>
                </div>

                <div class="coolinput">
                    <label class="text" for="fecha">{{ __('messages.reldate') }}</label>
                    <input type="date" id="fecha" class="input" name="fecha" value="{{ old('fecha', $pelicula->fecha) }}" required>
                </div>

                <div class="coolinput">
                    <label class="text" for="duracion">{{ __('messages.length') }}</label>
                    <input type="text" id="duracion" class="input" name="duracion" value="{{ old('duracion', $pelicula->duracion) }}" required>
                </div>

                <div class="coolinput">
                    <label class="text" for="genero">{{ __('messages.genre') }}</label>
                    <input type="text" id="genero" class="input" name="genero" value="{{ old('genero', $pelicula->genero) }}" required>
                </div>


                <div class="coolinput">
                    <label class="text" for="idioma">{{ __('messages.country') }}</label>
                    <input type="text" id="idioma" class="input" name="idioma" value="{{ old('idioma', $pelicula->idioma) }}" require>
                </div>

                <!-- Contenedor donde se agregarán los selects -->
                <div  id="actorSelectContainer" class="coolinput">
                    @if(isset($pelicula) && $pelicula->actores->count() > 0)
                        <!-- Si la película ya tiene actores asignados, se crean selects con sus valores -->
                        @foreach($pelicula->actores as $selectedActor)
                            <div class="actor-select d-flex align-items-center mb-2">
                                <select name="actores[]" class="form-control" required>
                                    <option value="">{{ __('messages.actorselect') }}</option>
                                    @foreach($actores as $actor)
                                        <option value="{{ $actor->id }}" {{ $actor->id == $selectedActor->id ? 'selected' : '' }}>
                                            {{ $actor->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-danger btn-sm ms-2 removeActor">X</button>
                            </div>
                        @endforeach
                    @else
                        <!-- Si es una nueva película, muestra un solo select vacío -->
                        <div class="actor-select d-flex align-items-center mb-2">
                            <select name="actores[]" class="form-control input" required>
                                <option value="">{{ __('messages.actorselect') }}</option>
                                @foreach($actores as $actor)
                                    <option value="{{ $actor->id }}">{{ $actor->nombre }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-danger btn-sm ms-2 removeActor">X</button>
                        </div>
                    @endif
                </div>

                <!-- Botón para agregar un nuevo select -->
                <button type="button" id="addActor" class="btn btn-primary mt-2">{{ __('messages.addactor') }}</button>


                <button type="submit" onclick="return confirm('{{ __('messages.confirmEdit') }}')">{{ __('messages.savechanges') }}</button>

                <a href="{{ route('peliculas.index') }}">{{ __('messages.cancel') }}</a>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var container = document.getElementById('actorSelectContainer');
        var addButton = document.getElementById('addActor');

        // Función para agregar un nuevo select
        addButton.addEventListener('click', function () {
            var firstSelectDiv = container.querySelector('.actor-select');
            if (firstSelectDiv) {
                var newSelectDiv = firstSelectDiv.cloneNode(true);
                newSelectDiv.querySelector('select').selectedIndex = 0; // Resetear selección
                container.appendChild(newSelectDiv);
                attachRemoveEvent(newSelectDiv.querySelector('.removeActor')); // Agregar evento al nuevo botón
            }
        });

        // Función para eliminar un select
        function attachRemoveEvent(button) {
            button.addEventListener('click', function () {
                if (container.getElementsByClassName('actor-select').length > 1) {
                    button.parentElement.remove();
                } else {
                    alert('{{ __('messages.minActor') }}');
                }
            });
        }

        // Agregar eventos de eliminación a los botones existentes
        document.querySelectorAll('.removeActor').forEach(attachRemoveEvent);
    });
</script>
