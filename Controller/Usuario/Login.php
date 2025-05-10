<?php
require_once "../../Model/Entidades/Usuario.php";
require_once __DIR__ . '/../../Model/Logica/UsuarioAuthService.php';
session_start();
$correo = $_POST['correo'];
$pass = $_POST['pass'];
$usuario = new Usuario(null, null, $correo, $pass);
$_SESSION['usuarioActual'] = null;
$auth = new UsuarioAuthService();
$auth->consultarUsuario($usuario);
if (isset($_SESSION['usuarioActual'])) {
    header('location: ../../View/Web/Usuarios/principal.php');
} else {
    header('location: ../../View/Web/Usuarios/login.php');
}
?>