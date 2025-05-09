<?php
require_once __DIR__ . '/../../../Model/Persistencia/Usuario/UsuarioDAO.php';
require_once __DIR__ . '/../../../Model/Entidades/Usuario.php';
session_start();
class UsuarioAuthDao implements JsonSerializable{
    // crear usuario
    public function crearUsuario(Usuario $usuario){
        $DAO = new UsuarioDAO();
        $resultado=$DAO->saveUsuario($usuario);
		return $resultado;
    }
    //eliminar usuario
    public function eliminarUsuario(Usuario $usuario){
        $DAO = new UsuarioDAO();
        $DAO->deleteUsuario($usuario);
        session_destroy();
    }
    //actualizar usuario
    public function actualizarUsuario(Usuario $usuario){
        $DAO = new UsuarioDAO();
        $DAO->updateUsuario($usuario);
        $consulta = $DAO->consultUsuario($usuario);
        if(!empty($consulta) && $consulta->getId() == $usuario->getId() && $consulta->getCorreo() == $usuario->getCorreo()
            && $usuario->getPass() == $consulta->getPass() && $usuario->getNombre() == $consulta->getNombre()){
            $id = $consulta->getId();
            $nombre = $consulta->getNombre();
            $correo = $consulta->getCorreo();
            $pass = $consulta->getPass();
            $User = new Usuario ($id, $nombre, $correo, $pass);
            $_SESSION['usuarioActual'] = json_encode($User);
        }else{
            echo ("Error al actualizar el usuario");
        }
    }
    //consultar usuario
    public function consultarUsuario(Usuario $usuario){
        $DAO = new UsuarioDAO();
        $consulta = $DAO->consultUsuario($usuario);
        if(!empty($consulta)){
            $id = $consulta->getId();
            $nombre = $consulta->getNombre();
            $correo = $consulta->getCorreo();
            $pass = $consulta->getPass();
            $User = new Usuario ($id, $nombre, $correo, $pass);
            $_SESSION['usuarioActual'] = json_encode($User);
        }
    }
    //listar usuarios
    public function listarUsuarios(){
        $DAO = new UsuarioDAO();
        $consulta=$DAO->obtenerTodosLosUsuarios();
        if(!empty($consulta)){
            $_SESSION['listadoUsuarios'] = json_encode($consulta);
        }
    }

    public function jsonSerialize(){
        return get_object_vars($this);
    }
 
}
?>