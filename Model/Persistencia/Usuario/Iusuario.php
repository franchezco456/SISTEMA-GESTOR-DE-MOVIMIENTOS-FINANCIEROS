<?php
interface Iusuario{
    public function saveUsuario(Usuario $usuario);
    public function deleteUsuario(Usuario $usuario);
    public function consultUsuario(Usuario $usuario);
	public function validarUsuario(Usuario $usuario);
    public function updateUsuario(Usuario $usuarioOLD, Usuario $usuarioNew);
    public function validarUsuarioActualizado(Usuario $usuario, $excludeId);
    public function obtenerTodosLosUsuarios();
}
?>