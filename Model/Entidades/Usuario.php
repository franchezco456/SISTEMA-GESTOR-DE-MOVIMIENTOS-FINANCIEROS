<?php
class Usuario {
    private $id;
    private $nombre;
    private $correo;
    private $pass;

    public function __construct($id, $nombre, $correo,$pass){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->pass = $pass;
    }
       public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getCorreo(){
        return $this->correo;
    }
    public function getPass(){
        return $this->pass;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setCorreo($correo){
        $this->correo = $correo;
    }
    public function setPass($pass){
        $this->pass = $pass;
    }
}
?>