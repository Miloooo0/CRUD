
        <a href="{{ route('peliculas.create') }}">Agregar pelicula</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Director</th>
                    <th>Fecha Estreno</th>
                    <th>Duración</th>
                    <th>Género</th>
                    <th>País</th>
                    <th>Elenco</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($peliculas as $pelicula): ?>
                    <tr>
                        <td><?= $pelicula->id ?></td>
                        <td><?= $pelicula->nombre ?></td>
                        <td><?= $pelicula->director ?></td>
                        <td><?= \Carbon\Carbon::parse(time: $pelicula->fecha)->format('d/m/Y') ?></td>
                        <td><?= $pelicula->duracion ?></td>
                        <td><?= $pelicula->genero ?></td>
                        <td><?= $pelicula->idioma?></td>
                        <td>
                        <ul>
                        @foreach($pelicula->actores as $actor)
                            <li>{{ $actor->nombre }} ({{ $actor->pais }})</li>
                        @endforeach
                        </ul>
                        </td>

                        <td>
                            <a href="<?= route('peliculas.edit', $pelicula->id) ?>">Editar</a>
                            <form action="<?= route('peliculas.destroy', $pelicula->id) ?>" method="POST" style="display:inline;">
                                <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" onclick="return confirm('¿Estás seguro de eliminar esta pelicula?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <button onclick="location.href='/'">Volver</button>
        </table>
