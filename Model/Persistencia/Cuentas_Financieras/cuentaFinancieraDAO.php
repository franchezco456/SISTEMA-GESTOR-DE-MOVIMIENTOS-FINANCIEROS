<?php
require_once "IcuentaFinanciera.php";
require_once __DIR__ . '/../../../Model/Entidades/CuentaFinanciera.php';
require_once __DIR__ . '/../../../Model/Entidades/Usuario.php';
require_once dirname(__DIR__, 3) . '/Util/Conexion.php';
class CuentaFinancieraDAO implements IcuentaFinanciera{
//Crear cuenta financiera
	public function saveCuentaFinanciera(CuentaFinanciera $Cuenta){
		$idCliente = $Cuenta->getIdCliente();
		$nombre = $Cuenta->getNombre();
		$cantidadInicial = $Cuenta->getCantidadInicial();
		$estadoCuenta = $Cuenta->getEstadoCuenta();
		$tope = $Cuenta->getTope();
		$cn = new Conexion();
		$cn->conectar();
		$sql = "INSERT INTO cuentafinanciera (idCliente, nombre, cantidadInicial, estadoCuenta, tope) VALUES(?,?,?,?,?)";
		$stmt = $cn->getStatements($sql);
		$stmt->bindParam(1,$idCliente);
		$stmt->bindParam(2,$nombre);
		$stmt->bindParam(3,$cantidadInicial);
		$stmt->bindParam(4,$estadoCuenta);
		$stmt->bindParam(5,$tope);
		$result = $cn->executeCommand($stmt);
		$cn->desconectar();
		return $result;
	}
//eliminar cuenta financiera
	public function deleteCuentaFinanciera(CuentaFinanciera $Cuenta){
		$nombre = $Cuenta->getNombre();
		$cn = new Conexion();
		$cn->conectar();
		$sql = "DELETE FROM cuentafinanciera WHERE nombre = ?";
		$stmt = $cn->getStatements($sql);
		$stmt->bindParam(1,$nombre);
		$result = $cn->executeCommand($stmt);
		$cn->desconectar();
		return $result;
	}
//consultar cuenta financieras
	public function consultCuentasFinancieras(Usuario $user){
		$idCliente = $user->getId();
		$cn = new Conexion();
		$cn->conectar();
		$sql = "SELECT * FROM cuentafinanciera WHERE idCliente = ?";
		$stmt = $cn->getStatements($sql);
		$stmt -> bindParam(1,$idCliente);
		$result = $cn->executeQuery($stmt);
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
				$fila['tope']
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
	public function validarCuentaFinancieraActualizada(CuentaFinanciera $Cuenta, $id){
		$nombre = $Cuenta->getNombre();
		$cn = new Conexion();
		$cn->conectar();
		$sql="SELECT * FROM cuentafinanciera WHERE nombre = ? and idCliente= ?";
		$stmt = $cn->getStatements($sql);
		$stmt->bindParam(1,$nombre);
		$stmt->bindParam(2,$id);
		$result=$cn->validarExistencia($stmt);
		$cn->desconectar();
		return $result;
	}
//actualizar cuenta financiera
	public function updateCuentaFinanciera(CuentaFinanciera $CuentaNew, CuentaFinanciera $CuentaOLD){
		$NuevoNombre = $CuentaNew->getNombre();
		$NuevaCantidadInicial = $CuentaNew->getCantidadInicial();
		$NuevoTope = $CuentaNew->getTope();
		$NombreOLD = $CuentaOLD->getNombre();
		$cn = new Conexion();
		$cn->conectar();
		$sql = "UPDATE cuentafinanciera SET nombre = ?, cantidadInicial = ?, tope = ? WHERE nombre = ?";
		$stmt = $cn->getStatements($sql);
		$stmt->bindParam(1,$NuevoNombre);
		$stmt->bindParam(2,$NuevaCantidadInicial);
		$stmt->bindParam(3,$NuevoTope);
		$stmt->bindParam(4,$NombreOLD);
		$result = $cn->executeCommand($stmt);
		$cn->desconectar();
		return $result;
	}
//listar todas las cuentas 
	public function listCuentasFinancieras(){
		$cn = new Conexion();
		$cn->conectar();
		$sql = "SELECT * FROM cuentafinanciera";
		$stmt = $cn->getStatements($sql);
		$result = $cn->executeQuery($stmt);
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
				$fila['tope']
				);
			}
			return $allCuentas;
		}else{
		return null;	
		}
	}
}
?>