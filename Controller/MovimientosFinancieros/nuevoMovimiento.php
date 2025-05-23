<?php
require_once '../../Model/Entidades/Usuario.php';
require_once '../../Model/Entidades/MovimientosFinancieros.php';
require_once '../MovimientosFinancieros/Auth/MovimientosFinancierosAuthService.php';
session_start();
$nombrecuenta = $_POST['tipoCuentaIngreso'];
$monto = $_POST['monto'];
$categoria = $_POST['categorias'];   
$tipo = $_POST['inputTipo'];
if (isset($_SESSION['cuentasCurUser'])) {
    $cuentas = json_decode($_SESSION['cuentasCurUser'], false);
    foreach ($cuentas as $cuenta) {
        echo "<script>console.log('cuenta: ".$nombrecuenta."');</script>";
        echo "<script>console.log('cuenta: ".$cuenta->nombre."');</script>";
        if($cuenta->nombre == $nombrecuenta){
            $idCuenta = $cuenta->idCuenta;
        }
    }

}
if (isset($_SESSION['usuarioActual'])) {
    $usuario = json_decode($_SESSION['usuarioActual']);
    $idUsuario = $usuario->id;
    $user = new Usuario($usuario->id, $usuario->nombre, $usuario->correo, $usuario->pass);

}
if ($monto < 0 && $tipo == "ingreso") {
    $monto = $monto * -1;
}
if ($monto > 0 && $tipo == "egreso") {
    $monto = $monto * -1;
}
$movimiento = new MovimientosFinancieros(null, $idCuenta,  $categoria, $monto, null, $idUsuario);
$auth = new MovimientosFinancierosAuthService();
$resultado=$auth->saveMovimientoFinanciero($movimiento);
if($resultado){
    $auth->consultMovimientosFinancierosUsuario($user);
    header('location: ../../View/Web/Usuarios/principal.php');
}else{
    echo "<script>console.log('Error al guardar el movimiento');</script>";
}
?>