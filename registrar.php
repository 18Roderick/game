<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Registro de usuario</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="public/css/form.css">
<?php include "header.php";?>

<?php

if (array_key_exists('registrar', $_POST)) {

    $nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$fecha = $_POST['fecha'];
	$cedula = $_POST['cedula'];
	$celular = $_POST['celular'];
    $user = $_POST['userName'];
	$correo = $_POST['email'];
	$sexo= $_POST['sexo'];
    $clave = $_POST['password'];
    $clave2 = $_POST['password2'];
	$key = crypt($clave, substr($correo, 0, 2));
	echo var_dump(getdate()['year']);
	echo '<br>';
	echo var_dump(date_parse($fecha));
	printForm();


} else {
    if (array_key_exists('error', $_GET)) {
		echo "<div id='titulo' class='alert alert-danger' role='alert'>" . $_GET['error'] . "</div>";
	}
	
	printForm();

}

function printForm(){

	?>
		<div class="main-form">
		<div id="form-title">
			<h2 >Registro de usuario</h2>
		</div>
		<div class="container-form">

			<form action='/game/registrar.php' class='form' method="POST" name="formulario" onsubmit="return validateForm(this)">

				<div class="half">
					<label for="nombre" class="label-form">Nombre :</label>
					<input type="text" class="input-form text" name="nombre" id="nombre" 
					<?php
						if(isset($_POST['nombre'])){ echo "value='".$_POST['nombre']."'"; }
					?>
					required placeholder=" Escriba su nombre">
				</div>

				<div class="half">
					<label for="apellido" class="label-form">Apellido :</label>
					<input type="text" class="input-form text" name="apellido" id="apellido"
					<?php
						if(isset($_POST['apellido'])){ echo "value='".$_POST['apellido']."'"; }
					?>
					required placeholder=" Escriba su apellido">
				</div>
				<!-- datos personales -->
				<div class="half">
					<label for="cedula" class="label-form">Cédula : <span id="mensaje-cedula"></span></label>
					<input type="text" class="input-form text" name="cedula" id="cedula"
					required placeholder=" x-xxx-xxx">
				</div>

				<div class="half">
					<label for="celular" class="label-form">Numero de Célular : <span id="mensaje-celular"></span></label>
					<input type="text" class="input-form text" name="celular" id="celular"
					required placeholder=" 000-000">
				</div>

				<!-- fecha de nacimiento y sexo-->

				<p>Genero <span id="mensaje-genero"></span></p>
				<div class="inputGroup">
					<input id="radio1" name="sexo" type="radio" required/>
					<label for="radio1" >Femenino</label>
				</div>
				<div class="inputGroup">
					<input id="radio2" name="sexo" type="radio"/>
					<label for="radio2">Masculino</label>
				</div>

			
				<label for="fecha" class="label-form">Fecha de nacimiento :</label>
				<input type="date" class="input-form text" name="fecha" id="fecha"
				required placeholder=" fecha de nacimineto">
				

				<label for="email" class="label-form">Correo electronico : <span id="mensaje-correo"></span></label>
				<input type="email" class="input-form text" name="email" id="email"
				required placeholder="Escriba su correo electronico">

				<label for="userName" class="label-form">Nombre de usuario : 
					<span id="usuario" ></span>
				</label>
				<input type="text" class="input-form text" name="userName" id="userName"
				required onkeyup="buscarUsuario(this)" placeholder="Escriba su nombre de usuario">
				

				<label id="password" class="label-form">Escriba su contraseña : <span id="mensaje-pw"></span></label>
				<input type="password" class="input-form text" name="password" id="password"
				required placeholder="Escriba su contraseña">

				<label id="password2" class="label-form"> Repita su contraseña : <span id="mensaje-pw"></label>
				<input type="password" class="input-form text " name="password2" id="password2"
				required  placeholder="escriba su contraseña">

				<input type="submit" class="input-form button" id="registrar" name="registrar" value="Enviar">
			</form>
			</div>
		</div>

	<?php
}
?>
</body>
</html>