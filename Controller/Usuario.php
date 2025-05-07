<?php
require_once "../Model/UsuarioCRUD.php";
session_start();
class Usuario implements JsonSerializable{
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
    // crear usuario
    public function crearUsuario(Usuario $usuario){
        $crud = new UsuarioCRUD();
        $resultado=$crud->saveUsuario($usuario);
		return $resultado;
    }
    //eliminar usuario
    public function eliminarUsuario(Usuario $usuario){
        $crud = new UsuarioCRUD();
        $crud->deleteUsuario($usuario);
        session_destroy();
    }
    //actualizar usuario
    public function actualizarUsuario(Usuario $usuario){
        $crud = new UsuarioCRUD();
        $crud->updateUsuario($usuario);
        $consulta = $crud->consultUsuario($usuario);
        if(!empty($consulta) && $consulta->getId() == $usuario->getId() && $consulta->getCorreo() == $usuario->getCorreo()
            && $usuario->getPass() == $consulta->getPass() && $usuario->getNombre() == $consulta->getNombre()){
            $this->id = $consulta->getId();
            $this->nombre = $consulta->getNombre();
            $this->correo = $consulta->getCorreo();
            $this->pass = $consulta->getPass();
            $_SESSION['usuarioActual'] = json_encode($this);
        }else{
            echo ("Error al actualizar el usuario");
        }
    }
    //consultar usuario
    public function consultarUsuario(Usuario $usuario){
        $crud = new UsuarioCRUD();
        $consulta = $crud->consultUsuario($usuario);
        if(!empty($consulta)){
            $this->id = $consulta->getId();
            $this->nombre = $consulta->getNombre();
            $this->correo = $consulta->getCorreo();
            $this->pass = $consulta->getPass();
            $_SESSION['usuarioActual'] = json_encode($this);
        }
    }
    //listar usuarios
    public function listarUsuarios(){
        $crud = new UsuarioCRUD();
        $consulta=$crud->obtenerTodosLosUsuarios();
        if(!empty($consulta)){
            $_SESSION['listadoUsuarios'] = json_encode($consulta);
        }
    }

    public function jsonSerialize(){
        return get_object_vars($this);
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