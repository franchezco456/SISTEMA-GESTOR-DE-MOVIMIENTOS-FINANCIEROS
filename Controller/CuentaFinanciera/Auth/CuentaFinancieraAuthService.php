<?php
require_once __DIR__ . '/../../../Model/Persistencia/Cuentas_Financieras/cuentaFinancieraDAO.php';
require_once __DIR__ . '/../../../Model/Entidades/CuentaFinanciera.php';
require_once __DIR__ . '/../../../Model/Entidades/Usuario.php';
session_start();
class CuentaFinancieraAuthService{
//crear cuenta financiera
	public function crearCuentaFinanciera(CuentaFinanciera $cuenta, Usuario $usuario){
		$DAO = new CuentaFinancieraDAO();
		$validacion = $DAO->validarCuentaFinanciera($cuenta);
		if(!$validacion){
			$resultado=$DAO->saveCuentaFinanciera($cuenta);
			if($resultado){
			$listaCuentas=$DAO->consultCuentasFinancieras($usuario);
			if(!empty($listaCuentas)){
				$_SESSION['cuentasCurUser']=json_encode($listaCuentas);
			}else{
				return $listaCuentas = [];
			}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
//actiualizar cuenta financiera
	public function eliminarCuentaFinanciera(CuentaFinanciera $cuenta, Usuario $usuario){	
		$DAO = new CuentaFinancieraDAO();
		$validacion = $DAO->validarCuentaFinanciera($cuenta);
		if($validacion){
			$resultado = $DAO->deleteCuentaFinanciera($cuenta);
			if($resultado){
                $listaCuentas=$DAO->consultCuentasFinancieras($usuario);
			if(!empty($listaCuentas)){
				$_SESSION['cuentasCurUser']=json_encode($listaCuentas);
			}else{
				return $listaCuentas = [];
			}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
//actualizar cuenta financiera
        public function actualizarCuentaFinanciera(CuentaFinanciera $cuenta, Usuario $usuario){
			$DAO = new CuentaFinancieraDAO();
			$validacion = $DAO->validarCuentaFinanciera($cuenta);
			if(!$validacion){
				$resultado = $DAO->updateCuentaFinanciera($cuenta);
				if($resultado){
					$listaCuentas=$DAO->consultCuentasFinancieras($usuario);
					if(!empty($listaCuentas)){
						$_SESSION['cuentasCurUser']=json_encode($listaCuentas);
					}else{
						return $listaCuentas = [];
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
//consultar cuenta financiera
		 public function consultarCuentasFinancieras(Usuario $usuario){
			$DAO = new CuentaFinancieraDAO();
			$listaCuentas=$DAO->consultCuentasFinancieras($usuario);
			if(!empty($listaCuentas)){
				$_SESSION['cuentasCurUser']=json_encode($listaCuentas);
			}else{
				return $listaCuentas = [];
			}
		 }
}
?>