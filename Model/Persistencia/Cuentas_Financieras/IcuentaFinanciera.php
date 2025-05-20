<?php
interface IcuentaFinanciera{
	public function saveCuentaFinanciera(CuentaFinanciera $Cuenta);
	public function deleteCuentaFinanciera(CuentaFinanciera $Cuenta);
	public function consultCuentasFinancieras(Usuario $user);
	public function validarCuentaFinanciera(CuentaFinanciera $Cuenta);
	public function updateCuentaFinanciera(CuentaFinanciera $CuentaNew,CuentaFinanciera $CuentaOLD);
	public function validarCuentaFinancieraActualizada(CuentaFinanciera $Cuenta, $id);
	public function listCuentasFinancieras();
}
?>