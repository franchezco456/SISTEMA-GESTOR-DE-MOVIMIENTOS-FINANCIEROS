<?php
require_once "Conexion.php";
class UsuarioCRUD extends Conexion {
//constructores
    public function __construct(){
        parent::__construct();
    }
// crear usuario
    public function saveUsuario(Usuario $usuario){
        $nombre = $usuario->getNombre();
        $correo = $usuario->getCorreo();
        $pass = $usuario->getPass();
        $id = $usuario->getId();
        $this->conectar();
        $sql="INSERT INTO usuarios (nombre, correo, contraseña, idUsuario) VALUES (?, ?, ?, ?)";
        $stmt = $this->getStatements($sql);
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $correo);
        $stmt->bindParam(3, $pass);
        $stmt->bindParam(4, $id);
        $this->executeCommand($stmt);
        $this->desconectar();
    }
// eliminar usuario
    public function deleteUsuario(Usuario $usuario){
        $id = $usuario->getId();
        $this->conectar();
        $sql="DELETE FROM usuarios WHERE idUsuario = ?";
        $stmt = $this->getStatements($sql);
        $stmt->bindParam(1, $id);
        $this->executeCommand($stmt);
        echo("Usuario eliminado con exito");
        $this->desconectar();
    }
// consultar usuario
    public function consultUsuario(Usuario $usuario){
        $id = $usuario->getId();
        $this->conectar();
        $sql="SELECT * FROM usuarios WHERE idUsuario = ?";
        $stmt = $this->getStatements($sql);
        $stmt->bindParam(1, $id);
        $result = $this->executeQuery($stmt);
        $this->desconectar();
        return $result;
    }
// modificar usuario
    public function updateUsuario(Usuario $usuario){
        $id = $usuario->getId();
        $nombre = $usuario->getNombre();
        $correo = $usuario->getCorreo();
        $pass = $usuario->getPass();
        $this->conectar();
        $sql="UPDATE usuarios SET nombre = ?, correo = ?, contraseña = ? WHERE idUsuario = ?";
        $stmt=$this->getStatements($sql);
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $correo);
        $stmt->bindParam(3, $pass);
        $stmt->bindParam(4, $id);
        $this->executeCommand($stmt);
        echo("Usuario modificado con exito");
        $this->desconectar();
    }
}
?>