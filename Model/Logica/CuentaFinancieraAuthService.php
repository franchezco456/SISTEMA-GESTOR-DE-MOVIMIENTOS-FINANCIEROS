<?php
require_once __DIR__ . '/../../Model/Persistencia/Cuentas_Financieras/cuentaFinancieraDAO.php';
require_once __DIR__ . '/../../Model/Entidades/CuentaFinanciera.php';
session_start();
class CuentaFinancieraAuthService{
	
	public function crearCuentaFinanciera(CuentaFinanciera $cuenta){
		$DAO = new cuentaFinancieraDAO();
		$validacion = $DAO->validarCuentaFinanciera($cuenta);
		if(!$validacion){
			$reusltado=$DAO->saveCuentaFinanciera($cuenta);
			if($resultado){
				return $resultado;
			}else{
				throw new Exception("Error al crear un a cuenta")
			}
		}else{
			throw new Exception("Cuenta ya existente")
		}
	}
	
	
	
}
?>