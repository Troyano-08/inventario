<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Proyectos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
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

<canvas id="stars"></canvas>

<div class="container py-4">
  <h1><i class="bi bi-kanban me-2"></i> Proyectos</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="mb-3 text-end">
  <a href="{{ route('proyectos.create') }}" class="btn btn-success btn-sm me-2">
    <i class="bi bi-plus-circle-fill me-1"></i> Agregar Proyecto
  </a>
  <a href="{{ route('proyectos.exportarPDF') }}" class="btn btn-danger btn-sm">
    <i class="bi bi-file-earmark-pdf-fill me-1"></i> Exportar PDF
  </a>
</div>

  <div class="table-responsive rounded shadow-sm">
    <table class="table table-hover table-bordered align-middle">
      <thead class="text-center">
        <tr>
          <th>#</th>
          <th>Cliente</th>
          <th>Nombre</th>
          <th>Estado</th>
          <th>Fechas</th>
          <th>Ver</th>
          <th>Editar</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody>
        @foreach($proyectos as $key => $proyecto)
          <tr>
            <td class="text-center">{{ $key + 1 }}</td>
            <td>
  {{ $proyecto->cliente->nombres ?? '' }}
  {{ $proyecto->cliente->pri_ape ?? '' }}
  {{ $proyecto->cliente->seg_ape ?? '' }}
</td>

            <td>{{ $proyecto->nombre }}</td>
            <td>{{ $proyecto->estado }}</td>
            <td>{{ $proyecto->fecha_inicio }} a {{ $proyecto->fecha_fin }}</td>
            <td class="text-center">
              <a href="{{ route('proyectos.show', $proyecto) }}" class="btn btn-info btn-sm">
                <i class="bi bi-eye-fill"></i>
              </a>
            </td>
            <td class="text-center">
              <a href="{{ route('proyectos.edit', $proyecto) }}" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil-square"></i>
              </a>
            </td>
            <td class="text-center">
              <form action="{{ route('proyectos.destroy', $proyecto) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este proyecto?')">
                  <i class="bi bi-trash3-fill"></i>
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    @include('components.boton-inicio')
  </div>
</div>

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
