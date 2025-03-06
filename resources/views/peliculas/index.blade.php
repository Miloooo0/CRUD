<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #212121;
            color: white;
            margin: 0;
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
        
        .divimportar {
            background-color: #212121;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            margin: auto;
            color: #f5f5f5;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            align-content: center;
            gap: 10px;

        }
        .divimportar form{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            align-content: center;
            gap: 10px;
        }
        .lab{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            align-content: center;
            gap: 10px;
        }
        .divimportar .textImp {
            color: #f5f5f5;
            font-weight: bold;
        }

        .divimportar .fileImp {
            background-color: #333;
            color: #fff;
            border: 1px solid #444;
            padding: 8px;
            border-radius: 12px;
        }

        .divimportar .fileImp:focus {
            background-color: #444;
            border-color: #6200ea;
            outline: none;
            box-shadow: 0px 0px 5px rgba(152, 152, 152, 0.6);
        }

        .divimportar .btn-primary {
            background-color:rgb(142, 142, 142);
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            transition: 0.3s;
            width: 200px;
        }

        .divimportar .btn-primary:hover {
            background-color:#000000;
        }

    </style>
</head>
<body>
    <x-global-components.nav/>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

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
        <button onclick="location.href='/'">{{ __('messages.return') }}</button>
    </div>
    <div class="divimportar">
        <form action="{{ route('peliculas.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="lab">
                <label for="jsonFileMovies" class="textoImp">{{ __('messages.impjson') }}</label>
                <input type="file" name="jsonFile" class="fileImp" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('messages.impmovies') }}</button>
        </form>
    </div>

</body>