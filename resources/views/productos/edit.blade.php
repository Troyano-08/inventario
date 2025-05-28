<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>

    <!-- Bootstrap CSS e Íconos -->
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

        .form-control, .form-select {
            background-color: #383850;
            border: 1px solid #555;
            color: #fff;
        }

        .form-control::placeholder {
            color: #ccc;
        }

        .form-label {
            font-weight: 500;
        }

        .card-header {
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }

        .btn-outline-light:hover {
            background-color: #f8f9fa;
            color: #212529;
        }

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

<!-- Estrellas fugaces -->
<div class="stars">
    @for ($i = 0; $i < 40; $i++)
        <div class="star" style="left: {{ rand(0, 100) }}vw; animation-delay: {{ rand(0, 10) / 2 }}s;"></div>
    @endfor
</div>

<div class="container mt-5 position-relative" style="z-index: 1;">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Editar Producto</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('productos.update') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $producto->id }}">

                <div class="mb-3">
                    <label for="categoria_id" class="form-label">Categoría</label>
                    <select name="categoria_id" class="form-select" required>
                        <option value="">Seleccionar</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" name="codigo" value="{{ $producto->codigo }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" value="{{ $producto->nombre }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" name="descripcion" value="{{ $producto->descripcion }}" class="form-control">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('productos.index') }}" class="btn btn-outline-light">
                        <i class="bi bi-arrow-left-circle"></i> Volver
                    </a>
                    <button type="submit" class="btn btn-warning text-white">
                        <i class="bi bi-check-circle-fill"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>

