<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Visualizaciones</title>
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
        .usuario {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        Fecha de generación del reporte: {{ $fechaGeneracion }}
    </div>

    <h1>Reporte de Visualizaciones</h1>
    <p>Rango de fechas: {{ $fechaInicio->format('d-m-Y') }} - {{ $fechaFin->format('d-m-Y') }}</p>
    @if($recursoId)
        <p>Recurso: {{ \App\Models\Publicacion::find($recursoId)->titulo }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Rol</th>
                <th>Total Visualizaciones</th>
                <th>Porcentaje</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visualizacionesPorRol as $rol => $datos)
            <tr>
                <td>{{ $rol }}</td>
                <td>{{ $datos['total'] }}</td>
                <td>{{ number_format($datos['porcentaje'], 2) }}%</td>
            </tr>
            @foreach ($datos['usuarios'] as $usuario)
            <tr class="usuario">
                <td colspan="3">{{ $usuario->nombres }}</td>
            </tr>
            @foreach ($usuario->visualizacionesDetalles as $detalle)
            <tr>
                <td>{{ $detalle['nombre_usuario'] }}</td>
                <td>{{ $detalle['nombre_recurso'] }}</td>
                <td>{{ $detalle['fecha'] }}</td>
            </tr>
            @endforeach
            @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Total</th>
                <th>{{ $totalVisualizaciones }}</th>
                <th>100%</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
