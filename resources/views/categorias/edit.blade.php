<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Editar Categoría</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --fondo: #0f1115;
      --card: #1a1d23;
      --texto: #f1f1f1;
      --amarillo: #fde047;
      --azul: #38bdf8;
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

    .card {
      background-color: var(--card);
      border: 1px solid var(--borde);
      color: var(--texto);
      box-shadow: 0 0 20px rgba(56, 189, 248, 0.2);
    }

    .card-header {
      background-color: var(--azul);
      color: #000;
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

    .form-control::placeholder {
      color: #bbb;
    }

    .form-control:focus {
      border-color: var(--azul);
      box-shadow: 0 0 0 0.2rem rgba(56, 189, 248, 0.3);
    }

    .btn-warning {
      background-color: var(--amarillo);
      border: none;
      color: #000;
    }

    .btn-warning:hover {
      background-color: #facc15;
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

<!-- Fondo animado -->
<canvas id="stars"></canvas>

<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-header">
      <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Editar Categoría</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('categorias.update') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $categoria->id }}">

        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" name="nombre" value="{{ $categoria->nombre }}" class="form-control" required autocomplete="off">
        </div>

        <div class="mb-3">
          <label for="descripcion" class="form-label">Descripción</label>
          <input type="text" name="descripcion" value="{{ $categoria->descripcion }}" class="form-control" autocomplete="off">
        </div>

        <div class="d-flex justify-content-end">
          <button type="submit" class="btn btn-warning">
            <i class="bi bi-check-circle-fill"></i> Guardar Cambios
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Fondo animado con estrellas fugaces -->
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
