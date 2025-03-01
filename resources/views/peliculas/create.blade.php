
@if (session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('peliculas.store') }}" method="POST">
    @csrf

    <div>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>
    </div>

    <div>
        <label for="director">Director</label>
        <input type="text" id="director" name="director" required>
    </div>

    <div>
        <label for="fecha">Fecha de Estreno</label>
        <input type="date" id="fecha" name="fecha" required>
    </div>

    <div>
        <label for="duracion">Duración</label>
        <input type="duracion" id="duracion" name="duracion" required>
    </div>

    <div>
        <label for="genero">Género</label>
        <input type="genero" id="genero" name="genero" required>
    </div>


    <div>
        <label for="idioma">País</label>
        <input type="text" id="idioma" name="idioma" require>
    </div>

    <!-- Contenedor donde se agregarán los selects -->
    <div id="actorSelectContainer">
        @if(isset($pelicula) && $pelicula->actores->count() > 0)
            <!-- Si la película ya tiene actores asignados, se crean selects con sus valores -->
            @foreach($pelicula->actores as $selectedActor)
                <div class="actor-select d-flex align-items-center mb-2">
                    <select name="actores[]" class="form-control">
                        <option value="">Seleccione un actor</option>
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
                <select name="actores[]" class="form-control">
                    <option value="">Seleccione un actor</option>
                    @foreach($actores as $actor)
                        <option value="{{ $actor->id }}">{{ $actor->nombre }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-danger btn-sm ms-2 removeActor">X</button>
            </div>
        @endif
    </div>

    <!-- Botón para agregar un nuevo select -->
    <button type="button" id="addActor" class="btn btn-primary mt-2">Añadir otro actor</button>


    <button type="submit">Guardar Cambios</button>
    <a href="{{ route('peliculas.index') }}">Cancelar</a>
</form>
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
                    alert('Debe haber al menos un actor seleccionado.');
                }
            });
        }

        // Agregar eventos de eliminación a los botones existentes
        document.querySelectorAll('.removeActor').forEach(attachRemoveEvent);
    });
</script>
