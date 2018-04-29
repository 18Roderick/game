<?php 
include 'header.php';
?>

<form action="#" class="form" method="POST" onsubmit="return validateForm()">
	
	<label>Nombre :</label>
	<input type="text" name="nombre">
	<label>Apellido</label>
	<input type="text" name="apellido">
	<label>Correo electronico</label>
	<input type="email" name="email">
	<label>Nombre de usuario</label>
	<input type="text" name="userName" onkeyup="buscarUsuario(this)">
	<p>Respuesta : <span id="usuario"></span></p>

	<input type="submit" name="enviar" value="Enviar">
</form>