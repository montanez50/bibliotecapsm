<!DOCTYPE html>
<html>
<head>
    <title>Listado de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .header {
            text-align: right;
            font-size: 12px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        Fecha de generación del reporte: {{ $fecha }}
    </div>

    <h1>Listado de Usuarios</h1>

    <table>
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Nombres</th>
                <th>Email</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
            <tr>
                <td>{{$usuario->cedula}}</td>
                <td>{{ $usuario->nombres }}</td>
                <td>{{ $usuario->correo }}</td>
                <td>{{ $usuario->roles->pluck('name')->first() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
