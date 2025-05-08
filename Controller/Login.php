<?php
require_once "Usuario.php";
session_start();
$correo = $_POST['correo'];
$pass = $_POST['pass'];
$usuario = new Usuario(null, null, $correo, $pass);
$_SESSION['usuarioActual'] = null;
$usuario->consultarUsuario($usuario);
if (isset($_SESSION['usuarioActual'])) {
    header('location: ../View/principal.php');
} else {
    header('location: ../View/login.php');
}
?>