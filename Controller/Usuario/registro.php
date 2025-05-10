<?php
require_once "../../Model/Entidades/Usuario.php";
require_once __DIR__ . '/../../Model/Logica/UsuarioAuthService.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$pass = $_POST['pass'];
$cedula = $_POST['cedula'];
$usuario = new Usuario($cedula, $nombre, $correo, $pass);
$Auth = new UsuarioAuthService();
$resultado=$Auth->crearUsuario($usuario);
if($resultado){
	header('location: ../../View/Web/Usuarios/login.php');
}else{
	header('location: ../../View/Web/Usuarios/registro.php');
}
}
?>