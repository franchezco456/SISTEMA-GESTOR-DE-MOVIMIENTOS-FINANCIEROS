<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Principal</title>
  <!--LINKS-->
  <link rel="stylesheet" href="../CSS/principal.css">
  <script src="../JS/divgenerator.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="../JS/grafica.js"></script>


</head>

<body>
  <!--cuadro superior-->
  <div id="CuadroSuperior">
    <h1>GESTOR DE MOVIMIENTOS FINANCIEROS</h1>
<<<<<<< HEAD:View/principal.php
    <label>
        
    </label>
     <button class="boton">
        <!--  AQUI PONGAN EL LINK PARA IR A LOS AJUSTES --> 
        <a href="../View/ConfiguracionUsuarios.php"> 
          <img src="../Media/ajusicon.png" style="height: 70px; width: 80px;" >
        </a>   
    </button>   
    </div> 
=======
     <p></p>
    <button class="boton1" style="border: none;">
      
      <!--  AQUI PONGAN EL LINK PARA IR A LOS AJUSTES -->
      <a href="INCERTE EL MALDITO LINK PARA IR A AJUSTES AQUI NO SEA PENDEJO">
        <img src="../Media/ajusicon.png" style="height: 70px; width: 80px;">
      </a>
    </button>
  </div>
>>>>>>> Jericoth:View/principal.html

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

<<<<<<< HEAD:View/principal.php
            <button class="boton">
                <a href="../View/ModificarCuenta.php">
                    <img src="../Media/ajusticoon.png" style="height: 50px; width: 50px;">
                </a>
            </button>
        </div>
        <!--HISTORIAL-->
        <div class="efectoglass" style="height: 250px; width: 35%;"></div>
=======
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
      <canvas id="graficaGastos" width="600" height="300"></canvas>
      <canvas id="graficaPastel" width="600" height="300"></canvas>
>>>>>>> Jericoth:View/principal.html

    </div>

  </center>



</body>

</html>