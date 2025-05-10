<?php
require_once "IcuentaFinanciera.php";
require_once __DIR__ . '/../../../Model/Entidades/CuentaFinanciera.php'
require_once "../../Util/Conexion.php";
class CuentaFinancieraDAO implements IcuentaFinanciera{
//Crear cuenta financiera
	public function saveCuentaFinanciera(CuentaFinanciera $Cuenta){
		$idCuenta = $Cuenta->getIdCuenta();
		$idCliente = $Cuenta->getIdCliente();
		$nombre = $Cuenta->getNombre();
		$cantidadInicial = $Cuenta->getCantidadInicial();
		$estadoCuenta = $Cuenta->getEstadoCuenta();
		$cn = new Conexion();
		$cn->conectar();
		$sql = "INSERT INTO cuentafinanciera (idCuenta, idCliente, nombre, cantidadInicial, estadoCuenta) VALUES(?,?,?,?,?)";
		$stmt = $cn->getStatements($sql);
		$stmt->bindParam(1,$idCuenta);
		$stmt->bindParam(2,$idCliente);
		$stmt->bindParam(3,$nombre);
		$stmt->bindParam(4,$cantidadInicial);
		$stmt->bindParam(5,$estadoCuenta);
		$result = $cn->executeCommand($stmt);
		$cn->desconectar();
		return $result;
	}
//eliminar cuenta financiera
	public function deleteCuentaFinanciera(CuentaFinanciera $Cuenta){
		$idCuenta = $cuenta->getIdCuenta();
		$cn = new Conexion();
		$cn->conectar();
		$sql = "DELETE FROM cuentafinanciera WHERE idCuenta = ?"
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
		//terminar
	}
//validar cuenta financiera
	public function validarCuentaFinanciera(CuentaFinanciera $Cuenta){
		
	}
//actualizar cuenta financiera
	public function updateCuentaFinanciera(CuentaFinanciera $Cuenta){
		
	}
//listar todas las cuentas 
	public function listCuentasFinanciera(){
		
	}
}
?>