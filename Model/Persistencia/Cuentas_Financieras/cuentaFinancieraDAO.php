<?php
require_once "IcuentaFinanciera.php";
require_once __DIR__ . '/../../../Model/Entidades/CuentaFinanciera.php';
require_once "../../Util/Conexion.php";
class CuentaFinancieraDAO implements IcuentaFinanciera{
//Crear cuenta financiera
	public function saveCuentaFinanciera(CuentaFinanciera $Cuenta){
		$idCliente = $Cuenta->getIdCliente();
		$nombre = $Cuenta->getNombre();
		$cantidadInicial = $Cuenta->getCantidadInicial();
		$estadoCuenta = $Cuenta->getEstadoCuenta();
		$cn = new Conexion();
		$cn->conectar();
		$sql = "INSERT INTO cuentafinanciera (idCliente, nombre, cantidadInicial, estadoCuenta) VALUES(?,?,?,?)";
		$stmt = $cn->getStatements($sql);
		$stmt->bindParam(1,$idCliente);
		$stmt->bindParam(2,$nombre);
		$stmt->bindParam(3,$cantidadInicial);
		$stmt->bindParam(4,$estadoCuenta);
		$result = $cn->executeCommand($stmt);
		$cn->desconectar();
		return $result;
	}
//eliminar cuenta financiera
	public function deleteCuentaFinanciera(CuentaFinanciera $Cuenta){
		$idCuenta = $Cuenta->getIdCuenta();
		$cn = new Conexion();
		$cn->conectar();
		$sql = "DELETE FROM cuentafinanciera WHERE idCuenta = ?";
		$stmt = $cn->getStatements($sql);
		$stmt->bindParam(1,$idCuenta);
		$result = $cn->executeCommand($stmt);
		$cn->desconectar();
		return $result;
	}
//consultar cuenta financieras
	public function consultCuentasFinanciera(CuentaFinanciera $Cuenta){
		$idCliente = $Cuenta->getIdCliente();
		$cn = new Conexion();
		$cn->conectar();
		$sql = "SELECT * FROM cuentafinanciera WHERE idCliente = ?";
		$stmt = $cn->getStatements($sql);
		$stmt -> bindParam(1,$idCliente);
		$result = $cn->executeCommand($stmt);
		$cn->desconectar();
		if(!empty($result)){
			$cuentasUsuario = [];
			while($fila = array_shift($result)){
				$cuentasUsuario [] = new CuentaFinanciera ( 
				$fila['idCuenta'],
				$fila['idCliente'],
				$fila['nombre'],
				$fila['cantidadInicial'],
				$fila['estadoCuenta'],
				$fila['fechaCreacion'],
				);
			}
			return $cuentasUsuario;
		}else{
		return null;	
		}
	}
//validar cuenta financiera
	public function validarCuentaFinanciera(CuentaFinanciera $Cuenta){
		$nombre = $Cuenta->getNombre();
		$cn = new Conexion();
		$cn->conectar();
		$sql="SELECT * FROM cuentafinanciera WHERE nombre = ?";
		$stmt = $cn->getStatements($sql);
		$stmt->bindParam(1,$nombre);
		$result=$cn->validarExistencia($stmt);
		$cn->desconectar();
		return $result;
	}
//actualizar cuenta financiera
	public function updateCuentaFinanciera(CuentaFinanciera $Cuenta){
		$nombre = $Cuenta->getNombre();
		$cantidadInicial = $Cuenta->getCantidadInicial();
		$idCuenta = $Cuenta->getIdCuenta();
		$cn = new Conexion();
		$cn->conectar();
		$sql = "UPDATE cuentafinanciera SET nombre = ?, cantidadInicial = ? WHERE idCuenta = ?";
		$stmt = $cn->getStatements($sql);
		$stmt->bindParam(1,$nombre);
		$stmt->bindParam(2,$cantidadInicial);
		$stmt->bindParam(3,$idCuenta);
		$result = $cn->executeCommand($stmt);
		$cn->desconectar();
		return $result;
	}
//listar todas las cuentas 
	public function listCuentasFinanciera(){
		$cn = new Conexion();
		$cn->conectar();
		$sql = "SELECT * FROM cuentafinanciera";
		$stmt = $cn->getStatements($sql);
		$result = $cn->executeCommand($stmt);
		$cn->desconectar();
		if(!empty($result)){
			$allCuentas = [];
			while($fila = array_shift($result)){
				$allCuentas [] = new CuentaFinanciera ( 
				$fila['idCuenta'],
				$fila['idCliente'],
				$fila['nombre'],
				$fila['cantidadInicial'],
				$fila['estadoCuenta'],
				$fila['fechaCreacion'],
				);
			}
			return $allCuentas;
		}else{
		return null;	
		}
	}
}
?>