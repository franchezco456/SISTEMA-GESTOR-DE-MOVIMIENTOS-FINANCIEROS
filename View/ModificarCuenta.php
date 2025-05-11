<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Cuenta</title>
    <link rel="stylesheet" href="../CSS/ModificarCuenta.css">
</head>
<body>
    <div class="modificar-container">
        <a href="Principal.html" class="back-button">←</a>
        <h2>Modificar Datos de la Cuenta</h2>
        <form>
            <label>Nombre actual: <strong>USUARIO123456789</strong></label>
            <span class="change-text">Cambiar el nombre de la cuenta</span>
            <input type="text" placeholder="Nuevo nombre de cuenta">

            <label>Saldo actual: <strong>$000000000000</strong></label>
            <span class="change-text">Modificar saldo a gastar</span>
            <input type="number" placeholder="Nuevo saldo">

            <label>Tope máximo actual: <strong>$000000000000000</strong></label>
            <span class="change-text">Modificar tope máximo</span>
            <input type="number" placeholder="Nuevo tope máximo">

            <label for="categoria">Seleccionar categoría financiera:</label>
<select id="categoria" name="categoria" required>
    <option value="">Selecciona una categoría</option>
    <option value="alimentacion">Alimentación</option>
    <option value="transporte">Transporte</option>
    <option value="entretenimiento">Entretenimiento</option>
    <option value="salud">Salud</option>
    <option value="educacion">Educación</option>
    <option value="ahorro">Ahorro</option>
    <option value="otros">Otros</option>
</select>

            <button type="submit" class="save-btn">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
