<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Productos</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --fondo: #0f1115;
      --card: #1a1d23;
      --texto: #f1f1f1;
      --verde: #4ade80;
      --borde: #2c3038;
    }

    body {
      background-color: var(--fondo);
      color: var(--texto);
      font-family: 'Segoe UI', sans-serif;
      overflow-x: hidden;
      position: relative;
    }

    canvas {
      position: fixed;
      top: 0;
      left: 0;
      z-index: 0;
      width: 100%;
      height: 100%;
    }

    .container {
      position: relative;
      z-index: 2;
    }

    h1 {
      text-align: center;
      margin-top: 30px;
      margin-bottom: 20px;
      font-weight: bold;
      color: var(--verde);
    }

    .btn-success {
      background-color: var(--verde);
      border: none;
    }

    .btn-success:hover {
      background-color: #34d399;
    }

    .table {
      background-color: var(--card);
      color: var(--texto);
      border: 1px solid var(--borde);
    }

    .table th, .table td {
      vertical-align: middle;
    }

    .table thead {
      background-color: #1f232a;
      color: var(--verde);
    }

    .table-hover tbody tr:hover {
      background-color: #2a2e38;
    }

    .btn-warning {
      background-color: #facc15;
      border: none;
      color: #000;
    }

    .btn-danger {
      background-color: #f87171;
      border: none;
      color: #fff;
    }

    .btn-warning:hover {
      background-color: #eab308;
    }

    .btn-danger:hover {
      background-color: #dc2626;
    }
  </style>
</head>
<body>

<!-- Fondo estrellas fugaces -->
<canvas id="stars"></canvas>

<div class="container py-4">
  <h1 style="color: var(--verde);">
  <i class="bi bi-box-seam me-2"></i> Productos
</h1>


  <div class="mb-3 text-end">
  <a href="{{ route('productos.create') }}" class="btn btn-success btn-sm me-2">
    <i class="bi bi-plus-circle-fill me-1"></i> Agregar Producto
  </a>
  <a href="{{ route('productos.exportarPDF') }}" class="btn btn-danger btn-sm">
    <i class="bi bi-file-earmark-pdf-fill me-1"></i> Exportar PDF
  </a>
</div>


  <div class="table-responsive rounded shadow-sm">
    <table class="table table-hover table-bordered align-middle">
      <thead>
        <tr class="text-center">
          <th>#</th>
          <th>Categoría</th>
          <th>Código</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Editar</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($productos as $key => $producto)
          <tr>
            <td class="text-center">{{ $key + 1 }}</td>
            <td>{{ $producto->categoria->nombre }}</td>
            <td>{{ $producto->codigo }}</td>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->descripcion }}</td>
            <td class="text-center">
              <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil-square"></i>
              </a>
            </td>
            <td class="text-center">
              <a href="{{ route('productos.delete', $producto->id) }}" class="btn btn-danger">
  <i class="bi bi-trash3-fill"></i>
</a>

            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    @include('components.boton-inicio')
  </div>
</div>


<!-- Script estrellas fugaces -->
<script>
  const canvas = document.getElementById("stars") || (() => {
    const c = document.createElement("canvas");
    c.id = "stars";
    document.body.appendChild(c);
    return c;
  })();
  const ctx = canvas.getContext("2d");
  let stars = [];

  function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  }

  function createStar() {
    return {
      x: Math.random() * canvas.width,
      y: Math.random() * canvas.height,
      length: Math.random() * 80 + 10,
      speed: Math.random() * 3 + 1,
      alpha: Math.random() * 0.5 + 0.2
    };
  }

  function drawStars() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    stars.forEach((star, index) => {
      ctx.beginPath();
      const gradient = ctx.createLinearGradient(star.x, star.y, star.x - star.length, star.y + star.length);
      gradient.addColorStop(0, "rgba(255,255,255," + star.alpha + ")");
      gradient.addColorStop(1, "rgba(255,255,255,0)");
      ctx.strokeStyle = gradient;
      ctx.moveTo(star.x, star.y);
      ctx.lineTo(star.x - star.length, star.y + star.length);
      ctx.stroke();

      star.x -= star.speed;
      star.y += star.speed;

      if (star.x < -star.length || star.y > canvas.height + star.length) {
        stars[index] = createStar();
      }
    });
    requestAnimationFrame(drawStars);
  }

  resizeCanvas();
  window.addEventListener("resize", resizeCanvas);
  stars = Array(50).fill().map(createStar);
  drawStars();
</script>

</body>
</html>
