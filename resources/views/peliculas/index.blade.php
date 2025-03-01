<style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(171, 91, 91);
            padding: 0%;
            margin: 0%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }

        .container-table{
            margin: 5vh 10vw;
        }
        .botones-tabla{
            display: flex;
            gap: 10px;
            align-content: center;
        }
    </style>
<body>
    <x-global-components.nav/>
    <div class="container-table">
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
                    <td><?= \Carbon\Carbon::parse($pelicula->fecha)->format('d/m/Y') ?></td>
                    <td><?= $pelicula->duracion ?></td>
                    <td><?= $pelicula->genero ?></td>
                    <td><?= $pelicula->idioma ?></td>
                    <td>
                        <ul>
                            <?php foreach ($pelicula->actores as $actor): ?>
                                <li><?= $actor->nombre ?> (<?= $actor->pais ?>)</li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td>
                        <a href="<?= route('peliculas.edit', $pelicula->id) ?>">Editar</a>
                        <form action="<?= route('peliculas.destroy', $pelicula->id) ?>" method="POST" style="display:inline;">
                            <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" onclick="return confirm('¿Estás seguro de eliminar esta película?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>

    <div class="botones-tabla">
        <button onclick="location.href='{{ route('peliculas.create') }}'">Agregar película</button>
        <button onclick="location.href='/'">Volver</button>
    </div>
</body>