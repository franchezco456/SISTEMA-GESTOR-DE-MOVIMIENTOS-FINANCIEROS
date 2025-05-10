<?php
class CuentaFinanciera{
 private $idCuenta;
 private $idCliente;
 private $nombre;
 private $cantidadInicial;
 private $estadoCuenta;
 private $fechaCreacion;
//contructor
	public function __construct($idCuenta, $idCliente, $nombre, $cantidadInicial, $estadoCuenta, $fechaCreacion){
	$this->idCuenta = $idCuenta;
	$this->idCliente = $idCliente;
	$this->nombre =  $nombre;
	$this->cantidadInicial = $cantidadInicial;
	$this->estadoCuenta = $estadoCuenta;
	$this->fechaCreacion = $fechaCreacion;
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
}
?>