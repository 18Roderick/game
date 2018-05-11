<?php 
include ('header.php');
?>
<link rel="stylesheet" type="text/css" href="public/css/form.css">
<div class="main-form">
	<div id="form-title">
		<h2 >Registro de usuario</h2>
	</div>
	<div class="container-form">
	
		<form action="#" class="form" method="POST" onsubmit="return validateForm()">
		
		<label for="nombre" class="label-form">Nombre :</label>
		<input type="text" class="input-form text" name="nombre" id="nombre" placeholder="Escriba su nombre">

		<label for="apellido" class="label-form">Apellido :</label>
		<input type="text" class="input-form text" name="apellido" id="apellido" placeholder="Escriba su apellido">

		<label for="email" class="label-form">Correo electronico :</label>
		<input type="email" class="input-form text" name="email" id="email" placeholder="Escriba su correo electronico">

		<label for="userName" class="label-form">Nombre de usuario :</label>
		<input type="text" class="input-form text" name="userName" id="userName" onkeyup="buscarUsuario(this)" placeholder="Escriba su nombre de usuario">

		<label id="password" class="label-form">Escriba su contraseña :</label>
		<input type="password" class="input-form text" name="password" id="password" placeholder="Escriba su contraseña">

		<label id="password2" class="label-form"> Repita su contraseña :</label>
		<input type="password" class="input-form text " name="password2" id="password2" placeholder="escriba su contraseña">

		<input type="submit" class="input-form button" name="enviar" value="Enviar">
		</form>
	</div>
</div>