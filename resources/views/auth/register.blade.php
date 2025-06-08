<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registrarse - Sistema de Inventario</title>
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

    .register-container {
      position: relative;
      z-index: 2;
      max-width: 450px;
      margin: 80px auto;
      background-color: var(--card-color);
      border-radius: 12px;
      padding: 2rem;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: var(--green);
      font-weight: bold;
    }

    .form-label {
      color: var(--text-color);
    }

    .form-control {
      background-color: #10131a;
      color: var(--text-color);
      border: 1px solid var(--borde);
    }

    .form-control::placeholder {
      color: #aaa;
    }

    .btn-success {
      background-color: var(--green);
      border: none;
      font-weight: bold;
      width: 100%;
    }

    .btn-success:hover {
      background-color: #34d399;
    }

    .text-muted {
      color: #999 !important;
    }

    a {
      color: var(--green);
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<canvas id="stars"></canvas>

<div class="register-container">
  <h2><i class="fas fa-user-plus me-2"></i> Crear una cuenta</h2>

  <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label">Nombre completo</label>
      <input type="text" name="name" class="form-control" required autofocus placeholder="Tu nombre completo" value="{{ old('name') }}">
      @error('name')
        <div class="text-danger small">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Correo electrónico</label>
      <input type="email" name="email" class="form-control" required placeholder="correo@ejemplo.com" value="{{ old('email') }}">
      @error('email')
        <div class="text-danger small">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Contraseña</label>
      <input type="password" name="password" class="form-control" required placeholder="••••••••">
      @error('password')
        <div class="text-danger small">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
      <input type="password" name="password_confirmation" class="form-control" required placeholder="Repite tu contraseña">
    </div>

    <button type="submit" class="btn btn-success mt-2">Registrarse</button>

    <div class="text-center mt-3">
      <a href="{{ route('login') }}" class="text-muted">¿Ya tienes una cuenta? Inicia sesión</a>
    </div>
  </form>
</div>

<!-- Script estrellas fugaces -->
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
