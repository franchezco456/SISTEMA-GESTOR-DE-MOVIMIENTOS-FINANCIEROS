<?php
require_once "../../Model/Entidades/Usuario.php";
require_once __DIR__ . '/../../Model/Logica/UsuarioAuthService.php';
if(isset($_SESSION['usuarioActual'])){
    $User = json_decode($_SESSION['usuarioActual'], false);
    $curUser = new Usuario($User->id, $User->nombre, $User->correo, $User->pass);
    $auth = new UsuarioAuthService();
    $resultado = $auth->eliminarUsuario($curUser);
    if ($resultado) {
		header("Location: ../../View/Web/Usuarios/login.php");
    } else {
        header("Location: ../../View/Web/Usuarios/login.php");
    }
}
?>