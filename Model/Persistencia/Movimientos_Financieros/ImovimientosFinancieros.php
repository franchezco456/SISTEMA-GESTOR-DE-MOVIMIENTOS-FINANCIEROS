<?php
interface ImovimientosFinancieros{
public function guardarMovimientoFinanciero(MovimientosFinancieros $movimiento);
public function eliminarMovimientoFinanciero(MovimientosFinancieros $movimiento);
public function consultarMovimientosFinancierosUsuario(Usuario $usuario);
public function actualizarMovimientoFinanciero(MovimientosFinancieros $movimiento);
public function validarMovimientosFinancieros(MovimientosFinancieros $movimiento);
public function listarMovimientosFinancieros();
}
?>