<x-global-components.nav/>

<div class="container-form-global">
    <div class="container-form">
        <h2 style="color:white;">Importar Películas desde JSON</h2>

        <!-- Mostrar mensajes de éxito o error -->
        @if (session('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('peliculas.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="coolinput">
                <label class="text">Selecciona un archivo JSON</label>
                <input type="file" name="json_file" class="input" accept=".json" required>
            </div>
            <button type="submit">Importar</button>
            <a href="{{ route('peliculas.index') }}">Cancelar</a>
        </form>
    </div>
</div>
