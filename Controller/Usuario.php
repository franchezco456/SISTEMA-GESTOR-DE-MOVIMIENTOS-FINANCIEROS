<?php
require_once "../Model/UsuarioCRUD.php";
class Usuario extends UsuarioCRUD{
    private $id;
    private $nombre;
    private $correo;
    private $pass;
    public function __construct($id = null, $nombre=null,$correo,$pass){
        parent::__construct();
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->pass = $pass;
    }
    // crear usuario
    public function crearUsuario(Usuario $usuario){
        $this->saveUsuario($usuario);
    }
    //eliminar usuario
    public function eliminarUsuario(Usuario $usuario){
        $this->deleteUsuario($usuario);
    }
    public function actualizarUsuario(Usuario $usuario){
        $this->updateUsuario($usuario);
    }
    public function consultarUsuario(Usuario $usuario){
        return $this->consultUsuario($usuario);
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