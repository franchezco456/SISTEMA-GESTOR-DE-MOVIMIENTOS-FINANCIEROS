<?php
require_once "../../Util/Conexion.php";
require_once "Iusuario.php";
class UsuarioDAO implements Iusuario {
// crear usuario
    public function saveUsuario(Usuario $usuario){
        $nombre = $usuario->getNombre();
        $correo = $usuario->getCorreo();
        $pass = $usuario->getPass();
        $id = $usuario->getId();
        $cn = new Conexion();
        $cn->conectar();
        $sql="INSERT INTO usuarios (nombre, correo, contraseña, idUsuario) VALUES (?, ?, ?, ?)";
        $stmt = $cn->getStatements($sql);
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $correo);
        $stmt->bindParam(3, $pass);
        $stmt->bindParam(4, $id);
        $result=$cn->executeCommand($stmt);                   
        $cn->desconectar();
		return $result;
    }
// eliminar usuario
    public function deleteUsuario(Usuario $usuario){
        $id = $usuario->getId();
        $cn = new Conexion();
        $cn->conectar();
        $sql="DELETE FROM usuarios WHERE idUsuario = ?";
        $stmt = $cn->getStatements($sql);
        $stmt->bindParam(1, $id);
        $result=$cn->executeCommand($stmt);
        $cn->desconectar();
		return $result;
    }
// consultar usuario
    public function consultUsuario(Usuario $usuario){
        $correo = $usuario->getCorreo();
        $pass = $usuario->getPass();
        $cn = new Conexion();
        $cn->conectar();
        $sql="SELECT * FROM usuarios WHERE Correo = ? AND Contraseña = ?";
        $stmt = $cn->getStatements($sql);
        $stmt->bindParam(1, $correo);
        $stmt->bindParam(2, $pass);
        $result = $cn->executeQuery($stmt);
        $cn->desconectar();
        if(!empty($result)){
            $user = new Usuario($result[0]['idUsuario'], $result[0]['Nombre'], $result[0]['Correo'], $result[0]['Contraseña']);
            return $user;
        }else{
            return null;
        }
    }
//validar usuario
	public function validarUsuario(Usuario $usuario){
		$correo = $usuario->getCorreo();
		$id = $usuario->getId();
		$cn = new Conexion();
        $cn->conectar();
        $sql="SELECT * FROM usuarios WHERE Correo = ? OR idUsuario = ?";
        $stmt = $cn->getStatements($sql);
        $stmt->bindParam(1, $correo);
		$stmt->bindParam(2, $id);
        $result = $cn->validarExistencia($stmt);
        $cn->desconectar();
		return $result;
	}
// modificar usuario
    public function updateUsuario(Usuario $usuario){
        $id = $usuario->getId();
        $nombre = $usuario->getNombre();
        $correo = $usuario->getCorreo();
        $pass = $usuario->getPass();
        $cn = new Conexion();
        $cn->conectar();
        $sql="UPDATE usuarios SET nombre = ?, correo = ?, contraseña = ? WHERE idUsuario = ?";
        $stmt=$cn->getStatements($sql);
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $correo);
        $stmt->bindParam(3, $pass);
        $stmt->bindParam(4, $id);
        $result=$cn->executeCommand($stmt);
        $cn->desconectar();
		return $result;
    }

    public function obtenerTodosLosUsuarios(){
        $cn = new Conexion();
        $cn-> conectar();
        $sql = "SELECT * FROM usuarios";
        $stmt = $cn ->getStatements($sql);
        $result = $cn->executeQuery($stmt);
        $cn->desconectar();
        if(!empty($result)){
            $usuarios = [];
            while ($fila = array_shift($result)) { // Extrae y elimina el primer elemento del array
                $usuarios[] = new Usuario(
                    $fila['idUsuario'],
                    $fila['Nombre'],
                    $fila['Correo'],
                    $fila['Contraseña']
                );
            }
            return $usuarios;
        }else{
            return null;
        }
    }
}
?>