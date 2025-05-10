<?php 
public class MovimientosFinancieros{
    private idMovimiento;
    private idCuenta;
    private categoria;
    private cantidad;
    private fecha;
//Contrusctor
    public function __contructor($idMovimiento, $idCuenta, $categoria, $cantidad, $fecha){
        $this->idMovimiento=$idMovimiento;
        $this->idCuenta=$idCuenta;
        $this->categoria=$categoria;
        $this->cantidad=$cantidad;
        $this->fecha=$fecha;
    }
//GETS
public function getIdMovimiento(){
    return $this->idMovimiento;
}
public function getIdCuenta(){
    return $this->idCuenta;
}
public function getCategoria(){
    return $this->categoria;
}
public function getCantidad(){
    return $this->cantidad;
}
public function getFecha(){
    return $this->fecha;
}
//SETTERS
public function setIdMovimiento($idMovimiento){
    $this->idMovimiento=$idMovimiento;
}
public function setIdCuenta($idCuenta){
    $this->idCuenta=$idCuenta;
}
public function setCategoria($categoria){
    $this->categoria=$categoria;
}
public function setCantidad($cantidad){
    $this->cantidad=$cantidad;
}
public function setFecha($fecha){
    $this->fecha=$fecha;
}
}

$a=new MovimientoFinancieros(12,23,"Comida",3000,"10/05/2025");

?>