<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@500;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Rubik', sans-serif;
            background: #1e1e2f;
            color: #f8f9fa;
            position: relative;
            overflow: hidden;
        }

        .card {
            border-radius: 1rem;
            background: #2c2c3a;
        }

        .form-control {
            background-color: #383850;
            border: 1px solid #555;
            color: #fff;
        }

        .form-control[readonly] {
            background-color: #303040;
        }

        .card-header {
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }

        .btn-outline-light:hover {
            background-color: #f8f9fa;
            color: #212529;
        }

        /* Estrellas fugaces simples */
        .stars {
            position: fixed;
            width: 100%;
            height: 100%;
            background: transparent;
            z-index: 0;
            overflow: hidden;
        }

        .star {
            width: 2px;
            height: 2px;
            background: white;
            position: absolute;
            top: -10px;
            animation: fall 5s linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(0) translateX(0);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) translateX(100px);
                opacity: 0;
            }
        }
    </style>
</head>
<body>

<!-- Estrellas animadas -->
<div class="stars">
    @for ($i = 0; $i < 50; $i++)
        <div class="star" style="left: {{ rand(0, 100) }}vw; animation-delay: {{ rand(0, 10) / 2 }}s;"></div>
    @endfor
</div>

<div class="container mt-5 position-relative" style="z-index: 1;">
    <div class="card border-danger shadow-lg">
        <div class="card-header bg-danger text-white">
            <h4 class="mb-0"><i class="bi bi-exclamation-triangle-fill"></i> Confirmar Eliminación</h4>
        </div>
        <div class="card-body">
            <p class="text-warning">¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.</p>

            <form action="{{ route('productos.destroy') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $producto->id }}">

                <div class="mb-3">
                    <label class="form-label">Categoría</label>
                    <input type="text" class="form-control" value="{{ $producto->categoria->nombre }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Código</label>
                    <input type="text" name="codigo" value="{{ $producto->codigo }}" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" value="{{ $producto->nombre }}" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <input type="text" name="descripcion" value="{{ $producto->descripcion }}" class="form-control" readonly>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('productos.index') }}" class="btn btn-outline-light">
                        <i class="bi bi-arrow-left-circle"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash3-fill"></i> Eliminar Definitivamente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
