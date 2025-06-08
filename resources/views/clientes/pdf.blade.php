<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Clientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #999;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .header {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Reporte de Clientes</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Tipo Doc</th>
                <th>N° Documento</th>
                <th>Teléfono</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $index => $cliente)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $cliente->nombres }}</td>
                    <td>{{ $cliente->pri_ape }} {{ $cliente->seg_ape }}</td>
                    <td>{{ $cliente->docu_tip }}</td>
                    <td>{{ $cliente->docu_num }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->direccion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
