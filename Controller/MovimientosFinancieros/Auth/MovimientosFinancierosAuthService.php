<?php
require_once __DIR__ . '/../../../Model/Persistencia/Movimientos_Financieros/movimientosFinancierosDAO.php';
require_once __DIR__ . '/../../../Model/Entidades/CuentaFinanciera.php';
require_once __DIR__ . '/../../../Model/Entidades/Usuario.php';
require_once __DIR__ . '/../../../Model/Entidades/MovimientosFinancieros.php';
class MovimientosFinancierosAuthService{
//saveMovimientoFinanciero
public function saveMovimientoFinanciero(MovimientosFinancieros $movimiento, Usuario $user){
$DAO = new movimientosFinancierosDAO();
$resultado = $DAO->guardarMovimientoFinanciero($movimiento);
if($resultado){
  return true;
  }else{
   return false;
}
}
//deleteMovimientoFinanciero
public function deleteMovimientoFinanciero(MovimientosFinancieros $movimiento, Usuario $user){
$DAO = new movimientosFinancierosDAO();
$validacion = $DAO->validarMovimientosFinancieros($movimiento);
if($validacion){
$resultado = $DAO->eliminarMovimientoFinanciero($movimiento);
if($resultado){
  return true;
}else{
    return false;
}
}else{
    return false;
}
}
//actualizarMovimientoFinanciero
public function updateMovimientoFinanciero(MovimientosFinancieros $movimiento, Usuario $user){
$DAO = new movimientosFinancierosDAO();
$validacion = $DAO->validarMovimientosFinancieros($movimiento);
if($validacion){
$resultado = $DAO->actualizarMovimientoFinanciero($movimiento);
if($resultado){
  return true;
}else{
    return false;
}
}else{
    return false;
}
}
//consultar movimiento financiero 
public function consultMovimientosFinancierosUsuario(Usuario $usuario){
$DAO = new movimientosFinancierosDAO();
$listaMovimientos=$DAO->consultarMovimientosFinancierosUsuario($usuario);
if(!empty($listaMovimientos)){
  $_SESSION['movimientosCurUser']=json_encode($listaMovimientos);
}else{
    $_SESSION['movimientosCurUser']=json_encode($listaMovimientos = []);
}
}
//clasificar movimientos financieros por cuenta
public function clasificarMovimientosFinancierosCuenta(Usuario $usuario) {
$DAO = new movimientosFinancierosDAO();
$listaMovimientos = $DAO->consultarMovimientosFinancierosUsuario($usuario);
$movimientosClasificados = [];
if (!empty($listaMovimientos)) {
    foreach ($listaMovimientos as $movimiento) {
        $idCuenta = $movimiento->getIdCuenta();
        if (!isset($movimientosClasificados[$idCuenta])) {
        $movimientosClasificados[$idCuenta] = [];
        }
    $movimientosClasificados[$idCuenta][] = $movimiento;
    }
    }
    $_SESSION['movimientosCurUserCuentas'] = json_encode($movimientosClasificados);
}
}
?>