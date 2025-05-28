<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Eliminar Cliente</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --fondo: #0f1115;
      --card: #1a1d23;
      --texto: #f1f1f1;
      --rojo: #f87171;
      --borde: #2c3038;
    }

    * {
      box-sizing: border-box;
    }

    body {
      background-color: var(--fondo);
      font-family: 'Segoe UI', sans-serif;
      color: var(--texto);
      overflow-x: hidden;
      position: relative;
    }

    canvas {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
    }

    .container {
      position: relative;
      z-index: 2;
    }

    .card {
      background-color: var(--card);
      border: 1px solid var(--rojo);
      box-shadow: 0 0 20px rgba(255, 0, 0, 0.3);
    }

    .card-header {
      background-color: var(--rojo);
      color: #fff;
    }

    label {
      color: var(--texto);
      font-weight: 500;
    }

    .form-control {
      background-color: #2c2f36;
      color: var(--texto);
      border: 1px solid var(--borde);
    }

    .btn-danger {
      background-color: var(--rojo);
      border: none;
    }

    .btn-danger:hover {
      background-color: #dc2626;
    }

    .btn-secondary {
      background-color: #374151;
      border: none;
    }

    .btn-secondary:hover {
      background-color: #4b5563;
    }
  </style>
</head>
<body>

<!-- Fondo estrellas fugaces -->
<canvas id="stars"></canvas>

<div class="container mt-5">
  <div class="card border-danger shadow-sm">
    <div class="card-header">
      <h4 class="mb-0"><i class="bi bi-exclamation-triangle-fill me-2"></i> Confirmar Eliminación</h4>
    </div>
    <div class="card-body">
      <p class="text-danger">¿Estás seguro de que deseas eliminar este cliente? Esta acción no se puede deshacer.</p>

      <form action="{{ route('clientes.destroy') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $cliente->id }}">

        <div class="mb-3">
          <label class="form-label">Nombres</label>
          <input type="text" name="nombres" value="{{ $cliente->nombres }}" class="form-control" readonly>
        </div>

        <div class="mb-3">
          <label class="form-label">Primer Apellido</label>
          <input type="text" name="pri_ape" value="{{ $cliente->pri_ape }}" class="form-control" readonly>
        </div>

        <div class="mb-3">
          <label class="form-label">Segundo Apellido</label>
          <input type="text" name="seg_ape" value="{{ $cliente->seg_ape }}" class="form-control" readonly>
        </div>

        <div class="d-flex justify-content-between">
          <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
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

<!-- Script estrellas fugaces -->
<script>
  const canvas = document.getElementById("stars");
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
