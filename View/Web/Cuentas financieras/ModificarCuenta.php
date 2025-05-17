<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Cuenta</title>
    <link rel="stylesheet" href="../../../View/CSS/ModificarCuenta.css">
</head>
<body>
    <div class="modificar-container">
        <a href="../Usuarios/principal.php" class="back-button">←</a>
        <h2>Modificar Datos de la Cuenta</h2>
        <form>
            <label>Nombre actual: <strong>USUARIO123456789</strong></label>
            <span class="change-text">Cambiar el nombre de la cuenta</span>
            <input type="text" placeholder="Nuevo nombre de cuenta">

            <label>Cantidad Inicial: <strong>$000000000000</strong></label>
            <span class="change-text">Modificar cantidad inicial</span>
            <input type="number" placeholder="Nueva cantidad inicial">

            <label>Tope máximo actual: <strong>$000000000000000</strong></label>
            <span class="change-text">Modificar tope máximo</span>
            <input type="number" placeholder="Nuevo tope máximo">

            <button type="submit" class="save-btn">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
