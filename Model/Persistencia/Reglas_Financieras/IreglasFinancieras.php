<?php
interface IreglasFinancieras{
    public function guardarReglasFinancieras (ReglasFinancieras $regla);
    public function eliminarReglasFinancieras (ReglasFinancieras $regla);
    public function consultarReglasFinancieras (ReglasFinancieras $regla);
    public function validarReglasFinancieras (ReglasFinancieras $regla);
    public function actualizarReglasFinancieras (ReglasFinancieras $regla);
    public function listarReglasFinancieras ();
}
?>