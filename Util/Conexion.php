<?php

class Conexion{
    private $host = "localhost";
    private $db = "sgmf";
    private $user = "root";
    private $pass = "";
    private $cn=null;
//constructores
    public function __construct($host = null, $db = null, $user = null, $pass = null) {
        if ($host !== null) {
            $this->host = $host;
            $this->db = $db;
            $this->user = $user;
            $this->pass = $pass;
        }
    }
//Conectar
    public function conectar(){
        try{
            $this->cn = new PDO(
            "mysql:host=" . $this->host . ";dbname=" . $this->db,
            $this->user, $this->pass
        );
        return $this->cn;
        } catch (PDOException $e) {
		throw new Exception ("Error al conectar con la base de datos: ".$e->getMessage());
        } 
    }
//Desconectar
    public function desconectar(){
        if ($this->cn != null) {
            try {
                $this->cn = null;
            } catch (PDOException $e) {
                throw new Exception ("Error al desconectar: ".$e->getMessage());
            }
        }
    }
// ejecutar comandos (insert, update, delete)
    public function executeCommand (PDOStatement $command) {
        try {
           return $command->execute();
        } catch (PDOException $e) {
            throw new Exception ("Error al ejecutar el comando: ".$e->getMessage());
        }
    }
// consultas (select)
    public function executeQuery (PDOStatement $query) {
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception ("Error al ejecutar la consulta: ".$e->getMessage());
        }
    }
// validacion
    public function validarExistencia(PDOStatement $query) {
    try {
        $query->execute();
        return $query->rowCount() > 0;
    } catch (PDOException $e) {
        throw new Exception("Error al validar existencia: " . $e->getMessage());
    }
}
// consultas preparadas
    public function getStatements($sql){
        try {
            $stmt = $this->cn->prepare($sql);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception ("Error al preparar la consulta: " . $e->getMessage());
        }
    }
// Get y Set
    public function getConexion(){
        return $this->cn;
    }
    public function getHost(){
        return $this->host;
    }
    public function getDb(){
        return $this->db;
    }
    public function getUser(){
        return $this->user;
    }
    public function getPass(){
        return $this->pass;
    }
    public function setHost($host){
        $this->host = $host;
    }
    public function setDb($db){
        $this->db = $db;
    }
    public function setUser($user){
        $this->user = $user;
    }
    public function setPass($pass){
        $this->pass = $pass;
    }
    public function setConexion($cn){
        $this->cn = $cn;
    }
}
?>
