<?php
class CuentaFinanciera implements JsonSerializable{
 private $idCuenta;
 private $idCliente;
 private $nombre;
 private $cantidadInicial;
 private $estadoCuenta;
 private $fechaCreacion;
 private $tope;
//contructor
	public function __construct($idCuenta, $idCliente, $nombre, $cantidadInicial, $estadoCuenta, $fechaCreacion, $tope){
	$this->idCuenta = $idCuenta;
	$this->idCliente = $idCliente;
	$this->nombre =  $nombre;
	$this->cantidadInicial = $cantidadInicial;
	$this->estadoCuenta = $estadoCuenta;
	$this->fechaCreacion = $fechaCreacion;
	$this->tope = $tope;
	}	 
 //getters
	public function getIdCuenta(){
		return $this->idCuenta;
	}
	public function getIdCliente(){
		return $this->idCliente;
	}
	public function getNombre(){
		return $this->nombre;
	}
	public function getCantidadInicial(){
		return $this->cantidadInicial;
	}
	public function getEstadoCuenta(){
		return $this->estadoCuenta;
	}
	public function getFechaCreacion(){
		return $this->fechaCreacion;
	}
	public function getTope(){
		return $this->tope;
	}
 //setters
	public function setIdCuenta($idCuenta){
		$this->idCuenta = $idCuenta;
	}
	public function setIdCliente($idCliente){
		$this->idCliente = $idCliente;
	}
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	public function setCantidadInicial($cantidadInicial){
		$this->cantidadInicial = $cantidadInicial;
	}
	public function setEstadoCuenta($estadoCuenta){
		$this->estadoCuenta = $estadoCuenta;
	}
	public function setFechaCreacion($fechaCreacion){
		$this->fechaCreacion = $fechaCreacion;
	}
	public function setTope($tope){
		$this->tope = $tope;
	}
	public function jsonSerialize() {
        return [
            'idCuenta' => $this->idCuenta,
            'idCliente' => $this->idCliente,
            'nombre' => $this->nombre,
            'cantidadInicial' => $this->cantidadInicial,
            'estadoCuenta' => $this->estadoCuenta,
            'fechaCreacion' => $this->fechaCreacion,
        ];
    }
}
?>