<?php
// Configuración de la base de datos
$host = 'localhost';
$user = 'root'; // Usuario de MySQL
$password = 'root'; // Contraseña de MySQL
$dbname = 'finanzas'; // Nombre de la base de datos

// Crear conexión con la base de datos
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar el método de la solicitud
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        // Obtener todas las cuentas de la base de datos
        obtenerCuentas($conn);
        break;

    case 'POST':
        // Crear una nueva cuenta en la base de datos
        crearCuenta($conn);
        break;

    case 'DELETE':
        // Eliminar una cuenta de la base de datos
        eliminarCuenta($conn);
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Método no soportado']);
        break;
}

// Función para obtener las cuentas desde la base de datos
function obtenerCuentas($conn) {
    $sql = "SELECT * FROM cuentas";  // Consulta para obtener todas las cuentas
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $cuentas = [];
        while ($row = $result->fetch_assoc()) {
            $cuentas[] = [
                'usuario' => $row['usuario'],
                'saldo' => $row['saldo'],
                'tope' => $row['tope']
            ];
        }
        echo json_encode($cuentas);  // Devuelve las cuentas en formato JSON
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No hay cuentas registradas']);
    }
}

// Función para crear una nueva cuenta en la base de datos
function crearCuenta($conn) {
    $data = json_decode(file_get_contents('php://input'), true);  // Obtener datos del cuerpo de la solicitud

    if (isset($data[0]['usuario']) && isset($data[0]['saldo']) && isset($data[0]['tope'])) {
        $usuario = $data[0]['usuario'];
        $saldo = $data[0]['saldo'];
        $tope = $data[0]['tope'];

        // Prevenir inyecciones SQL
        $stmt = $conn->prepare("INSERT INTO cuentas (usuario, saldo, tope) VALUES (?, ?, ?)");
        $stmt->bind_param("sdd", $usuario, $saldo, $tope);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Cuenta creada correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al crear la cuenta']);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan parámetros para crear la cuenta']);
    }
}

// Función para eliminar una cuenta de la base de datos
function eliminarCuenta($conn) {
    $data = json_decode(file_get_contents('php://input'), true);  // Obtener datos del cuerpo de la solicitud

    if (isset($data['usuario'])) {
        $usuario = $data['usuario'];

        // Prevenir inyecciones SQL
        $stmt = $conn->prepare("DELETE FROM cuentas WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Cuenta eliminada correctamente']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No se encontró la cuenta para eliminar']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al eliminar la cuenta']);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Falta el identificador de la cuenta']);
    }
}

// Cerrar la conexión
$conn->close();
?>
