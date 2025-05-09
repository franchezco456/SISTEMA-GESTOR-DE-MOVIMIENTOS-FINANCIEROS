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
    <form>
      <label>Nombre de usuario actual: <strong>jesustellez</strong></label>
      <span class="change-text">Cambiar el nombre de usuario actual</span>
      <input type="text" id="usuario" placeholder="Nuevo nombre de usuario">

      <label>Correo electrónico actual: <strong>jesus@mail.com</strong></label>
      <span class="change-text">Cambiar el correo electrónico actual</span>
      <input type="email" id="correo" placeholder="Nuevo correo electrónico">

      <label>Cédula actual: <strong>123456789</strong></label>
      <span class="change-text">Cambiar la cédula actual</span>
      <input type="number" id="cedula" placeholder="Nueva cédula">

      <label>Contraseña actual: <strong>••••••••</strong></label>
      <span class="change-text">Cambiar la contraseña actual</span>
      <input type="password" id="password" placeholder="Nueva contraseña">

      <button type="submit" class="save-btn">Guardar Cambios</button>
      <button type="button" class="delete-btn">Eliminar Cuenta</button>
    </form>
  </div>
</body>
</html>

