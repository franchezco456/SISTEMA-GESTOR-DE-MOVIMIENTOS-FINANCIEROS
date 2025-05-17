<?php
session_start();
if (isset($_SESSION['mensaje'])) {
    echo "<script>
            window.onload = function() {
                alert('".$_SESSION['mensaje']."');
            };
          </script>";
    unset($_SESSION['mensaje']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  <link rel="stylesheet" href="../../../View/CSS/Login_y_Registro.css">
</head>
<body>
  <div class="container split">
    <div class="image-side">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135789.png" alt="Dinero">

    </div>
    <div class="form-side">
      <h2>Registro</h2>
      <form action="../../../Controller/Usuario/registro.php" method="POST">
        <input type="text" id="nombre" name="nombre" placeholder="Nombre de usuario" required>
        <input type="email" id="correo" name="correo" placeholder="Correo electrónico" required>
        <input type="number" id="cedula" name="cedula" placeholder="Cédula" required>
        <input type="password" id="pass" name="pass" placeholder="Contraseña" required>
        <button type="submit">Registrarse</button>
      </form>
      <div class="toggle-form">
        ¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a>
      </div>
    </div>
  </div>
</body>
</html>

