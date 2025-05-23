<?php
header('Content-Type: application/json');

// Incluir el archivo de conexión
require_once '../../Util/Conexion.php';

try {
    // Crear instancia de la clase Conexion y conectar a la base de datos
    $db = new Conexion();
    $conn = $db->conectar();

    // Consulta para obtener la suma de gastos agrupados por categoría
    $sql = "SELECT categoria, SUM(cantidad) AS total
            FROM movimientosfinancieros
            GROUP BY categoria";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Separar los datos en dos arrays: categorías y gastos
    $categorias = [];
    $gastos = [];

    foreach ($resultados as $fila) {
        $categorias[] = $fila['categoria'];
        $gastos[] = (float) $fila['total'];
    }

    // Retornar los datos como JSON
    echo json_encode([
        'categorias' => $categorias,
        'gastos' => $gastos
    ]);
} catch (Exception $e) {
    echo json_encode([
        'error' => 'Error al obtener los datos: ' . $e->getMessage()
    ]);
}
