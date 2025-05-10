<?php
require_once __DIR__ . '/../../Model/Persistencia/Usuario/UsuarioDAO.php';
require_once __DIR__ . '/../../Model/Entidades/Usuario.php';
session_start();
class UsuarioAuthService implements JsonSerializable{
    // crear usuario
    public function crearUsuario(Usuario $usuario){
        $DAO = new UsuarioDAO();
		$validacion=$DAO->validarUsuario($usuario);
		if($validacion){
			throw new Exception ("Usuario ya existente");
		}else{
			$resultado=$DAO->saveUsuario($usuario);
			if($resultado){
			return $resultado;
			}else{
			throw new Exception ("Error al crear el usuario");
			}
		}
    }
    //eliminar usuario
    public function eliminarUsuario(Usuario $usuario){
        $DAO = new UsuarioDAO();
		$validacion=$DAO->validarUsuario($usuario);
		if($validacion){
			$resultado=$DAO->deleteUsuario($usuario);
			if($resultado){
			session_destroy();
			}else{
			throw new Exception ("Error al eliminar el usuario");
			}
		}else{
		throw new Exception ("El usuario no existe");
		}
        
    }
    //actualizar usuario
    public function actualizarUsuario(Usuario $usuario){
        $DAO = new UsuarioDAO();
		$validacion=$DAO->validarUsuario($usuario);
		if($validacion){
			$resultado=$DAO->updateUsuario($usuario);
			if($resultado){
            $_SESSION['usuarioActual'] = json_encode($usuario);
			}else{
            throw new Exception("Error al actualizar el usuario");
			}
		}else{
			throw new Exception("El usuario no existe");
		}
    }
    //consultar usuario
    public function consultarUsuario(Usuario $usuario){
        $DAO = new UsuarioDAO();
        $consulta = $DAO->consultUsuario($usuario);
        if(!empty($consulta)){
			$usuario->setNombre($consulta->getNombre());
			$usuario->setId($consulta->getId());
            $_SESSION['usuarioActual'] = json_encode($usuario);
        }else{
			return null;
		}
    }
    //listar usuarios
    public function listarUsuarios(){
        $DAO = new UsuarioDAO();
        $consulta=$DAO->obtenerTodosLosUsuarios();
        if(!empty($consulta)){
            $_SESSION['listadoUsuarios'] = json_encode($consulta);
        }else{
			throw new Exception("Error listar los usuarios");
		}
    }

    public function jsonSerialize(){
        return get_object_vars($this);
    }
 
}
?>