<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Proyectos</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: center; }
        th { background-color: #e4e4e4; }
    </style>
</head>
<body>
    <h2>Listado de Proyectos</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyectos as $index => $proyecto)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $proyecto->cliente->nombres ?? 'No definido' }}</td>
                    <td>{{ $proyecto->descripcion }}</td>
                    <td>{{ $proyecto->estado }}</td>
                    <td>{{ $proyecto->fecha_inicio }}</td>
                    <td>{{ $proyecto->fecha_fin }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>