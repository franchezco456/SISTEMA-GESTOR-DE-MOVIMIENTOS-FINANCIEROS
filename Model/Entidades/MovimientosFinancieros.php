<?php 
 class MovimientosFinancieros implements JsonSerializable{
    private $idMovimiento;
    private $idCuenta;
    private $categoria;
    private $cantidad;
    private $fecha;
    private $idUsuario;
//Contrusctor
    public function __construct($idMovimiento, $idCuenta, $categoria, $cantidad, $fecha, $idUsuario){
        $this->idMovimiento=$idMovimiento;
        $this->idCuenta=$idCuenta;
        $this->categoria=$categoria;
        $this->cantidad=$cantidad;
        $this->fecha=$fecha;
        $this->idUsuario=$idUsuario;
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
public function getIdUsuario(){
    return $this->idUsuario;
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
public function setIdUsuario($idUsuario){
    $this->idUsuario=$idUsuario;
}
public function jsonSerialize(){
    return [
        'idMovimiento' => $this->idMovimiento,
        'idCuenta' => $this->idCuenta,
        'categoria' => $this->categoria,
        'cantidad' => $this->cantidad,
        'fecha' => $this->fecha,
        'idUsuario' => $this->idUsuario
    ];
}
}
?>