<?php
require_once "../../Model/Entidades/Usuario.php";
require_once __DIR__ . '/Auth/UsuarioAuthService.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$pass = $_POST['pass'];
$cedula = $_POST['cedula'];
$usuario = new Usuario($cedula, $nombre, $correo, $pass);
$Auth = new UsuarioAuthService();
$resultado=$Auth->crearUsuario($usuario);
if($resultado){
	session_start();
	$_SESSION['mensaje'] = "Usuario creado correctamente";
	header('location: ../../View/Web/Usuarios/registro.php');
	exit();
}else{
	session_start();
	$_SESSION['mensaje'] = "Error al crear el usuario";
	header('location: ../../View/Web/Usuarios/registro.php');
	exit();
}
}
?>