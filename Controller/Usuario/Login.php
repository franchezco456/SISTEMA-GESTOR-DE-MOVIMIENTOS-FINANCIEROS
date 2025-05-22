<?php
require_once "../../Model/Entidades/Usuario.php";
require_once __DIR__ . '/Auth/UsuarioAuthService.php';
require_once __DIR__ . '../../CuentaFinanciera/Auth/CuentaFinancieraAuthService.php';
require_once __DIR__ . '../../MovimientosFinancieros/Auth/MovimientosFinancierosAuthService.php';
session_start();
$correo = $_POST['correo'];
$pass = $_POST['pass'];
$usuario = new Usuario(null, null, $correo, $pass);
$_SESSION['usuarioActual'] = null;
$auth = new UsuarioAuthService();
$auth->consultarUsuario($usuario);
$movimientos = new MovimientosFinancierosAuthService();
$movimientos->consultMovimientosFinancierosUsuario($usuario);
if (isset($_SESSION['usuarioActual'])) {
    $usuario = json_decode($_SESSION['usuarioActual']);
    $user = new Usuario($usuario->id, $usuario->nombre, $usuario->correo, $usuario->pass);
    $cuentas = new CuentaFinancieraAuthService();
    $cuentas->consultarCuentasFinancieras($user);
    header('location: ../../View/Web/Usuarios/principal.php');
} else {
    session_start();
    $_SESSION['mensaje'] = "Usuario o contraseña incorrectos";
    header('location: ../../View/Web/Usuarios/login.php');
    exit();
}
?>