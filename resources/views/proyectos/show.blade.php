<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detalles del Proyecto</title>
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
    .card {
      background-color: var(--card);
      border: 1px solid var(--borde);
    }
    .card-header {
      background-color: #1f232a;
      color: var(--verde);
      font-size: 1.25rem;
      font-weight: bold;
    }
    .card-body p {
      margin-bottom: 10px;
    }
    .btn-secondary {
      background-color: #6b7280;
      border: none;
    }
    .btn-secondary:hover {
      background-color: #4b5563;
    }
  </style>
</head>
<body>

<canvas id="stars"></canvas>

<div class="container py-4">
  <h1><i class="bi bi-info-circle-fill me-2"></i> Detalles del Proyecto</h1>

  <div class="card shadow-sm">
    <div class="card-header">
      {{ $proyecto->nombre }}
    </div>
    <div class="card-body">
      <p><strong><i class="bi bi-person-fill me-1"></i> Cliente:</strong> {{ $proyecto->cliente->nombre }}</p>
      <p><strong><i class="bi bi-chat-left-text me-1"></i> Descripción:</strong> {{ $proyecto->descripcion }}</p>
      <p><strong><i class="bi bi-flag-fill me-1"></i> Estado:</strong> {{ $proyecto->estado }}</p>
      <p><strong><i class="bi bi-calendar-date me-1"></i> Fecha de Inicio:</strong> {{ $proyecto->fecha_inicio }}</p>
      <p><strong><i class="bi bi-calendar-check me-1"></i> Fecha de Fin:</strong> {{ $proyecto->fecha_fin }}</p>
    </div>
  </div>

  <div class="mt-4 text-end">
    <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">
      <i class="bi bi-arrow-left-circle me-1"></i> Volver
    </a>
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
