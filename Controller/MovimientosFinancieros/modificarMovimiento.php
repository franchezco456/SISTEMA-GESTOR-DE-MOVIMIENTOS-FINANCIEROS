<?php
require_once __DIR__ . '/Auth/MovimientosFinancierosAuthService.php';
require_once __DIR__ . '/../../Model/Entidades/MovimientosFinancieros.php';
    function validar_movimiento($idmovimiento)
    {
        $movimientos = json_decode($_SESSION['movimientosCurUser'], false);
        foreach ($movimientos as $movimiento) {
            if ($movimiento->idMovimiento == $idmovimiento) {
                return true;
            }
        }
        return false;
    }
session_start();
if (isset($_SESSION['usuarioActual'])) {
    $tipo = $_POST['tipoMovimientoModificar'];
    switch ($tipo) {
        case 'ingreso':
            $nombrecuenta = $_POST['Cuentanueva'];
            $monto = $_POST['nuevaCantidad'];
            $categoria = $_POST['nuevaCategoria'];
            $idMovimientoModificar = $_POST['idMovimientoModificar'];
            if ($monto < 0) {
                $monto = $monto * -1;
            }
            if (!empty($idMovimientoModificar)) {
                $validacion = validar_movimiento($idMovimientoModificar);
                if ($validacion) {
                    if ($categoria == '' || $monto == '' || $nombrecuenta == '') {
                        $_SESSION['mensaje'] = "favor complete todos los ampos";
                        header('location: ../../View/Web/Usuarios/principal.php');
                    }
                    if (isset($_SESSION['cuentasCurUser'])) {
                        $cuentas = json_decode($_SESSION['cuentasCurUser'], false);
                        $idCuenta = null;
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
                        $user = new Usuario($usuario->id, $nombre, $correo, $pass);
                    }
                    $movimiento = new MovimientosFinancieros($idMovimientoModificar, $idCuenta, $categoria, $monto, null, $idUsuario);
                    $auth = new MovimientosFinancierosAuthService();
                    $resultado = $auth->updateMovimientoFinanciero($movimiento);
                    if ($resultado) {
                        $auth->consultMovimientosFinancierosUsuario($user);
                        header('location: ../../View/Web/Usuarios/principal.php');
                    } else {
                        $_SESSION['mensaje'] = "Error al actualizar el movimiento";
                        header('location: ../../View/Web/Usuarios/principal.php');
                    }
                } else {
                    $_SESSION['mensaje'] = "el movimiento financiero a actualizar no existe";
                    header('location: ../../View/Web/Usuarios/principal.php');
                }


            } else {
                $_SESSION['mensaje'] = "favor ingresar un id valido";
                header('location: ../../View/Web/Usuarios/principal.php');
            }
            break;
        case 'egreso':
            $nombrecuenta = $_POST['Cuentanueva'];
            $monto = $_POST['nuevaCantidad'];
            $categoria = $_POST['nuevaCategoria'];
            $idMovimientoModificar = $_POST['idMovimientoModificar'];
            if ($monto > 0) {
                $monto = $monto * -1;
            }
            if (!empty($idMovimientoModificar)) {
                $validacion = validar_movimiento($idMovimientoModificar);
                if ($validacion) {
                    if ($categoria == '' || $monto == '' || $nombrecuenta == '') {
                        $_SESSION['mensaje'] = "favor complete todos los ampos";
                        header('location: ../../View/Web/Usuarios/principal.php');
                    }
                    if (isset($_SESSION['cuentasCurUser'])) {
                        $cuentas = json_decode($_SESSION['cuentasCurUser'], false);
                        $idCuenta = null;
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
                        $user = new Usuario($usuario->id, $nombre, $correo, $pass);
                    }
                    $movimiento = new MovimientosFinancieros($idMovimientoModificar, $idCuenta, $categoria, $monto, null, $idUsuario);
                    $auth = new MovimientosFinancierosAuthService();
                    $resultado = $auth->updateMovimientoFinanciero($movimiento);
                    if ($resultado) {
                        $auth->consultMovimientosFinancierosUsuario($user);
                        header('location: ../../View/Web/Usuarios/principal.php');
                    } else {
                        $_SESSION['mensaje'] = "Error al actualizar el movimiento";
                        header('location: ../../View/Web/Usuarios/principal.php');
                    }
                } else {
                    $_SESSION['mensaje'] = "el movimiento financiero a actualizar no existe";
                    header('location: ../../View/Web/Usuarios/principal.php');
                }


            } else {
                $_SESSION['mensaje'] = "favor ingresar un id valido";
                header('location: ../../View/Web/Usuarios/principal.php');
            }
            break;
        default:
            break;
    }
}
?>