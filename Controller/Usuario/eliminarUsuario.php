<?php
require_once "../../Model/Entidades/Usuario.php";
require_once __DIR__ . '/Auth/UsuarioAuthService.php';
if(isset($_SESSION['usuarioActual'])){
    $User = json_decode($_SESSION['usuarioActual'], false);
    $curUser = new Usuario($User->id, $User->nombre, $User->correo, $User->pass);
    $auth = new UsuarioAuthService();
    $resultado = $auth->eliminarUsuario($curUser);
    if ($resultado) {
    session_start();
    $_SESSION['mensaje'] = "Usuario eliminado correctamente";
		header("Location: ../../View/Web/Usuarios/login.php");
    exit();
    } else {
      session_start();
      $_SESSION['mensaje'] = "Error al eliminar el usuario";
      header("location: ../../View/Web/Usuarios/ConfiguracionUsuarios.php");
      exit();
    }
}
?>