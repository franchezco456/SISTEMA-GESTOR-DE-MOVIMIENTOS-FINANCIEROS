<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="../../../View/CSS/Login_y_Registro.css">
</head>
<body>
  <div class="container split">
    <div class="image-side">
        <img src="https://img.freepik.com/vettori-gratuito/priorita-bassa-della-banca-piggy-disegnata-a-mano_23-2147635068.jpg?semt=ais_hybrid&w=740" alt="Dinero">
    </div>
    <div class="form-side">
      <h2>Iniciar Sesión</h2>
      <form action="../../../Controller/Usuario/login.php" method="POST">
        <input type="text" id="correo" name="correo" placeholder="Correo" required>
        <input type="password" id="pass" name="pass" placeholder="Contraseña" required>
        <button type="submit">Entrar</button>
      </form>
      <div class="toggle-form">
        ¿No tienes cuenta? <a href="registro.php">Regístrate</a>
      </div>
    </div>
  </div>
</body>
</html>

