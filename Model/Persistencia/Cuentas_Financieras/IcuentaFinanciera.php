<?php
interface IcuentaFinanciera{
	public function saveCuentaFinanciera(CuentaFinanciera $Cuenta);
	public function deleteCuentaFinanciera(CuentaFinanciera $Cuenta);
	public function consultCuentasFinanciera(CuentaFinanciera $Cuenta);
	public function validarCuentaFinanciera(CuentaFinanciera $Cuenta);
	public function updateCuentaFinanciera(CuentaFinanciera $Cuenta);
	public function listCuentasFinanciera();
}
?>