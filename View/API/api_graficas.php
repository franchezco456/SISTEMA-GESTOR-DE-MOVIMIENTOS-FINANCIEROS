<?php
header('Content-Type: application/json');

// Incluir el archivo de conexión
require_once '../../Util/Conexion.php';
require_once '../../Model/Entidades/Usuario.php';
require_once '../../Model/Persistencia/Movimientos_Financieros/movimientosFinancierosDAO.php';
try {
    session_start();
    if (isset($_SESSION['usuarioActual'])) {
        $usuario = json_decode($_SESSION['usuarioActual']);
        $user = new Usuario($usuario->id, $usuario->nombre, $usuario->correo, $usuario->pass);
        $movimientosDAO = new movimientosFinancierosDAO();
        $datos = $movimientosDAO->listarMovimientosFinancieros($user);
        // Separar los datos en dos arrays: categorías y gastos
        $categorias = [];
        $gastos = [];

        foreach ($datos as $fila) {
            if($fila['total']<0){
            $categorias[] = $fila['categoria'];
            $gastos[] = (float) $fila['total']*-1;
            }
        }

        // Retornar los datos como JSON
        echo json_encode([
            'categorias' => $categorias,
            'gastos' => $gastos
        ]);
    } else {
        throw new Exception('No se ha iniciado sesión.');
    }
} catch (Exception $e) {
    echo json_encode([
        'error' => 'Error al obtener los datos: ' . $e->getMessage()
    ]);
}
