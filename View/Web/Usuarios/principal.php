<?php
session_start();
if(isset($_SESSION['cuentasCurUser'])){
    $cuentas = json_decode($_SESSION['cuentasCurUser'], false);
    $nombrescuentas = [];
    $nombrescuentas[] = ['nombre' => ''];  // Inicializa el arreglo con un valor por defecto
    foreach($cuentas as $cuenta){
        $nombrescuentas[] = [  // Almacena cada cuenta en un arreglo
            'nombre' => $cuenta->nombre
        ];
    }
    
}
?>
<script>
    console.log(<?php echo json_encode($nombrescuentas); ?>);
</script>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="stylesheet" href="../../CSS/principal.css">
    <!--<link rel="stylesheet" href="../../CSS/letras.css">-->
    <!--<link rel="stylesheet" href="../../CSS/botones.css">-->
    <!--<link rel="stylesheet" href="../../CSS/otros.css">-->
    

    <script src="../../../View/JS/divgenerator.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../../View/JS/grafica.js"></script>
</head>

<body>
    <!-- Cuadro Superior -->
    <div id="CuadroSuperior">
        <h1>GESTOR DE MOVIMIENTOS FINANCIEROS</h1>
        <button class="boton1" style="border: none;">
            <a href="./ConfiguracionUsuarios.php" class="boton1" style="border: none;">
                <img src="../../../View/Media/ajusicon.png" class="ajusicon">
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
                <label>Cantidad Inicial:</label>
                <input type="number" id="inputSaldo" name="inputSaldo" required><br><br>
                <label>Tope:</label>
                <input type="number" id="inputTope" name="inputTope" required><br><br>
                <button type="submit">Crear</button>
            </form>
        </div>
        <div id="contenedor"></div>
    </center>
    <div id="dMovimientos">
        <div class="tarjeta" onclick="mostrarFormularioIngreso()" style="cursor: pointer;">
            <img src="../../../View/Media/ingreso.png" style="height: 50px; width: 70px;">
            <h3>INGRESO</h3>
            <label>Gestiona tus ingresos</label>
        </div>

        <div class="tarjeta" onclick="mostrarFormularioEgreso()" style="cursor: pointer;">
        <img src="../../../View/Media/egreso.png" style="height: 50px; width: 100px;">
        <h3>GASTOS</h3>
        <label>Controla tus gastos</label>
        </div>

        <div class="tarjeta" onclick="mostrarFormularioTransferencia()" style="cursor: pointer;">
            <img src="../../../View/Media/transferencia.jpg" style="height: 50px; width: 100px;">
            <h3>TRANSFERENCIA ENTRE CUENTAS</h3>
            <label>Gestiona las transferencias entre las cuentas</label>
        </div>
    </div>  
    <div id="dformulariosIngresoEgreso">
        <div id="dIngreso" class="oculto">
            <form id="ingreso">
                <label>MONTO</label> <input type="number"><br>
                <label>CATEGORIA</label> <select name="categorias" id="categorias">
                    <option disabled selected>Selecciona una categoria</option>
                    <option value="Salario">Salario</option>
                    <option value="Inversiones">Inversiones</option>
                    <option value="Renta">Renta</option>
                    <option value="Regalos">Regalos</option>
                    <option value="Otros">Otros</option>
                </select>
                <br>
                <?php
                foreach($nombrescuentas as $nombrecuenta){
                    if($nombrecuenta['nombre'] != ''){  // Verifica que el nombre de la cuenta no esté vacío
                         echo "<label><input type='radio' name='tipoCuentaIngreso'>".$nombrecuenta['nombre']."</label>";
                    }
                }
                ?>
                <button type="submit" value="submit">Guardar</button>
            </form>
        </div>

        <div id="dEgreso" class="oculto">
            <form id="egreso">
                <label>EGRESO</label> <input type="number"><br>
                <label>CATEGORIA</label> <select name="categorias" id="categorias">
                    <option disabled selected>Selecciona una categoria</option>
                    <option value="Alimentos">Alimentos</option>
                    <option value="Facturas">Facturas</option>
                    <option value="Transporte">Transporte</option>
                    <option value="Compras">Compras</option>
                    <option value="Regalos">Regalos</option>
                    <option value="Educacion">Educacion</option>
                    <option value="Renta">Renta</option>
                    <option value="Viajes">Viajes</option>
                    <option value="Otros">Otros</option>
                </select>
                <br>
                <?php
                foreach($nombrescuentas as $nombrecuenta){
                    if($nombrecuenta['nombre'] != ''){  // Verifica que el nombre de la cuenta no esté vacío
                         echo "<label><input type='radio' name='tipocuentaEgreso'>".$nombrecuenta['nombre']."</label>";
                    }
                }
                ?>
                <button type="submit" value="submit">Guardar</button>
            </form>
        </div>

        <div id="dTransferencia" class="oculto">
            <form id="transferenciaCuentas">
                <label>CUENTA ORIGEN</label><br>
                <?php
                foreach($nombrescuentas as $nombrecuenta){
                    if($nombrecuenta['nombre'] != ''){  // Verifica que el nombre de la cuenta no esté vacío
                         echo "<label><input type='radio' name='tipoCuentaOrigen'>".$nombrecuenta['nombre']."</label>";
                    }
                }
                ?>
                <br>
                <label>CUENTA DESTINO</label><br>
                <?php
                foreach($nombrescuentas as $nombrecuenta){
                    if($nombrecuenta['nombre'] != ''){  // Verifica que el nombre de la cuenta no esté vacío
                         echo "<label><input type='radio' name='tipoCuentaDestino'>".$nombrecuenta['nombre']."</label>";
                    }
                }
                ?>

                <label for="monto">Monto de la transaccion</label>
                <input type="number" placeholder = "monto de la transaccion" name="monto" id="monto" required>
                <button type="submit" value="submit">Guardar</button>
            </form>
        </div>
    </div>
    <center>
        <div id="CuadroSuperior" style="margin-top: 100px; background-color: aquamarine;">
            <h1>GRAFICAS</h1>
        </div>
        <div id="inferior" style="display: grid; grid-template-columns: 1fr 1fr;">
            <canvas id="graficaGastos" style= "display: flex; margin: auto;"></canvas>
            <canvas id="graficaPastel" style= "display: flex; margin: auto;"></canvas>
        </div>
    </center>

<script>
function mostrarFormularioIngreso() {
    document.getElementById('dIngreso').classList.remove('oculto');
    document.getElementById('dEgreso').classList.add('oculto');
    document.getElementById('dTransferencia').classList.add('oculto');
}

function mostrarFormularioEgreso() {
    document.getElementById('dIngreso').classList.add('oculto');
    document.getElementById('dEgreso').classList.remove('oculto');
    document.getElementById('dTransferencia').classList.add('oculto');
}

function mostrarFormularioTransferencia() {
    document.getElementById('dIngreso').classList.add('oculto');
    document.getElementById('dEgreso').classList.add('oculto');
    document.getElementById('dTransferencia').classList.remove('oculto');
}
</script>

</body>

</html>