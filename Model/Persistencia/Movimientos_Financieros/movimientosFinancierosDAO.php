<?php
require_once dirname(__DIR__, 3) . '/Util/Conexion.php';
require_once __DIR__ . '/../../../Model/Entidades/MovimientosFinancieros.php';
require_once __DIR__ . '/../../../Model/Entidades/Usuario.php';
require_once "ImovimientosFinancieros.php";
class movimientosFinancierosDAO{
//Guardar movimiento financiero
public function guardarMovimientoFinanciero(MovimientosFinancieros $movimiento){
$idCuenta = $movimiento->getIdCuenta();
$categoria = $movimiento->getCategoria();
$cantidad = $movimiento->getCantidad();
$idUsuario = $movimiento->getIdUsuario();
$cn = new Conexion();
$cn->conectar();
$sql = "INSERT INTO movimientosfinancieros (idCuenta, categoria,cantidad,idUsuario) VALUES (?,?,?,?)";
$stmt = $cn->getStatements($sql);
$stmt->bindParam(1,$idCuenta);
$stmt->bindParam(2,$categoria);
$stmt->bindParam(3,$cantidad);
$stmt->bindParam(4,$idUsuario);
$resultado=$cn->executeCommand($stmt);
$cn->desconectar();
return $resultado;
}
//Eliminar movimiento financiero
public function eliminarMovimientoFinanciero(MovimientosFinancieros $movimiento){
$idMovimiento = $movimiento->getIdMovimiento();
$cn = new Conexion();
$cn->conectar();
$sql = "DELETE FROM movimientosfinancieros WHERE idMovimiento = ?";
$stmt = $cn->getStatements($sql);
$stmt->bindParam(1,$idMovimiento);
$resultado=$cn->executeCommand($stmt);
$cn->desconectar();
return $resultado;
}
//Consultar movimientos financieros por usuario
public function consultarMovimientosFinancierosUsuario(Usuario $usuario){
$idUsuario= $usuario->getId();
$cn = new Conexion();
$cn->conectar();
$sql = "SELECT * FROM movimientosfinancieros WHERE idUsuario = ?";
$stmt = $cn->getStatements($sql);
$stmt->bindParam(1,$idUsuario);
$result = $cn->executeQuery($stmt);
$cn->desconectar();
if(!empty($result)){
   $movimientosUsuario = [];
    while($fila = array_shift($result)){
         $movimientosUsuario [] = new MovimientosFinancieros ( 
         $fila['idMovimiento'],
         $fila['idCuenta'],
         $fila['categoria'],
         $fila['cantidad'],
         $fila['fecha'],
         $fila['idUsuario']
         );
    }
    return $movimientosUsuario;
}else{
    return $movimientosUsuario = [];
}
}
//actualizar movimiento financiero
public function actualizarMovimientoFinanciero(MovimientosFinancieros $movimiento){
$idMovimiento = $movimiento->getIdMovimiento();
$idCuenta = $movimiento->getIdCuenta();
$categoria = $movimiento->getCategoria();
$cantidad = $movimiento->getCantidad();
$cn = new Conexion();
$cn->conectar();
$sql = "UPDATE movimientosfinancieros SET idCuenta = ?, categoria = ?, cantidad = ? WHERE idMovimiento = ?";
$stmt = $cn->getStatements($sql);
$stmt->bindParam(1,$idCuenta);  
$stmt->bindParam(2,$categoria);
$stmt->bindParam(3,$cantidad);
$stmt->bindParam(4,$idMovimiento);
$resultado=$cn->executeCommand($stmt);
$cn->desconectar();
return $resultado;
}
// validar movimiento financiero
public function validarMovimientosFinancieros(MovimientosFinancieros $movimiento){
$idMovimiento = $movimiento->getIdMovimiento();
$cn = new Conexion();
$cn->conectar();
$sql="SELECT * FROM movimientosfinancieros WHERE idMovimiento = ?";
$stmt = $cn->getStatements($sql);
$stmt->bindParam(1,$idMovimiento);
$result=$cn->validarExistencia($stmt);
$cn->desconectar();
return $result;
}
public function listarMovimientosFinancieros(){
$cn = new Conexion();
$cn->conectar();
$sql = "SELECT * FROM movimientosfinancieros";
$stmt = $cn->getStatements($sql);
$result = $cn->executeQuery($stmt);
$cn->desconectar();
if(!empty($result)){
    $movimientosFinancieros = [];
    while($fila = array_shift($result)){
        $movimientosFinancieros [] = new MovimientosFinancieros ( 
        $fila['idMovimiento'],
        $fila['idCuenta'],
        $fila['categoria'],
        $fila['cantidad'],
        $fila['fecha'],
        $fila['idUsuario']
        );
    }
    return $movimientosFinancieros;
}else{
    return $movimientosFinancieros = [];
}
}
}
?>