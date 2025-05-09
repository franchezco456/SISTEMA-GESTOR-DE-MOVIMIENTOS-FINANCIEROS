<?php
interface Iusuario{
    public function saveUsuario(Usuario $usuario);
    public function deleteUsuario(Usuario $usuario);
    public function consultUsuario(Usuario $usuario);
    public function updateUsuario(Usuario $usuario);
    public function obtenerTodosLosUsuarios();
}
?>