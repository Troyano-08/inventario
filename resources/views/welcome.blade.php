<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inicio - Sistema de Inventario</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
    :root {
      --bg-color: #0f1115;
      --card-color: #1a1d23;
      --text-color: #f1f1f1;
      --green: #4ade80;
      --blue: #60a5fa;
      --teal: #2dd4bf;
      --soft: #d1d5db;
      --brand-color: #e2e8f0;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--bg-color);
      color: var(--text-color);
      overflow-x: hidden;
      position: relative;
      z-index: 1;
    }

    canvas {
      position: fixed;
      top: 0;
      left: 0;
      z-index: 0;
      width: 100%;
      height: 100%;
    }

    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
      background-color: rgba(26, 29, 35, 0.85);
      backdrop-filter: blur(6px);
      z-index: 2;
      position: relative;
    }

    nav .logo {
      font-size: 1.2rem;
      font-weight: bold;
      color: var(--brand-color);
    }

    nav .nav-links a {
      color: var(--soft);
      text-decoration: none;
      margin-left: 20px;
      font-weight: 500;
    }

    .hero {
      text-align: center;
      padding: 3rem 1rem 2rem;
      position: relative;
      z-index: 2;
    }

    .hero h1 {
      font-size: 2.5rem;
      font-weight: 800;
      margin-bottom: 0.5rem;
      text-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
    }

    .hero p {
      font-size: 1.1rem;
      color: var(--soft);
    }

    .cards {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 2rem;
      padding: 2rem;
      position: relative;
      z-index: 2;
    }

    .card {
      background-color: var(--card-color);
      border-radius: 12px;
      width: 280px;
      padding: 2rem 1.5rem;
      text-align: center;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card i {
      font-size: 2.5rem;
      margin-bottom: 1rem;
    }

    .card h3 {
      font-size: 1.3rem;
      margin-bottom: 0.5rem;
      color: var(--text-color);
    }

    .card p {
      color: var(--soft);
      margin-bottom: 1.5rem;
      font-size: 0.95rem;
    }

    .card a {
      display: inline-block;
      padding: 0.5rem 1.2rem;
      border-radius: 8px;
      font-weight: bold;
      text-decoration: none;
      font-size: 0.9rem;
    }

    .green-btn {
      background-color: var(--green);
      color: #0f1115;
    }

    .blue-btn {
      background-color: var(--blue);
      color: #0f1115;
    }

    .teal-btn {
      background-color: var(--teal);
      color: #0f1115;
    }

    @media (max-width: 768px) {
      .cards {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
</head>
<body>

  <!-- Fondo de estrellas fugaces -->
  <canvas id="stars"></canvas>

  <!-- Navbar -->
  <nav>
    <div class="logo"><i class="fas fa-warehouse"></i> Sistema de Inventario</div>
    <div class="nav-links">
      <a href="#">Contacto</a>
    </div>
  </nav>

  <!-- Hero -->
  <section class="hero">
    <h1>GESTIONA CON EXCELENCIA</h1>
    <p>Soluciones eficientes para tu inventario</p>
  </section>

  <!-- Cards -->
  <section class="cards">
    <div class="card">
      <i class="fas fa-users" style="color: var(--green);"></i>
      <h3>Clientes</h3>
      <p>Administra la información de tus clientes</p>
      <a href="{{ route('clientes.index') }}" class="green-btn">Ver clientes</a>
    </div>
    <div class="card">
      <i class="fas fa-cube" style="color: var(--blue);"></i>
      <h3>Productos</h3>
      <p>Supervisa y actualiza el stock detallado</p>
      <a href="{{ route('productos.index') }}" class="blue-btn">Ver productos</a>
    </div>
    <div class="card">
      <i class="fas fa-tags" style="color: var(--teal);"></i>
      <h3>Categorías</h3>
      <p>Ordena los productos en categorías claras</p>
      <a href="{{ route('categorias.index') }}" class="teal-btn">Ver categorías</a>
    </div>
  </section>

  <!-- Script de estrellas fugaces -->
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
        speed: Math.random() * 4 + 1,
        alpha: Math.random() * 0.6 + 0.2
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
    stars = Array(60).fill().map(createStar);
    drawStars();
  </script>

</body>
</html>
