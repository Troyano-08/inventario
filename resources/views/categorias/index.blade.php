<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Categorías</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --fondo: #0f1115;
      --card: #1a1d23;
      --texto: #f1f1f1;
      --verde: #34d399;
      --amarillo: #fde047;
      --rojo: #f87171;
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
      font-weight: bold;
      color: var(--amarillo);
      margin-bottom: 30px;
      text-align: center;
    }

    .btn-success {
      background-color: var(--verde);
      border: none;
    }

    .btn-success:hover {
      background-color: #059669;
    }

    .table {
      background-color: var(--card);
      color: var(--texto);
    }

    thead {
      background-color: #1e2630;
    }

    .table th,
    .table td {
      vertical-align: middle;
      border-color: var(--borde);
    }

    .btn-warning {
      background-color: var(--amarillo);
      color: #000;
      border: none;
    }

    .btn-warning:hover {
      background-color: #facc15;
    }

    .btn-danger {
      background-color: var(--rojo);
      border: none;
    }

    .btn-danger:hover {
      background-color: #dc2626;
    }
  </style>
</head>
<body>

<!-- Fondo animado -->
<canvas id="stars"></canvas>

<div class="container mt-5">
  <h1><i class="bi bi-tags-fill me-2"></i> Categorías</h1>

  <a href="{{ route('categorias.create') }}" class="btn btn-success mb-3">
    <i class="bi bi-plus-circle-fill me-1"></i> Agregar Categoría
  </a>

  <div class="table-responsive">
    <table class="table table-bordered table-hover shadow-sm rounded">
      <thead class="text-center text-light">
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Editar</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categorias as $key => $categoria)
        <tr>
          <td class="text-center">{{ $key + 1 }}</td>
          <td>{{ $categoria->nombre }}</td>
          <td>{{ $categoria->descripcion }}</td>
          <td class="text-center">
            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning btn-sm">
              <i class="bi bi-pencil-square"></i> Editar
            </a>
          </td>
          <td class="text-center">
            <a href="{{ route('categorias.delete', $categoria->id) }}" class="btn btn-danger btn-sm">
              <i class="bi bi-trash-fill"></i> Eliminar
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
