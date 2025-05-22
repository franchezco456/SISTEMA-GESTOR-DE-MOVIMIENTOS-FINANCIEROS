<?php
require_once "../Model/Entidades/Usuario.php";
require_once "../Model/Entidades/CuentaFinanciera.php";
require_once __DIR__ . '../CuentaFinanciera/Auth/CuentaFinancieraAuthService.php';
$Auth = new CuentaFinancieraAuthService();
// Verificar el método de la solicitud (GET, POST, PUT, DELETE)
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        obtenerCuentas($Auth);  // Si es un GET, se obtienen todas las cuentas
        break;

    case 'POST':
        crearCuenta($Auth);  // Si es un POST, se crea una nueva cuenta
        break;

    case 'PUT':
        modificarCuenta($Auth);  // Si es un PUT, se modifica una cuenta existente
        break;

    case 'DELETE':
        eliminarCuenta($Auth);  // Si es un DELETE, se elimina una cuenta
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Método no soportado']);  // Si el método no es soportado, se devuelve un error
        break;
}

// Función para obtener todas las cuentas desde la base de datos
function obtenerCuentas($Auth)
{
    $stdClassusuario = json_decode($_SESSION['usuarioActual'], false);
    $id = $stdClassusuario->id;
    $nombre = $stdClassusuario->nombre;
    $correo = $stdClassusuario->correo;
    $contraseña = $stdClassusuario->pass;
    $usuario = new Usuario($id, $nombre, $correo, $contraseña);  // Crear un objeto Usuario con los datos de sesión
    $resultado = $Auth->consultarCuentasFinancieras($usuario);
    // Verificar si hay resultados
    if ($resultado) {
        $cuentas = json_decode($_SESSION['cuentasCurUser'], false);
        $bancos = [];

        foreach ($cuentas as $cuenta) {
            $bancos[] = [  // Almacena cada cuenta en un arreglo
                'usuario' => $cuenta->nombre,
                'saldo' => $cuenta->estadoCuenta,
                'tope' => $cuenta->tope,
                'cantidadInicial' => $cuenta->cantidadInicial
            ];
        }
        echo json_encode($bancos);  // Devuelve las cuentas en formato JSON
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No hay cuentas registradas']);  // Si no hay cuentas, se devuelve un mensaje de error
    }
}

// Función para crear una nueva cuenta en la base de datos
function crearCuenta($Auth)
{
    // Obtener los datos de la solicitud en formato JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar si se recibieron todos los parámetros necesarios
    if (isset($data[0]['usuario']) && isset($data[0]['saldo']) && isset($data[0]['tope'])) {
        $usuario = $data[0]['usuario'];
        $saldo = $data[0]['saldo'];
        $tope = $data[0]['tope'];

        $stdClassusuario = json_decode($_SESSION['usuarioActual'], false);
        $id = $stdClassusuario->id;
        $user = new Usuario($id, null, null, null);
        $cuenta = new CuentaFinanciera(null, $id, $usuario, $saldo, $saldo, null, $tope);

        $result = $Auth->validarCuentaFinanciera($cuenta, $user);  // Validar si la cuenta ya existe
        // Verificamos si ya existe una cuenta con el mismo nombre de usuario
        if ($result) {
            echo json_encode(['status' => 'error', 'message' => 'La cuenta esta duplicada']);  // Si ya existe, devolver error
            return;
        }

        $insercion = $Auth->crearCuentaFinanciera($cuenta, $user);  // Intentar crear la cuenta

        // Ejecutar la consulta
        if ($insercion) {
            echo json_encode(['status' => 'success', 'message' => 'Cuenta creada correctamente']);  // Si la cuenta se crea correctamente, devolver éxito
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al crear la cuenta']);  // Si hubo un error, devolver mensaje de error
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan parámetros para crear la cuenta']);  // Si faltan parámetros, devolver error
    }
}

// Función para eliminar una cuenta de la base de datos
function eliminarCuenta($Auth)
{
    // Obtener los datos de la solicitud en formato JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar si se pasó el identificador de la cuenta (usuario)
    if (isset($data['usuario'])) {
        $usuario = $data['usuario'];
        $stdClassusuario = json_decode($_SESSION['usuarioActual'], false);
        $id = $stdClassusuario->id;
        $user = new Usuario($id, null, null, null);
        $cuenta = new CuentaFinanciera(null, null, $usuario, null, null, null, null);
        $resultado = $Auth->eliminarCuentaFinanciera($cuenta, $user);  // Intentar eliminar la cuenta

        // Ejecutar la consulta
        if ($resultado) {
            echo json_encode(['status' => 'success', 'message' => 'Cuenta eliminada correctamente']);  // Si se eliminó, devolver éxito
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al eliminar la cuenta']);  // Si hubo un error, devolver mensaje de error
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Falta el identificador de la cuenta']);  // Si falta el identificador, devolver error
    }
}

// Función para modificar una cuenta de la base de datos
function modificarCuenta($Auth)
{
    // Obtener los datos de la solicitud en formato JSON
    $data = json_decode(file_get_contents("php://input"), true);
    $cuentas = json_decode($_SESSION['cuentasCurUser'], false);
    // Verificar si se pasaron todos los parámetros necesarios
    if (
        isset($data['usuarioAntiguo']) &&
        isset($data['nuevoUsuario']) &&
        isset($data['nuevoSaldo']) &&
        isset($data['nuevoTope'])
    ) {
        $nombreAntiguo = $data['usuarioAntiguo'];
        $nuevonombre = $data['nuevoUsuario'];
        $nuevaCantidadInicial = $data['nuevoSaldo'];
        $nuevoTope = $data['nuevoTope'];
        foreach ($cuentas as $cuenta) {
            if ($cuenta->nombre == $nombreAntiguo) {
                $idcuenta = $cuenta->idCuenta;
            }
        }
        $stdClassusuario = json_decode($_SESSION['usuarioActual'], false);
        $id = $stdClassusuario->id;
        $user = new Usuario($id, null, null, null);
        $CuentaNew = new CuentaFinanciera(null, null, $nuevonombre, $nuevaCantidadInicial, null, null, $nuevoTope);
        $CuentaOLD = new CuentaFinanciera($idcuenta, null, $nombreAntiguo, null, null, null, null);

        $result = $Auth->actualizarCuentaFinanciera($CuentaNew, $CuentaOLD, $user);  // I

        // Ejecutar la consulta
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Cuenta actualizada correctamente']);  // Si se actualizó correctamente, devolver éxito
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Nombre de la cuenta ya existente']);  // Si hubo un error, devolver mensaje de error
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan parámetros']);  // Si faltan parámetros, devolver error
    }
}
?>