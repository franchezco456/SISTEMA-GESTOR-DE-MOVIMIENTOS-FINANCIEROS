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
        echo("se conecto a la bd");
        return $this->cn;
        } catch (PDOException $e) {
            die($e->getMessage());
        } 
    }
//Desconectar
    public function desconectar(){
        if ($this->cn != null) {
            try {
                $this->cn = null;
                echo("se desconecto de la bd");
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
    }
// ejecutar comandos (insert, update, delete)
    public function executeCommand (PDOStatement $command) {
        try {
           return $command->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
// consultas (select)
    public function executeQuery (PDOStatement $query) {
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
// validacion
    public function validarExistencia(PDOStatement $query) {
    try {
        $query->execute();
        return $query->rowCount() > 0;
    } catch (PDOException $e) {
        die("Error al validar existencia: " . $e->getMessage());
    }
}
// consultas preparadas
    public function getStatements($sql){
        try {
            $stmt = $this->cn->prepare($sql);
            return $stmt;
        } catch (PDOException $e) {
            die("Error al preparar la consulta: " . $e->getMessage());
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
