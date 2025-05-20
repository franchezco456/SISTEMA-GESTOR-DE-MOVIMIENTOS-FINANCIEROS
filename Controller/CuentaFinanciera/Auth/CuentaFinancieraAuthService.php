<?php
require_once __DIR__ . '/../../../Model/Persistencia/Cuentas_Financieras/cuentaFinancieraDAO.php';
require_once __DIR__ . '/../../../Model/Entidades/CuentaFinanciera.php';
require_once __DIR__ . '/../../../Model/Entidades/Usuario.php';
session_start();
class CuentaFinancieraAuthService{
//crear cuenta financiera
	public function crearCuentaFinanciera(CuentaFinanciera $cuenta,){
		$DAO = new CuentaFinancieraDAO();
		$validacion = $DAO->validarCuentaFinanciera($cuenta);
		if(!$validacion){
			$resultado=$DAO->saveCuentaFinanciera($cuenta);
			if($resultado){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function validarCuentaFinanciera(CuentaFinanciera $cuenta){
		$DAO = new CuentaFinancieraDAO();
		$validacion = $DAO->validarCuentaFinanciera($cuenta);
		if($validacion){
			return true;
		}else{
			return false;
		}
	}
//actiualizar cuenta financiera
	public function eliminarCuentaFinanciera(CuentaFinanciera $cuenta){	
		$DAO = new CuentaFinancieraDAO();
		$validacion = $DAO->validarCuentaFinanciera($cuenta);
		if($validacion){
			$resultado = $DAO->deleteCuentaFinanciera($cuenta);
			if($resultado){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
//actualizar cuenta financiera
        public function actualizarCuentaFinanciera(CuentaFinanciera $cuentaNew, CuentaFinanciera $cuentaOLD, $id){
			$DAO = new CuentaFinancieraDAO();
			$validacion = $DAO->validarCuentaFinancieraActualizada($cuentaNew, $id);
			if(!$validacion){
				$resultado = $DAO->updateCuentaFinanciera($cuentaNew, $cuentaOLD);
				if($resultado){
					return true;
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
				return true;
			}else{
				return false;
			}
		 }
}
?>