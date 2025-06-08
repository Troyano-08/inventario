<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Nuevo Proyecto</title>
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
    .form-control, .form-select {
      background-color: var(--card);
      color: var(--texto);
      border: 1px solid var(--borde);
    }
    .form-control::placeholder {
      color: #aaa;
    }
    .btn-success {
      background-color: var(--verde);
      border: none;
    }
    .btn-success:hover {
      background-color: #34d399;
    }
  </style>
</head>
<body>

<canvas id="stars"></canvas>

<div class="container py-4">
  <h1><i class="bi bi-kanban-fill me-2"></i> Nuevo Proyecto</h1>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('proyectos.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label for="cliente_id" class="form-label">Cliente</label>
      <select name="cliente_id" class="form-select" required>
        <option value="">Seleccione un cliente</option>
        @foreach ($clientes as $cliente)
          <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre del Proyecto</label>
      <input type="text" name="nombre" class="form-control" placeholder="Nombre del proyecto" required>
    </div>

    <div class="mb-3">
      <label for="descripcion" class="form-label">Descripción</label>
      <textarea name="descripcion" class="form-control" rows="3" placeholder="Descripción breve"></textarea>
    </div>

    <div class="mb-3">
      <label for="estado" class="form-label">Estado</label>
      <select name="estado" class="form-select">
        <option value="Pendiente">Pendiente</option>
        <option value="En Proceso">En Proceso</option>
        <option value="Terminado">Terminado</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
      <input type="date" name="fecha_inicio" class="form-control">
    </div>

    <div class="mb-3">
      <label for="fecha_fin" class="form-label">Fecha de Fin</label>
      <input type="date" name="fecha_fin" class="form-control">
    </div>

    <div class="text-end">
      <button type="submit" class="btn btn-success">
        <i class="bi bi-check-circle me-1"></i> Guardar Proyecto
      </button>
    </div>
  </form>
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
