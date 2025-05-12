<?php
require_once __DIR__ . '/../../Model/Persistencia/Cuentas_Financieras/cuentaFinancieraDAO.php';
require_once __DIR__ . '/../../Model/Entidades/CuentaFinanciera.php';
require_once __DIR__ . '/../../Model/Entidades/Usuario.php';
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
				throw new Exception("Error al crear un a cuenta");
			}
		}else{
			throw new Exception("Cuenta ya existente");
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
				throw new Exception("Error al eliminar la cuenta");
			}
		}else{
			throw new Exception("La cuenta no existe");
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
					throw new Exception ("Error al actualizar la cuenta");
				}
			}else{
				throw new Exception ("nombre de cuenta ya existente");
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