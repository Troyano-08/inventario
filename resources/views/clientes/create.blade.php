<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Crear Cliente</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --fondo: #0f1115;
      --card: #1a1d23;
      --texto: #f1f1f1;
      --verde: #4ade80;
      --azul: #60a5fa;
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
      border: 1px solid var(--borde);
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
    }

    .card-header {
      background-color: var(--azul);
      color: #fff;
    }

    label {
      color: var(--texto);
      font-weight: 500;
    }

    .form-control,
    .form-select {
      background-color: #2c2f36;
      color: var(--texto);
      border: 1px solid var(--borde);
    }

    .form-control::placeholder,
    .form-select::placeholder {
      color: #ccc;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: var(--verde);
      box-shadow: 0 0 0 0.2rem rgba(74, 222, 128, 0.25);
    }

    .btn-success {
      background-color: var(--verde);
      border: none;
    }

    .btn-success:hover {
      background-color: #34d399;
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
      <h4 class="mb-0"><i class="bi bi-person-plus me-2"></i>Registrar Nuevo Cliente</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label for="nombres" class="form-label">Nombres</label>
          <input type="text" name="nombres" class="form-control" required autocomplete="off" placeholder="Ej: Juan Carlos">
        </div>

        <div class="mb-3">
          <label for="pri_ape" class="form-label">Primer Apellido</label>
          <input type="text" name="pri_ape" class="form-control" required autocomplete="off" placeholder="Ej: Pérez">
        </div>

        <div class="mb-3">
          <label for="seg_ape" class="form-label">Segundo Apellido</label>
          <input type="text" name="seg_ape" class="form-control" required autocomplete="off" placeholder="Ej: Gómez">
        </div>

        <div class="mb-3">
          <label for="docu_tip" class="form-label">Tipo de Documento</label>
          <select name="docu_tip" class="form-select" required>
            <option value="">Seleccionar</option>
            <option value="DNI">DNI</option>
            <option value="RUC">RUC</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="docu_num" class="form-label">Número de Documento</label>
          <input type="text" name="docu_num" class="form-control" required autocomplete="off" placeholder="Ej: 12345678">
        </div>

        <div class="mb-3">
          <label for="telefono" class="form-label">Teléfono</label>
          <input type="text" name="telefono" class="form-control" autocomplete="off" placeholder="Ej: 987654321">
        </div>

        <div class="mb-3">
          <label for="direccion" class="form-label">Dirección</label>
          <input type="text" name="direccion" class="form-control" autocomplete="off" placeholder="Ej: Jr. Lima 123">
        </div>

        <div class="d-flex justify-content-between">
          <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Volver
          </a>
          <button type="submit" class="btn btn-success">
            <i class="bi bi-save2-fill"></i> Guardar
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

