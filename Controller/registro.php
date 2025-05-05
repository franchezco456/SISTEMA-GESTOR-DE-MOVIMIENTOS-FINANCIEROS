<?php
require_once "../Controller/Usuario.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$pass = $_POST['pass'];
$cedula = $_POST['cedula'];
$usuario = new Usuario($cedula, $nombre, $correo, $pass);
$usuario->crearUsuario($usuario);
header('location: ../View/registro.html');
} else {
header('location: ../View/registro.html');
}
?>