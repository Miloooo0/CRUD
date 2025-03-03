<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #212121;
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }
        .container-table {
            width: 80%;
            background-color: #222;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
            text-align: center;
            margin: 5vh;
        }
        h2 {
            margin-bottom: 15px;
            color: #fff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #444;
            color: #fff;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #333;
        }
        tr:nth-child(odd) {
            background-color: #555;
        }
        tr:hover {
            background-color: #666;
        }

        .botones-tabla {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .botones-tabla button{
            margin-bottom: 5vh;
        }
    </style>
</head>
<body>
    <x-global-components.nav/>
    <div class="container-table">
    <h2>{{ __('messages.title-peliculas') }}</h2>
    <table>
        <thead>
            <tr>
                <th scope="col" class="px-6 py-3">{{ __('messages.titulo') }}</th>
                <th scope="col" class="px-6 py-3">{{ __('messages.director') }}</th>
                <th scope="col" class="px-6 py-3">{{ __('messages.reldate') }}</th>
                <th scope="col" class="px-6 py-3">{{ __('messages.length') }}</th>
                <th scope="col" class="px-6 py-3">{{ __('messages.genre') }}</th>
                <th scope="col" class="px-6 py-3">{{ __('messages.country') }}</th>
                <th scope="col" class="px-6 py-3">{{ __('messages.cast') }}</th>
                <th scope="col" class="px-6 py-3">{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($peliculas as $pelicula): ?>
                <tr>
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
                        <button onclick="location.href='{{ route('peliculas.edit', $pelicula->id) }}'">{{ __('messages.edit') }}</button>
                        <form action="<?= route('peliculas.destroy', $pelicula->id) ?>" method="POST" style="display:inline;">
                            <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" onclick="return confirm('{{ __('messages.confirmDel') }}')">{{ __('messages.delete') }}</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>

    <div class="botones-tabla">
        <button onclick="location.href='{{ route('peliculas.create') }}'">{{ __('messages.addfilm') }}</button>
        <button onclick="location.href='{{ route('peliculas.importView') }}'">import</button>
        <button onclick="location.href='/'">{{ __('messages.return') }}</button>
    </div>
</body>