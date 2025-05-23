<?php
require_once '../../Model/Entidades/Usuario.php';
require_once '../../Model/Entidades/MovimientosFinancieros.php';
require_once '../MovimientosFinancieros/Auth/MovimientosFinancierosAuthService.php';
$idMovimientoeliminar = $_POST['idMovimientoEliminar'];
$auth = new MovimientosFinancierosAuthService();
session_start();
if (isset($_SESSION['usuarioActual'])) {
    $usuario = json_decode($_SESSION['usuarioActual']);
    $idUsuario = $usuario->id;
    $user = new Usuario($usuario->id, $usuario->nombre, $usuario->correo, $usuario->pass);
}
if (!empty($idMovimientoeliminar)) {
    $validacion = validar_movimineto($idMovimientoeliminar);
    if ($validacion) {
        $movimiento = new MovimientosFinancieros($idMovimientoeliminar, null, null, null, null, null);
        $resultado = $auth->deleteMovimientoFinanciero($movimiento);
        if ($resultado) {
            $auth->consultMovimientosFinancierosUsuario($user);
            header('location: ../../View/Web/Usuarios/principal.php');
        } else {
            $_SESSION['mensaje'] = "Error al eliminar el movimiento";
            header('location: ../../View/Web/Usuarios/principal.php');
        }
    }else{
        $_SESSION['mensaje'] = "el movimiento financiero a eliminar no existe";
        header('location: ../../View/Web/Usuarios/principal.php');
    }

}
function validar_movimineto($idmovimiento)
{
    session_start();
    $movimientos = json_decode($_SESSION['movimientosCurUser'], false);
    foreach ($movimientos as $movimiento) {
        if ($movimiento->idMovimiento == $idmovimiento) {
            return true;
        }
    }
    return false;
}
?>
<!-- 
>triggers para bd
>MODIFICAR MOVIMIENTO NO IDENTIFICA CUANDO SE SELECCIONA UN ID NO EXISTENTE PARA EL USUARIO
-->