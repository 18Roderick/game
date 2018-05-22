<?php 
include 'header.php'; 
?>

<link rel="stylesheet" type="text/css" href="public/css/form.css">
<div class="main-form">
	<div id="form-title">
		<h2 >Iniciar Sesion</h2>
	</div>
	<div class="container-form">
	
		<form action="#" class="form" method="POST" onsubmit="return validateLogin()">
		
		<label for="correo" class="label-form">correo :</label>
		<input type="email" class="input-form text" name="correo" id="correo" placeholder="Escriba su correo">

		<label for="password" class="label-form">Apellido :</label>
		<input type="password" class="input-form text" name="password" id="password" placeholder="*********">

		<input type="submit" class="input-form button" name="enviar" value="Enviar">
		</form>
		<a href='/game/claveOlvidada.php'>olvide mi contraseña</a
	</div>
</div>