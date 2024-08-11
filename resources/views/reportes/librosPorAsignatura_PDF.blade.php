<!DOCTYPE html>
<html>
<head>
    <title>Reportes y Estadísticas</title>
    <style>
        /* Agrega aquí los estilos que necesites para el PDF */
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
    </style>
</head>
<body>
    <div class="header">
        Fecha de generación del reporte: {{ $fecha }}
    </div>
    <h1>Reportes y Estadísticas</h1>

    <h2>Libros por Asignaturas</h2>
    <table>
        <thead>
            <tr>
                <th>Asignatura</th>
                <th>Total libros</th>
                <th>Porcentaje</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($libros as $data)
            <tr>
                <td>{{ $data->nombre }}</td>
                <td>{{ $data->total }}</td>
                <td>{{$librosTotal != 0 ? ($data->total/$librosTotal)*100 : 0}}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
