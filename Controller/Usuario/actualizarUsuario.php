<?php
require_once "../../Model/Entidades/Usuario.php";
require_once __DIR__ . '/Auth/UsuarioAuthService.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function validarCampo($campo) {
        return isset($campo) && trim($campo) !== '';
    }
    if(isset($_SESSION['usuarioActual'])){
    $curUser = json_decode($_SESSION['usuarioActual'], false);
    }
    $nuevoId = isset($_POST['cedula']) ? $_POST['cedula'] : null;
    $nuevoNombre = isset($_POST['usuario']) ? $_POST['usuario'] : null;
    $nuevoCorreo = isset($_POST['correo']) ? $_POST['correo'] : null;
    $nuevoPass = isset($_POST['password']) ? $_POST['password'] : null;

    if (!validarCampo($nuevoId)) {
        $nuevoId = $curUser->id;
    }
    if (!validarCampo($nuevoNombre)) {
        $nuevoNombre = $curUser->nombre;
    }
    if (!validarCampo($nuevoCorreo)) {
        $nuevoCorreo = $curUser->correo;
    }
    if (!validarCampo($nuevoPass)) {
        $nuevoPass = $curUser->pass;
    }
    if($nuevoId < 0 ){
            session_start();
            $_SESSION['mensaje'] = "la cedula no es valida";
            header("location: ../../View/Web/Usuarios/ConfiguracionUsuarios.php");
            exit();
        }
    $usuarioNew = new Usuario($nuevoId, $nuevoNombre, $nuevoCorreo, $nuevoPass);
    $usuarioOld = new Usuario($curUser->id, $curUser->nombre, $curUser->correo, $curUser->pass);
    $auth = new UsuarioAuthService();
        $r=$auth->actualizarUsuario($usuarioOld, $usuarioNew);
        if($r){
           header("location: ../../View/Web/Usuarios/ConfiguracionUsuarios.php");
        }else{
            session_start();
            $_SESSION['mensaje'] = "Error al actualizar el usuario";
            header("location: ../../View/Web/Usuarios/ConfiguracionUsuarios.php");
            exit();
        }
       
    
}
?>


