<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Actores</title>
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
</body>
</html>