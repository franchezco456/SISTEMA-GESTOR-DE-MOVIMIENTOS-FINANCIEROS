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
        $this->desconectar();
    }
// consultar usuario
    public function consultUsuario(Usuario $usuario){
        $correo = $usuario->getCorreo();
        $pass = $usuario->getPass();
        $this->conectar();
        $sql="SELECT * FROM usuarios WHERE Correo = ? AND Contraseña = ?";
        $stmt = $this->getStatements($sql);
        $stmt->bindParam(1, $correo);
        $stmt->bindParam(2, $pass);
        $result = $this->executeQuery($stmt);
        $this->desconectar();
        if(!empty($result)){
            $user = new Usuario($result[0]['idUsuario'], $result[0]['Nombre'], $result[0]['Correo'], $result[0]['Contraseña']);
            return $user;
        }else{
            return null;
        }
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
        $this->desconectar();
    }

    public function obtenerTodosLosUsuarios(){
        $this-> conectar();
        $sql = "SELECT * FROM usuarios";
        $stmt = $this ->getStatements($sql);
        $result = $this->executeQuery($stmt);
        $this->desconectar();
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