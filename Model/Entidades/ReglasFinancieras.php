<?php

class ReglasFinancieras{

private $idReglaFinanciera;
private $idCuenta;
private $valor_Regla;
private $fechaCreacion;
private $categoria;

//constructor
function __construct($idReglaFinanciera, $idCuenta, $valor_Regla, $fechaCreacion, $categoria){
    $this->idReglaFinanciera = $idReglaFinanciera;
    $this->idCuenta = $idCuenta;
    $this->valor_Regla = $valor_Regla;
    $this->fechaCreacion = $fechaCreacion;
    $this->categoria = $categoria;
}

//getters
public function getIdReglaFinanciera(){
    return $this->idReglaFinanciera;
    }
public function getIdCuenta(){
    return $this->idCuenta;
}
public function getValor_Regla(){
    return $this->valor_Regla;
}
public function getFechaCreacion(){
    return $this->fechaCreacion;
}
public function getCategoria(){
    return $this->categoria;
}

//setters

public function setIdReglaFinanciera($idReglaFinanciera){
    $this->idReglaFinanciera = $idReglaFinanciera;
    }
public function setIdCuenta($idCuenta){
    $this->idCuenta = $idCuenta;
    }
public function setValor_Regla($valor_Regla){
    $this->valor_Regla = $valor_Regla;
    }
public function setFechaCreacion($fechaCreacion){
    $this->fechaCreacion = $fechaCreacion;
}
public function setCategoria($categoria){
    $this->categoria = $categoria;
}

}
?>