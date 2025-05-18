<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Cuenta</title>
    <link rel="stylesheet" href="../../../View/CSS/ModificarCuenta.css">
    <script src="../../../View/JS/modificarCuenta.js"></script>



</head>

<body>
    <div class="modificar-container">
        <a href="../Usuarios/principal.php" class="back-button">←</a>
        <h2>Modificar Datos de la Cuenta</h2>
        <form id="formModificar">
            <label>Nombre actual: <strong id="nombreActual"></strong></label>
            <input type="text" id="nuevoUsuario" placeholder="Nuevo nombre de cuenta">

            <label>Cantidad Inicial: <strong id="saldoActual"></strong></label>
            <input type="number" id="nuevoSaldo" placeholder="Nueva cantidad inicial">

            <label>Tope máximo actual: <strong id="topeActual"></strong></label>
            <input type="number" id="nuevoTope" placeholder="Nuevo tope máximo">

            <button type="submit" class="save-btn">Actualizar</button>
        </form>
    </div>


</body>

</html>