<?php
require_once '../../Model/Entidades/Usuario.php';
require_once '../../Model/Entidades/MovimientosFinancieros.php';
require_once '../MovimientosFinancieros/Auth/MovimientosFinancierosAuthService.php';
$tipo = $_POST['inputTipo'];
switch ($tipo) {
    case 'ingreso':
        session_start();
        $nombrecuenta = $_POST['tipoCuenta'];
        $monto = $_POST['monto'];
        $categoria = $_POST['categorias'];
        if ($categoria == '' || $monto == '' || $nombrecuenta == '') {
            $_SESSION['mensaje']="favor complete todos los ampos";
            header('location: ../../View/Web/Usuarios/principal.php');
        }
        if (isset($_SESSION['cuentasCurUser'])) {
            $cuentas = json_decode($_SESSION['cuentasCurUser'], false);
            foreach ($cuentas as $cuenta) {
                echo "<script>console.log('cuenta: " . $nombrecuenta . "');</script>";
                echo "<script>console.log('cuenta: " . $cuenta->nombre . "');</script>";
                if ($cuenta->nombre == $nombrecuenta) {
                    $idCuenta = $cuenta->idCuenta;
                }
            }

        }
        if (isset($_SESSION['usuarioActual'])) {
            $usuario = json_decode($_SESSION['usuarioActual']);
            $idUsuario = $usuario->id;
            $user = new Usuario($usuario->id, $usuario->nombre, $usuario->correo, $usuario->pass);

        }
        if ($monto < 0) {
            $monto = $monto * -1;
        }
        $movimiento = new MovimientosFinancieros(null, $idCuenta, $categoria, $monto, null, $idUsuario);
        $auth = new MovimientosFinancierosAuthService();
        $resultado = $auth->saveMovimientoFinanciero($movimiento);
        if ($resultado) {
            $auth->consultMovimientosFinancierosUsuario($user);
            header('location: ../../View/Web/Usuarios/principal.php');
        } else {
            echo "<script>console.log('Error al guardar el movimiento');</script>";
        }
        break;
    case 'egreso':
        session_start();
        $nombrecuenta = $_POST['tipoCuenta'];
        $monto = $_POST['monto'];
        $categoria = $_POST['categorias'];
        if ($categoria == '' || $monto == '' || $nombrecuenta == '') {
            $_SESSION['mensaje']="favor complete todos los ampos";
            header('location: ../../View/Web/Usuarios/principal.php');
        }
        if (isset($_SESSION['cuentasCurUser'])) {
            $cuentas = json_decode($_SESSION['cuentasCurUser'], false);
            foreach ($cuentas as $cuenta) {
                echo "<script>console.log('cuenta: " . $nombrecuenta . "');</script>";
                echo "<script>console.log('cuenta: " . $cuenta->nombre . "');</script>";
                if ($cuenta->nombre == $nombrecuenta) {
                    $idCuenta = $cuenta->idCuenta;
                }
            }

        }
        if (isset($_SESSION['usuarioActual'])) {
            $usuario = json_decode($_SESSION['usuarioActual']);
            $idUsuario = $usuario->id;
            $user = new Usuario($usuario->id, $usuario->nombre, $usuario->correo, $usuario->pass);

        }
        if ($monto > 0) {
            $monto = $monto * -1;
        }
        $movimiento = new MovimientosFinancieros(null, $idCuenta, $categoria, $monto, null, $idUsuario);
        $auth = new MovimientosFinancierosAuthService();
        $resultado = $auth->saveMovimientoFinanciero($movimiento);
        if ($resultado) {
            $auth->consultMovimientosFinancierosUsuario($user);
            header('location: ../../View/Web/Usuarios/principal.php');
        } else {
            echo "<script>console.log('Error al guardar el movimiento');</script>";
        }
        break;
    case 'transferencia':
        session_start();
        $categoria = "transferencia";
        $monto = $_POST['monto'];
        if ($categoria == '' || $monto == '') {
            $_SESSION['mensaje']="favor complete todos los ampos";
            header('location: ../../View/Web/Usuarios/principal.php');
        }
        if (isset($_SESSION['cuentasCurUser'])) {
            $cuentas = json_decode($_SESSION['cuentasCurUser'], false);
            foreach ($cuentas as $cuenta) {
                echo "<script>console.log('cuenta: " . $nombrecuenta . "');</script>";
                echo "<script>console.log('cuenta: " . $cuenta->nombre . "');</script>";
                if ($cuenta->nombre == $nombrecuenta) {
                    $idCuenta = $cuenta->idCuenta;
                }
            }

        }
        if (isset($_SESSION['usuarioActual'])) {
            $usuario = json_decode($_SESSION['usuarioActual']);
            $idUsuario = $usuario->id;
            $user = new Usuario($usuario->id, $usuario->nombre, $usuario->correo, $usuario->pass);

        }
        if ($monto < 0) {
            $monto = $monto * -1;
        }
        $origen = $_POST['tipoCuentaOrigen'];
        $destino = $_POST['tipoCuentaDestino'];
        $idCuentaOrigen = null;
        $idCuentaDestino = null;
        if (isset($_SESSION['cuentasCurUser'])) {
            $cuentas = json_decode($_SESSION['cuentasCurUser'], false);
            foreach ($cuentas as $cuenta) {
                echo "<script>console.log('cuenta: " . $origen . "');</script>";
                echo "<script>console.log('cuenta: " . $cuenta->nombre . "');</script>";
                if ($cuenta->nombre == $origen) {
                    $idCuentaOrigen = $cuenta->idCuenta;
                } 
                if ($cuenta->nombre == $destino) {
                    $idCuentaDestino = $cuenta->idCuenta;
                }
            }
        }
        if ($idCuentaOrigen === null || $idCuentaDestino === null) {
            die("Error: No se encontró la cuenta de origen o destino para la transferencia.");
        }
        $montoOrigen = $monto * -1;
        $movimientoOrigen = new MovimientosFinancieros(null, $idCuentaOrigen, $categoria, $montoOrigen, null, $idUsuario);
        $movimientoDestino = new MovimientosFinancieros(null, $idCuentaDestino, $categoria, $monto, null, $idUsuario);
        $auth = new MovimientosFinancierosAuthService();
        $resultado = $auth->saveMovimientoFinanciero($movimientoOrigen);
        $resultado2 = $auth->saveMovimientoFinanciero($movimientoDestino);
        if ($resultado && $resultado2) {
            $auth->consultMovimientosFinancierosUsuario($user);
            header('location: ../../View/Web/Usuarios/principal.php');
        } else {
            echo "<script>console.log('Error al guardar el movimiento');</script>";
        }
        break;
    default:
        echo "<script>console.log('Tipo de movimiento no válido');</script>";
        break;
}
?>