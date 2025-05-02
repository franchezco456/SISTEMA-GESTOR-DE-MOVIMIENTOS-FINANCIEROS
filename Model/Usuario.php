<?php
require_once "Conexion.php";
class Usuario extends Conexion {
    private $id;
    private $nombre;
    private $correo;
    private $pass;

//constructores
    public function __construct($id = null, $nombre = null, $correo= null ,$pass = null){
        parent::__construct();
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->pass = $pass;
    }
// crear usuario
    public function crearUsuario($nombre, $correo, $pass, $id){
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->pass = $pass;
        $this->id = $id;
        $this->conectar();
        $sql="INSERT INTO usuarios (nombre, correo, contraseña, idUsuario) VALUES (?, ?, ?, ?)";
        $stmt = $this->getStatements($sql);
        $stmt->bindParam(1, $this->nombre);
        $stmt->bindParam(2, $this->correo);
        $stmt->bindParam(3, $this->pass);
        $stmt->bindParam(4, $this->id);
        $this->executeCommand($stmt);
        echo("Usuario creado con exito");
        $this->desconectar();
    }
// eliminar usuario
    public function eliminarUsuario($id){
        $this->id = $id;
        $this->conectar();
        $sql="DELETE FROM usuarios WHERE idUsuario = ?";
        $stmt = $this->getStatements($sql);
        $stmt->bindParam(1, $this->id);
        $this->executeCommand($stmt);
        echo("Usuario eliminado con exito");
        $this->desconectar();
    }
// consultar usuario
    public function consultarUsuario($id){
        $this->id=$id;
        $this->conectar();
        $sql="SELECT * FROM usuarios WHERE idUsuario = ?";
        $stmt = $this->getStatements($sql);
        $stmt->bindParam(1, $this->id);
        $result = $this->executeQuery($stmt);
        $this->desconectar();
        return $result;
    }
// modificar usuario
    public function modificarUsuario($id, $nombre, $correo, $pass){
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->pass = $pass;
        $this->id = $id;
        $this->conectar();
        $sql="UPDATE usuarios SET nombre = ?, correo = ?, contraseña = ? WHERE idUsuario = ?";
        $stmt=$this->getStatements($sql);
        $stmt->bindParam(1, $this->nombre);
        $stmt->bindParam(2, $this->correo);
        $stmt->bindParam(3, $this->pass);
        $stmt->bindParam(4, $this->id);
        $this->executeCommand($stmt);
        echo("Usuario modificado con exito");
        $this->desconectar();
    }

//get y set
   
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