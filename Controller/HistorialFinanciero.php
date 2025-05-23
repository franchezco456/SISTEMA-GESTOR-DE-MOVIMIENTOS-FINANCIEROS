<?php
require_once 'Conexion.php';
header('Content-Type: application/json');

$conexion = new Conexion();
$cn = $conexion->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Devuelve todos los movimientos
    $sql = "SELECT idMovimiento, categoria, cantidad, fecha, idCuenta FROM movimientos ORDER BY idMovimiento ASC";
    $stmt = $cn->prepare($sql);
    $stmt->execute();
    $movimientos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($movimientos);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    if ($accion === 'modificar') {
        $id = $_POST['id'] ?? null;
        $categoria = $_POST['categoria'] ?? null;
        $cantidad = $_POST['cantidad'] ?? null;

        if ($id && $categoria && $cantidad) {
            $sql = "UPDATE movimientos SET categoria = :categoria, cantidad = :cantidad WHERE idMovimiento = :id";
            $stmt = $cn->prepare($sql);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':id', $id);

            if ($conexion->executeCommand($stmt)) {
                echo json_encode(['success' => true, 'mensaje' => 'Movimiento actualizado']);
            } else {
                echo json_encode(['success' => false, 'mensaje' => 'Error al actualizar']);
            }
        } else {
            echo json_encode(['success' => false, 'mensaje' => 'Faltan datos para modificar']);
        }
    } elseif ($accion === 'eliminar') {
        $id = $_POST['id'] ?? null;

        if ($id) {
            $sql = "DELETE FROM movimientos WHERE idMovimiento = :id";
            $stmt = $cn->prepare($sql);
            $stmt->bindParam(':id', $id);

            if ($conexion->executeCommand($stmt)) {
                echo json_encode(['success' => true, 'mensaje' => 'Movimiento eliminado']);
            } else {
                echo json_encode(['success' => false, 'mensaje' => 'Error al eliminar']);
            }
        } else {
            echo json_encode(['success' => false, 'mensaje' => 'Falta ID para eliminar']);
        }
    } else {
        echo json_encode(['success' => false, 'mensaje' => 'Acción inválida']);
    }
} else {
    echo json_encode(['success' => false, 'mensaje' => 'Método no permitido']);
}
?>
