<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Principal</title>
  <!--LINKS-->
  <link rel="stylesheet" href="../../../View/CSS/principal.css">
  <script src="../../../View/JS/divgenerator.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="../../../View/JS/grafica.js"></script>


</head>

<body>
  <!--cuadro superior-->
  <div id="CuadroSuperior">
    <h1>GESTOR DE MOVIMIENTOS FINANCIEROS</h1>
     <p></p>
    <button class="boton1" style="border: none;">
      
      <!--  AQUI PONGAN EL LINK PARA IR A LOS AJUSTES -->
      <a href="../Usuarios/ConfiguracionUsuarios.php">
        <img src="../../../View/Media/ajusicon.png" style="height: 70px; width: 80px;">
      </a>
    </button>
  </div>

  <!--Cuadro Inferior-->
  <center>
    <button class="boton1" onclick="mostrarFormulario()">+</button>
    <div id="formularioCategoria1" class="formulario oculto">
      <h2>Agregar</h2>
      <form id="formAgregar">
        <!--FORMULARIO CON LOS DATOS-->
        <label style="font-family: Arial, Helvetica, sans-serif;">Cuenta:</label>
        <input type="text" id="inputCuenta" required  style="font-family: Arial, Helvetica, sans-serif;"><br><br>

        <label style="font-family: Arial, Helvetica, sans-serif;">Saldo:</label>
        <input type="number" id="inputSaldo" required   style="font-family: Arial, Helvetica, sans-serif;"><br><br>

        <label style="font-family: Arial, Helvetica, sans-serif;">Tope:</label>
        <input type="number" id="inputTope" required   style="font-family: Arial, Helvetica, sans-serif;"><br><br>

        <button type="submit" class="boton1" style="width: 100px; font-size: 16px; background-color: aquamarine;">Crear</button>
      </form>
    </div>
    <div id="contenedor"></div>
   
  </center>
  <!--Cuadro de graficas-->
  <center>
    <div id="CuadroSuperior" style="margin-top: 100px; background-color: aquamarine;">
      <h1>GRAFICAS</h1>
    </div>
    <div id="inferior" style="display: grid; grid-template-columns: 2fr 1fr;">
      <canvas id="graficaGastos" width="600" height="300">

      
      </canvas>
      <canvas id="graficaPastel" width="600" height="300"></canvas>

    </div>

  </center>



</body>

</html>