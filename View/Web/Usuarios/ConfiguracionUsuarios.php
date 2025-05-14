<?php
session_start();
$currentUser = json_decode($_SESSION['usuarioActual'], false);
if (!empty($currentUser)) {
  $idUsuario = $currentUser->id;
  $nombreUsuario = $currentUser->nombre;
  $correoUsuario = $currentUser->correo;
  $passUsuario = $currentUser->pass;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Configuración de Usuario</title>
  <link rel="stylesheet" href="../../../View/CSS/configuracion de usuarios.css">
</head>
<body>
  <div class="config-container">
    <a href="../Usuarios/principal.php" class="back-button">←</a>
    <h2>Configuración de Usuario</h2>
    <form action="../../../Controller/Usuario/actualizarUsuario.php" method="POST">
      <label>Nombre de usuario actual: <strong><?php echo $nombreUsuario; ?></strong></label>
      <span class="change-text">Cambiar el nombre de usuario actual</span>
      <input type="text" id="usuario" name="usuario" placeholder="Nuevo nombre de usuario">

      <label>Correo electrónico actual: <strong><?php echo $correoUsuario; ?></strong></label>
      <span class="change-text">Cambiar el correo electrónico actual</span>
      <input type="email" id="correo" name="correo" placeholder="Nuevo correo electrónico">

      <label>Cédula actual: <strong><?php echo $idUsuario; ?></strong></label>
      <span class="change-text">Cambiar la cédula actual</span>
      <input type="number" id="cedula" name="cedula" placeholder="Nueva cédula">

      <label>Contraseña actual: <strong><?php echo $passUsuario; ?></strong></label>
      <span class="change-text">Cambiar la contraseña actual</span>
      <input type="password" id="password" name="password"placeholder="Nueva contraseña">

      <button type="submit" class="save-btn">Guardar Cambios</button>
    </form>
    <form action="../../../Controller/Usuario/eliminarUsuario.php" method="POST">
      <button type="submit" class="delete-btn">Eliminar Cuenta</button>
    </form>
  </div>
</body>
</html>

