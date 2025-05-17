<?php
require_once __DIR__ . '/../../../Model/Persistencia/Usuario/UsuarioDAO.php';
require_once __DIR__ . '/../../../Model/Entidades/Usuario.php';
session_start();
class UsuarioAuthService{
    // crear usuario
    public function crearUsuario(Usuario $usuario){
        $DAO = new UsuarioDAO();
		$validacion=$DAO->validarUsuario($usuario);
		if($validacion){
			return false;
		}else{
			$resultado=$DAO->saveUsuario($usuario);
			if($resultado){
			return $resultado;
			}else{
			return false;
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
			return true;
			}else{
			return false;
			}
		}else{
		return false;
		}
        
    }
    //actualizar usuario
    public function actualizarUsuario(Usuario $usuarioOLD, Usuario $usuarioNew){
        $DAO = new UsuarioDAO();
		$correoIgual = $usuarioNew->getCorreo() == $usuarioOLD->getCorreo();
        $idIgual = $usuarioNew->getId() == $usuarioOLD->getId();
        $validacion = false;
        if (!$correoIgual || !$idIgual) {
            $usuarioParaValidar = new Usuario(
                $idIgual ? $usuarioOLD->getId() : $usuarioNew->getId(),
                $usuarioNew->getNombre(),
                $correoIgual ? $usuarioOLD->getCorreo() : $usuarioNew->getCorreo(),
                $usuarioNew->getPass()
            );
            $validacion = $DAO->validarUsuarioActualizado($usuarioParaValidar, $usuarioOLD->getId());
        }
		if(!$validacion){
			$resultado=$DAO->updateUsuario($usuarioOLD, $usuarioNew);
			if($resultado){
            $consulta = $DAO->consultUsuario($usuarioNew);
        	if(!empty($consulta)){
            	$_SESSION['usuarioActual'] = json_encode($consulta);
				return true;
       		}else{
				return false;
			}
			}else{
            return false;
			}
		}else{
			return false;
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
			return false;
		}
    }
    //listar usuarios
    public function listarUsuarios(){
        $DAO = new UsuarioDAO();
        $consulta=$DAO->obtenerTodosLosUsuarios();
        if(!empty($consulta)){
            $_SESSION['listadoUsuarios'] = json_encode($consulta);
        }else{
			return false;
		}
    }
}
?>