<?php
interface ImovimientosFinancieros{
public function guardarMovimientoFinanciero(MovimientosFinancieros $movimiento);
public function eliminarMovimientoFinanciero(MovimientosFinancieros $movimiento);
public function consultarMovimientosFinancieros(MovimientosFinancieros $movimiento);
public function actualizarMovimientoFinanciero(MovimientosFinancieros $movimiento);
public function validarMovimientosFinancieros(MovimientosFinancieros $movimiento);
public function listarMovimientosFinancieros(MovimientosFinancieros $movimiento);

}
?>