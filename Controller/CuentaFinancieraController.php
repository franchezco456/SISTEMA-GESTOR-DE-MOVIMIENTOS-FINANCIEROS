<?php
// Configuración de la base de datos
$host = 'localhost';  // Dirección del servidor de base de datos
$user = 'root';  // Usuario de MySQL
$password = 'root';  // Contraseña de MySQL
$dbname = 'finanzas';  // Nombre de la base de datos a la que se va a conectar

// Crear conexión con la base de datos
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);  // Si falla la conexión, muestra un mensaje de error y detiene la ejecución
}

// Incluir el modelo para la validación de las cuentas
require_once '../Model/CuentaFinancieraModel.php';  // Importa el archivo donde está la clase que valida las cuentas
$model = new CuentaFinancieraModel($conn);  // Instancia el modelo para que pueda ser utilizado

// Verificar el método de la solicitud (GET, POST, PUT, DELETE)
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        obtenerCuentas($conn);  // Si es un GET, se obtienen todas las cuentas
        break;

    case 'POST':
        crearCuenta($conn, $model);  // Si es un POST, se crea una nueva cuenta
        break;

    case 'PUT':
        modificarCuenta($conn);  // Si es un PUT, se modifica una cuenta existente
        break;

    case 'DELETE':
        eliminarCuenta($conn);  // Si es un DELETE, se elimina una cuenta
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Método no soportado']);  // Si el método no es soportado, se devuelve un error
        break;
}

// Función para obtener todas las cuentas desde la base de datos
function obtenerCuentas($conn)
{
    $sql = "SELECT * FROM cuentas";  // Consulta SQL para seleccionar todas las cuentas
    $result = $conn->query($sql);  // Ejecuta la consulta

    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        $cuentas = [];
        while ($row = $result->fetch_assoc()) {
            $cuentas[] = [  // Almacena cada cuenta en un arreglo
                'usuario' => $row['usuario'],
                'saldo' => $row['saldo'],
                'tope' => $row['tope']
            ];
        }
        echo json_encode($cuentas);  // Devuelve las cuentas en formato JSON
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No hay cuentas registradas']);  // Si no hay cuentas, se devuelve un mensaje de error
    }
}

// Función para crear una nueva cuenta en la base de datos
function crearCuenta($conn, $model)
{
    // Obtener los datos de la solicitud en formato JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar si se recibieron todos los parámetros necesarios
    if (isset($data[0]['usuario']) && isset($data[0]['saldo']) && isset($data[0]['tope'])) {
        $usuario = $data[0]['usuario'];
        $saldo = $data[0]['saldo'];
        $tope = $data[0]['tope'];

        // Verificamos si ya existe una cuenta con el mismo nombre de usuario
        if ($model->cuentaExiste($usuario)) {
            echo json_encode(['status' => 'error', 'message' => 'La cuenta esta duplicada']);  // Si ya existe, devolver error
            return;
        }

        // Prevenir inyecciones SQL y realizar la inserción
        $stmt = $conn->prepare("INSERT INTO cuentas (usuario, saldo, tope) VALUES (?, ?, ?)");
        $stmt->bind_param("sdd", $usuario, $saldo, $tope);  // Vincula los parámetros de la consulta

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Cuenta creada correctamente']);  // Si la cuenta se crea correctamente, devolver éxito
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al crear la cuenta']);  // Si hubo un error, devolver mensaje de error
        }

        $stmt->close();  // Cerrar el statement después de ejecutar
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan parámetros para crear la cuenta']);  // Si faltan parámetros, devolver error
    }
}

// Función para eliminar una cuenta de la base de datos
function eliminarCuenta($conn)
{
    // Obtener los datos de la solicitud en formato JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar si se pasó el identificador de la cuenta (usuario)
    if (isset($data['usuario'])) {
        $usuario = $data['usuario'];

        // Prevenir inyecciones SQL utilizando un prepared statement
        $stmt = $conn->prepare("DELETE FROM cuentas WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);  // Vincula el parámetro de la consulta

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Verificar si se eliminó alguna fila
            if ($stmt->affected_rows > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Cuenta eliminada correctamente']);  // Si se eliminó, devolver éxito
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No se encontró la cuenta para eliminar']);  // Si no se encontró la cuenta, devolver error
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al eliminar la cuenta']);  // Si hubo un error, devolver mensaje de error
        }

        $stmt->close();  // Cerrar el statement después de ejecutar
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Falta el identificador de la cuenta']);  // Si falta el identificador, devolver error
    }
}

// Función para modificar una cuenta de la base de datos
function modificarCuenta($conn)
{
    // Obtener los datos de la solicitud en formato JSON
    $data = json_decode(file_get_contents("php://input"), true);

    // Verificar si se pasaron todos los parámetros necesarios
    if (
        isset($data['usuarioAntiguo']) &&
        isset($data['nuevoUsuario']) &&
        isset($data['nuevoSaldo']) &&
        isset($data['nuevoTope'])
    ) {
        // Preparar la consulta para actualizar los datos de la cuenta
        $stmt = $conn->prepare("UPDATE cuentas SET usuario = ?, saldo = ?, tope = ? WHERE usuario = ?");
        $stmt->bind_param("sdds", $data['nuevoUsuario'], $data['nuevoSaldo'], $data['nuevoTope'], $data['usuarioAntiguo']);  // Vincula los parámetros de la consulta

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Cuenta actualizada correctamente']);  // Si se actualizó correctamente, devolver éxito
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al actualizar la cuenta']);  // Si hubo un error, devolver mensaje de error
        }

        $stmt->close();  // Cerrar el statement después de ejecutar
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan parámetros']);  // Si faltan parámetros, devolver error
    }
}

// Cerrar la conexión con la base de datos
$conn->close();
?>
