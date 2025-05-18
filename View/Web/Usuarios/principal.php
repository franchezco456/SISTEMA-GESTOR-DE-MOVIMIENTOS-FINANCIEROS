<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="stylesheet" href="../../../View/CSS/principal.css">
    <script src="../../../View/JS/divgenerator.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../../View/JS/grafica.js"></script>
</head>

<body>
    <!-- Cuadro Superior -->
    <div id="CuadroSuperior">
        <h1>GESTOR DE MOVIMIENTOS FINANCIEROS</h1>
        <button class="boton1" style="border: none;">
            <a href="../Usuarios/ConfiguracionUsuarios.php">
                <img src="../../../View/Media/ajusicon.png" style="height: 70px; width: 80px;">
            </a>
        </button>
    </div>

    <!-- Formulario para agregar cuentas -->
    <center>
        <button class="boton1" onclick="mostrarFormulario()">+</button>
        <div id="formularioCategoria1" class="formulario oculto">
            <h2>Agregar</h2>
            <form id="formAgregar">
                <label>Cuenta:</label>
                <input type="text" id="inputCuenta" name="inputCuenta" required><br><br>
                <label>Saldo:</label>
                <input type="number" id="inputSaldo" name="inputSaldo" required><br><br>
                <label>Tope:</label>
                <input type="number" id="inputTope" name="inputTope" required><br><br>
                <button type="submit">Crear</button>
            </form>
        </div>
        <div id="contenedor"></div>
    </center>

    <!-- Cuadro de gráficas -->
    <center>
        <div id="CuadroSuperior" style="margin-top: 100px; background-color: aquamarine;">
            <h1>GRAFICAS</h1>
        </div>
        <div id="inferior" style="display: grid; grid-template-columns: 2fr 1fr;">
            <canvas id="graficaGastos" width="600" height="300"></canvas>
            <canvas id="graficaPastel" width="600" height="300"></canvas>
        </div>
    </center>
</body>

</html>
