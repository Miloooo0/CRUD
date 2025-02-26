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
        <!-- Si estás editando y ya existen actores asignados, crea un select por cada actor -->
        @foreach($pelicula->actores as $selectedActor)
            <div class="actor-select mb-2">
                <select name="actores[]" class="form-control">
                    <option value="">Seleccione un actor</option>
                    @foreach($actores as $actor)
                        <option value="{{ $actor->id }}" {{ $actor->id == $selectedActor->id ? 'selected' : '' }}>
                            {{ $actor->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endforeach
    @else
        <!-- En caso de crear una película nueva, se muestra un único select vacío -->
        <div class="actor-select mb-2">
            <select name="actores[]" class="form-control">
                <option value="">Seleccione un actor</option>
                @foreach($actores as $actor)
                    <option value="{{ $actor->id }}">{{ $actor->nombre }}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>

<!-- Botón para agregar un nuevo select -->
<button type="button" id="addActor" class="btn btn-primary">Añadir otro actor</button>



            <button type="submit">Guardar Película</button>
            <a href="{{ route('peliculas.index') }}">Volver</a>
        </form>
    </div>

    <script>
document.getElementById('addActor').addEventListener('click', function() {
    // Selecciona el contenedor de los selects
    var container = document.getElementById('actorSelectContainer');
    // Clona el primer elemento con la clase 'actor-select'
    var firstSelectDiv = container.querySelector('.actor-select');
    if(firstSelectDiv) {
        // Clonar el nodo (con sus hijos)
        var newSelectDiv = firstSelectDiv.cloneNode(true);
        // Reinicia el select (para que no tenga ninguna opción seleccionada)
        newSelectDiv.querySelector('select').selectedIndex = 0;
        // Agrega la nueva copia al contenedor
        container.appendChild(newSelectDiv);
    }
});
</script>
