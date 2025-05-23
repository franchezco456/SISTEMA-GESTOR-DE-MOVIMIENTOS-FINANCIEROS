<?php
class GraficaModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerGastosPorCategoria($idUsuario = null) {
        $sql = "SELECT categoria, SUM(cantidad) as total 
                FROM movimientosfinancieros ";

        if ($idUsuario !== null) {
            $sql .= "WHERE idUsuario = :idUsuario ";
        }

        $sql .= "GROUP BY categoria";

        $stmt = $this->conn->prepare($sql);

        if ($idUsuario !== null) {
            $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
