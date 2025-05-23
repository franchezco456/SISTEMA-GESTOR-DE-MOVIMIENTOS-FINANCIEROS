<?php
session_start();
session_destroy();
header('location: ../../View/Web/Usuarios/login.php');
?>