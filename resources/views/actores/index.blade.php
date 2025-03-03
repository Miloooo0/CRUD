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
<body>
    <x-global-components.nav/>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {!! session('error') !!}
    </div>
@endif

    <div class="container-table">
        <h2>{{ __('messages.title-actors') }}</h2>
        <table>
            <thead>
                <tr>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.age') }}</th>
                    <th>{{ __('messages.birthdate') }}</th>
                    <th>{{ __('messages.country') }}</th>
                    <th>{{ __('messages.peliculas') }}</th>
                    <th>{{ __('messages.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($actores as $actor)
                    <tr>
                        <td>{{ $actor->nombre }}</td>
                        <td>{{ $actor->edad }}</td>
                        <td>{{ \Carbon\Carbon::parse($actor->fecha_nacimiento)->format('d/m/Y') }}</td>
                        <td>{{ $actor->pais }}</td>
                        <td>
                            <ul>
                                @foreach ($actor->peliculas as $pelicula)
                                    <li>{{ $pelicula->nombre }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <button onclick="location.href='{{ route('actores.edit', $actor->id) }}'">{{ __('messages.edit') }}</button>
                            <form action="{{ route('actores.destroy', $actor->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('{{ __('messages.confirmDel') }}')">{{ __('messages.delete') }}</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="botones-tabla">
        <button onclick="location.href='{{ route('actores.create') }}'">{{ __('messages.addactor') }}</button>
        <button onclick="location.href='/'">{{ __('messages.return') }}</button>
    </div>
    <!-- <div class="divimportar">
        <form action="{{ route('actores.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="lab">
                <label for="jsonFileActors" class="textoImp">{{ __('messages.impjson') }}</label>
                <input type="file" name="jsonFile" class="fileImp" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('messages.impactors') }}</button>
        </form>
    </div> -->
</body>
