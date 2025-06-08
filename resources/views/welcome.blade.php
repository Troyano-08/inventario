<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bienvenido - Sistema de Inventario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    :root {
      --bg-color: #0f1115;
      --card-color: #1a1d23;
      --text-color: #f1f1f1;
      --green: #4ade80;
      --borde: #2c3038;
    }

    body {
      background-color: var(--bg-color);
      color: var(--text-color);
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

    .container-welcome {
      position: relative;
      z-index: 2;
      max-width: 1400px;
      margin: 80px auto;
      text-align: center;
      padding: 2rem;
    }

    h1 {
      font-weight: bold;
      text-transform: uppercase;
      color: var(--text-color);
    }

    .subtitle {
      color: #aaa;
      margin-bottom: 2.5rem;
    }

    .row-custom {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 1.5rem;
    }

    .card-custom {
      background-color: var(--card-color);
      border: 1px solid var(--borde);
      border-radius: 12px;
      padding: 2rem;
      flex: 1;
      min-width: 300px;
      max-width: 320px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
      transition: transform 0.3s ease;
    }

    .card-custom:hover {
      transform: scale(1.05);
    }

    .card-custom i {
      font-size: 2.2rem;
      color: var(--green);
    }

    .card-custom h5 {
      margin-top: 1rem;
      font-weight: bold;
      color: #fff;
    }

    .card-custom p {
      color: #ccc;
      font-size: 0.95rem;
      margin-bottom: 1.2rem;
    }

    .btn-acceder {
      background-color: var(--green);
      color: #000;
      font-weight: bold;
      border: none;
      padding: 0.5rem 1.2rem;
    }

    .btn-acceder:hover {
      background-color: #34d399;
      color: #000;
    }

    .logout-btn {
      margin-top: 4rem;
    }

    @media (max-width: 1400px) {
      .row-custom {
        justify-content: center;
      }
    }
  </style>
</head>
<body>

<canvas id="stars"></canvas>

<div class="container-welcome">
  <h1>GESTIONA CON EXCELENCIA</h1>
  <p class="subtitle">Soluciones eficientes para tu inventario</p>

  <div class="row-custom">
    <div class="card-custom">
      <i class="fas fa-users"></i>
      <h5>Clientes</h5>
      <p>Administra la información de tus clientes</p>
      <a href="{{ route('clientes.index') }}" class="btn btn-acceder">Ver clientes</a>
    </div>

    <div class="card-custom">
      <i class="fas fa-box-open"></i>
      <h5>Productos</h5>
      <p>Supervisa y actualiza el stock detallado</p>
      <a href="{{ route('productos.index') }}" class="btn btn-acceder">Ver productos</a>
    </div>

    <div class="card-custom">
      <i class="fas fa-tags"></i>
      <h5>Categorías</h5>
      <p>Ordena los productos en categorías claras</p>
      <a href="{{ route('categorias.index') }}" class="btn btn-acceder">Ver categorías</a>
    </div>

    <div class="card-custom">
      <i class="fas fa-diagram-project"></i>
      <h5>Proyectos</h5>
      <p>Gestiona y consulta los proyectos registrados</p>
      <a href="{{ route('proyectos.index') }}" class="btn btn-acceder">Ver proyectos</a>
    </div>
  </div>

  <form method="POST" action="{{ route('logout') }}" class="logout-btn">
    @csrf
    <button type="submit" class="btn btn-danger">
      <i class="fas fa-sign-out-alt me-1"></i> Cerrar sesión
    </button>
  </form>
</div>

<script>
  const canvas = document.getElementById("stars");
  const ctx = canvas.getContext("2d");

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

  let stars = [];

  function drawStars() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    stars.forEach((star, i) => {
      ctx.beginPath();
      const gradient = ctx.createLinearGradient(star.x, star.y, star.x - star.length, star.y + star.length);
      gradient.addColorStop(0, `rgba(255,255,255,${star.alpha})`);
      gradient.addColorStop(1, "rgba(255,255,255,0)");
      ctx.strokeStyle = gradient;
      ctx.moveTo(star.x, star.y);
      ctx.lineTo(star.x - star.length, star.y + star.length);
      ctx.stroke();

      star.x -= star.speed;
      star.y += star.speed;

      if (star.x < -star.length || star.y > canvas.height + star.length) {
        stars[i] = createStar();
      }
    });

    requestAnimationFrame(drawStars);
  }

  resizeCanvas();
  window.addEventListener("resize", resizeCanvas);
  stars = Array(60).fill().map(createStar);
  drawStars();
</script>

</body>
</html>
