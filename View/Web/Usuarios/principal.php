<?php
session_start();
if (isset($_SESSION['cuentasCurUser'])) {
    $cuentas = json_decode($_SESSION['cuentasCurUser'], false);
    $nombrescuentas = [];
    //$nombrescuentas[] = ['nombre' => ''];  // Inicializa el arreglo con un valor por defecto
    foreach ($cuentas as $cuenta) {
        $nombrescuentas[] = [  // Almacena cada cuenta en un arreglo
            'idCuenta' => $cuenta->idCuenta,
            'nombre' => $cuenta->nombre
        ];
    }

}
if (isset($_SESSION['movimientosCurUser'])) {
    $movimientos = json_decode($_SESSION['movimientosCurUser'], false);
    $movimientosfinancieros = [];
    $nombreaccount = '';
    foreach ($movimientos as $movimiento) {
        $nombreaccount = '';  // Reinicia el nombre de la cuenta para cada movimiento
        foreach ($nombrescuentas as $nombrecuenta) {
            if ($movimiento->idCuenta == $nombrecuenta['idCuenta']) {  // Verifica que el id de la cuenta coincida
                $nombreaccount = $nombrecuenta['nombre'];
            }
        }
        $movimientosfinancieros[] = [  // Almacena cada movimiento en un arreglo
            'idMovimiento' => $movimiento->idMovimiento,
            'categoria' => $movimiento->categoria,
            'cantidad' => $movimiento->cantidad,
            'fecha' => $movimiento->fecha,
            'idCuenta' => $movimiento->idCuenta,
            'nombre' => $nombreaccount
        ];
    }
} else {
    $movimientosfinancieros = ['nomovimientos' => 'No hay movimientos registrados.'];
}
if (isset($_SESSION['mensaje'])) {
    echo "<script>
            window.onload = function() {
                alert('" . $_SESSION['mensaje'] . "');
            };
          </script>";
    unset($_SESSION['mensaje']);
}
?>
<script>
    console.log(<?php echo json_encode($nombrescuentas); ?>);
</script>
<script>
    console.log(<?php echo json_encode($movimientosfinancieros); ?>);
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
        <button class="boton1" onclick="location.href='../../../Controller/Usuario/cerrarsesion.php'"><img
                src="../../../View/Media/iconCerrar.png" class="ajusicon" style="width: 150%; height: 150%;">
            <!-- CREAR CONTROLADOR LOGOUT Y DESTRUIR LA SESION Y QUE DIRIJA AL LOGIN -->
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
            <form id="ingreso" action="../../../Controller/MovimientosFinancieros/nuevoMovimiento.php" method="POST">
                <label>MONTO</label> <input type="number" name="monto" id="monto" required><br>
                <label>CATEGORIA</label> <select name="categorias" id="categorias" required>
                    <option disabled selected>Selecciona una categoria</option>
                    <option value="Salario">Salario</option>
                    <option value="Inversiones">Inversiones</option>
                    <option value="Renta">Renta</option>
                    <option value="Regalos">Regalos</option>
                    <option value="Otros">Otros</option>
                </select>
                <br>
                <?php
                foreach ($nombrescuentas as $nombrecuenta) {
                    if ($nombrecuenta['nombre'] != '') {  // Verifica que el nombre de la cuenta no esté vacío
                        echo "<label><input type='radio' value=" . $nombrecuenta['nombre'] . " name='tipoCuenta' id='tipoCuentaIngreso' required>" . $nombrecuenta['nombre'] . "</label>";
                    }
                }
                ?>
                <input type="text" id="inputTipo" name="inputTipo" value="ingreso" hidden>
                <button type="submit" value="submit">Guardar</button>
            </form>
        </div>

        <div id="dEgreso" class="oculto">
            <form id="egreso" action="../../../Controller/MovimientosFinancieros/nuevoMovimiento.php" method="POST">
                <label>EGRESO</label> <input type="number" name="monto" id="monto" required><br>
                <label>CATEGORIA</label> <select name="categorias" id="categorias" required>
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
                foreach ($nombrescuentas as $nombrecuenta) {
                    if ($nombrecuenta['nombre'] != '') {  // Verifica que el nombre de la cuenta no esté vacío
                        echo "<label><input type='radio' value=" . $nombrecuenta['nombre'] . " name='tipoCuenta' required>" . $nombrecuenta['nombre'] . "</label>";
                    }
                }
                ?>
                <input type="text" id="inputTipo" name="inputTipo" value="egreso" hidden>
                <button type="submit" value="submit">Guardar</button>
            </form>
        </div>

        <div id="dTransferencia" class="oculto">
            <form id="transferenciaCuentas" action="../../../Controller/MovimientosFinancieros/nuevoMovimiento.php"
                method="POST">
                <label>CUENTA ORIGEN</label><br>
                <?php
                foreach ($nombrescuentas as $nombrecuenta) {
                    if ($nombrecuenta['nombre'] != '') {  // Verifica que el nombre de la cuenta no esté vacío
                        echo "<label><input type='radio' value=" . $nombrecuenta['nombre'] . " name='tipoCuentaOrigen' required>" . $nombrecuenta['nombre'] . "</label>";
                    }
                }
                ?>
                <br>
                <label>CUENTA DESTINO</label><br>
                <?php
                foreach ($nombrescuentas as $nombrecuenta) {
                    if ($nombrecuenta['nombre'] != '') {  // Verifica que el nombre de la cuenta no esté vacío
                        echo "<label><input type='radio' value=" . $nombrecuenta['nombre'] . " name='tipoCuentaDestino' required>" . $nombrecuenta['nombre'] . "</label>";
                    }
                }
                ?>
                <label for="monto">Monto de la transaccion</label>
                <input type="number" placeholder="monto de la transaccion" name="monto" id="monto" required>
                <input type="text" id="inputTipo" name="inputTipo" value="transferencia" hidden>
                <button type="submit" value="submit">Guardar</button>
            </form>
        </div>
    </div>

    <!-- cuadro Historial -->
    <center>
        <div id="CuadroSuperior">
            <h1>HISTORIAL DE MOVIMIENTOS</h1>
        </div>
        <div id="divHistorial">
            <table class="tablaHistorial">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Categoria</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Cuenta</th>
                    </tr>
                </thead>
                <tbody id="tablaDatos">
                    <?php
                    if (!empty($movimientosfinancieros)) {
                        foreach ($movimientosfinancieros as $movimiento) {
                            echo "<tr>";
                            echo "<td>" . $movimiento['idMovimiento'] . "</td>";
                            echo "<td>" . $movimiento['categoria'] . "</td>";
                            echo "<td>" . $movimiento['cantidad'] . "</td>";
                            echo "<td>" . $movimiento['fecha'] . "</td>";
                            echo "<td>" . $movimiento['nombre'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No hay movimientos registrados.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div id="dMovimientos">
            <div class="tarjeta" onclick="mostrarFormularioModificar()" style="cursor: pointer;">
                <img src="../../../View/Media/modificar.png" style="height: 50px; width: 70px;">
                <h3>MODIFICAR MOVIMIENTO</h3>
                <label>Modifica tus gastos</label>
            </div>

            <div class="tarjeta" onclick="mostrarFormularioEliminar()" style="cursor: pointer;">
                <img src="../../../View/Media/eliminar.png" style="height: 50px; width: 100px;">
                <h3>ELIMINAR MOVIMIENTO</h3>
                <label>elimina tus movimientos</label>
            </div>
        </div>

        <div id="divModificarHistorial">
            <div id="dModificar" class="oculto">
                <form class="modificarMovimiento" action="../../../Controller/MovimientosFinancieros/modificarMovimiento.php"
                method="POST">
                    <label>Modificar Movimiento</label>
                    <input type="number" id="idMovimientoModificar" name="idMovimientoModificar" required><br><br>

                    <label>Tipo de Movimiento</label>
                    <select id="tipoMovimientoModificar" name="tipoMovimientoModificar" required
                        onchange="mostrarCategoriasModificar()">
                        <option value="" disabled selected>Selecciona tipo</option>
                        <option value="ingreso">Ingreso</option>
                        <option value="egreso">Egreso</option>
                    </select><br><br>

                    <label>Nueva Categoria</label>
                    <select id="categoriaIngresoModificar" name="nuevaCategoria" class="oculto">
                        <option value="" disabled selected>Selecciona una categoria</option>
                        <option value="Salario">Salario</option>
                        <option value="Inversiones">Inversiones</option>
                        <option value="Renta">Renta</option>
                        <option value="Regalos">Regalos</option>
                        <option value="Otros">Otros</option>
                    </select>
                    <select id="categoriaEgresoModificar" name="nuevaCategoria" class="oculto">
                        <option value="" disabled selected>Selecciona una categoria</option>
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
                    <br><br>

                    <label>Nueva Cantidad</label>
                    <input type="number" id="nuevaCantidad" name="nuevaCantidad" required><br><br>
                     <label>Nueva cuenta</label>
                    <?php
                    foreach ($nombrescuentas as $nombrecuenta) {
                        if ($nombrecuenta['nombre'] != '') {  // Verifica que el nombre de la cuenta no esté vacío
                            echo "<label><input type='radio' value=" . $nombrecuenta['nombre'] . " name='Cuentanueva' id='tipoCuentaIngreso' required>" . $nombrecuenta['nombre'] . "</label>";
                        }
                    }
                    ?>
                    <button type="submit">Modificar</button>
                </form>

                <script>
                    function mostrarCategoriasModificar() {
                        var tipo = document.getElementById('tipoMovimientoModificar').value;
                        document.getElementById('categoriaIngresoModificar').classList.add('oculto');
                        document.getElementById('categoriaEgresoModificar').classList.add('oculto');
                        document.getElementById('categoriaIngresoModificar').required = false;
                        document.getElementById('categoriaEgresoModificar').required = false;

                        if (tipo === 'ingreso') {
                            document.getElementById('categoriaIngresoModificar').classList.remove('oculto');
                            document.getElementById('categoriaIngresoModificar').required = true;
                        } else if (tipo === 'egreso') {
                            document.getElementById('categoriaEgresoModificar').classList.remove('oculto');
                            document.getElementById('categoriaEgresoModificar').required = true;
                        }
                    }
                </script>

                <style>
                    .oculto {
                        display: none;
                    }
                </style>
            </div>
            <div id="dEliminarHistorial" class="oculto">
                <form id="eliminarMovimiento" action="../../../Controller/MovimientosFinancieros/eliminarmovimiento.php"
                    method="POST">
                    <label>Eliminar Movimiento</label>
                    <input type="number" id="idMovimientoEliminar" name="idMovimientoEliminar" required><br><br>
                    <button type="submit">Eliminar</button>
                </form>
            </div>
        </div>

    </center>
    <center>
        <div id="CuadroSuperior" style="margin-top: 100px; background-color: aquamarine;">
            <h1>GRAFICAS</h1>
        </div>
        <div id="inferior">
            <canvas id="graficaGastos"></canvas>
            <canvas id="graficaPastel"></canvas>
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

    <script>
        function mostrarFormularioModificar() {
            document.getElementById('dModificar').classList.remove('oculto');
            document.getElementById('dEliminarHistorial').classList.add('oculto');
        }

        function mostrarFormularioEliminar() {
            document.getElementById('dModificar').classList.add('oculto');
            document.getElementById('dEliminarHistorial').classList.remove('oculto');
        }
    </script>

</body>

</html>