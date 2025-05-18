<?php
class CuentaFinancieraModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Función para guardar cuentas en la base de datos
    public function guardarCuentas($cuentas) {
        foreach ($cuentas as $cuenta) {
            $usuario = $cuenta['usuario'];
            $saldo = $cuenta['saldo'];
            $tope = $cuenta['tope'];

            $sql = "INSERT INTO cuentas(usuario, saldo, tope) VALUES ('$usuario', '$saldo', '$tope')";
            if ($this->conn->query($sql) !== TRUE) {
                return false; // Si hay algún error, devuelve false
            }
        }
        return true; // Si todo fue bien, devuelve true
    }

    // Función para obtener todas las cuentas desde la base de datos
    public function obtenerCuentas() {
        $sql = "SELECT * FROM cuentas";
        $result = $this->conn->query($sql);
        
        $cuentas = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cuentas[] = $row;
            }
        }
        return $cuentas;
    }
}
?>
