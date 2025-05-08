<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  <link rel="stylesheet" href="../CSS/Login y Registro.css">
</head>
<body>
  <div class="container split">
    <div class="image-side">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135789.png" alt="Dinero">

    </div>
    <div class="form-side">
      <h2>Registro</h2>
      <form>
        <input type="text" placeholder="Nombre de usuario" required>
        <input type="email" placeholder="Correo electrónico" required>
        <input type="number" placeholder="Cédula" required>
        <input type="password" placeholder="Contraseña" required>
        <button type="submit">Registrarse</button>
      </form>
      <div class="toggle-form">
        ¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a>
      </div>
    </div>
  </div>
</body>
</html>

