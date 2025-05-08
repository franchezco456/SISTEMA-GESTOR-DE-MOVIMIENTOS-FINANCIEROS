<?php
require_once "../Controller/Usuario.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$pass = $_POST['pass'];
$cedula = $_POST['cedula'];
$usuario = new Usuario($cedula, $nombre, $correo, $pass);
$resultado=$usuario->crearUsuario($usuario);
if($resultado){
	header('location: ../View/registro.php');
}else{
	header('location: ../View/registro.php');
}
}
?>