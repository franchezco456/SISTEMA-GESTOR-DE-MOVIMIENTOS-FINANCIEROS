<?php
interface IcuentaFinanciera{
	public function saveCuentaFinanciera(CuentaFinanciera $Cuenta);
	public function deleteCuentaFinanciera(CuentaFinanciera $Cuenta, Usuario $user);
	public function consultCuentasFinancieras(Usuario $user);
	public function validarCuentaFinanciera(CuentaFinanciera $Cuenta, Usuario $user);
	public function updateCuentaFinanciera(CuentaFinanciera $CuentaNew,CuentaFinanciera $CuentaOLD, Usuario $user);
	public function validarCuentaFinancieraActualizada(CuentaFinanciera $CuentaNew,CuentaFinanciera $CuentaOLD, Usuario $user);
	public function listCuentasFinancieras();
}
?>