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
require('functions/validar_form.php');
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
	

	$corregir = validar($_POST);
	if($corregir['validar']){
		//header('Location: http://localhost/game');
		printSucces();
	}else{
		printForm($corregir);
	
	}
	


} else {
    
	
	printForm('');

}

function printForm($corregir){

	?>
		<div class="main-form">
		<div id="form-title">
			<h2 >Registro de usuario</h2>
		</div>
		<div class="container-form">

			<form action='/game/registrar.php' class='form' method="POST" name="formulario" onsubmit="return validateForm(this)">

				<div class="half">
					<label for="nombre" class="label-form">Nombre :
						<?php 
							if(isset($corregir['mensaje_nombre'])){
								echo '<span class=" warning">'.$corregir['mensaje_nombre'].'</span>';
							}
						?>
					</label>
					<input type="text" class="input-form text" name="nombre" id="nombre" 
					<?php
					//nombre
						if(!empty($_POST)){ echo "value='".$_POST['nombre']."'"; }
						
					?>
					required placeholder=" Escriba su nombre">
				</div>

				<div class="half">
					<label for="apellido" class="label-form">Apellido :</label>
					<input type="text" class="input-form text" name="apellido" id="apellido"
					<?php
					//codigo de php validacion de campo apellido
						if(isset($_POST['apellido'])){ echo "value='".$_POST['apellido']."'"; }
					?>
					required placeholder=" Escriba su apellido">
				</div>

				<!-- datos personales -->
				<div class="half">
					<label for="cedula" class="label-form">Cédula : 
					<?php 
					 if(isset($corregir['mensaje_cedula'])){
							echo '<span class=" warning">'.$corregir['mensaje_cedula'].'</span>';
					 }
					?>
					
					</label>
					<input type="text" class="input-form text" name="cedula" id="cedula"
					<?php
					//codigo de php validacion de campo cedula
						if(isset($_POST['cedula'])){ echo "value='".$_POST['cedula']."'"; }
					?>
					required placeholder=" x-xxx-xxx">
				</div>


				<div class="half">
					<label for="celular" class="label-form">Numero de Célular : 
						<?php 
					 if(isset($corregir['mensaje_celular'])){
							echo '<span class=" warning">'.$corregir['mensaje_celular'].'</span>';
					 }
					?>
					</label>
					<input type="text" class="input-form text" name="celular" id="celular"
					<?php
					//celular
						if(isset($_POST['celular'])){ echo "value='".$_POST['celular']."'"; }
					?>
					required placeholder=" 000-000">
				</div>

				<!-- fecha de nacimiento y sexo-->

				<p>Genero <span id="mensaje-genero"></span></p>
				<div class="inputGroup">
					<input id="radio1" name="sexo" type="radio" required value="f"
					 <?php
					 	if(!empty($_POST) ){
							 if($_POST['sexo'] == 'f' ){ echo "checked='checked'"; }
						 }
					 ?>
					/>
					<label for="radio1" >Femenino</label>
				</div>

				<div class="inputGroup">
					<input id="radio2" name="sexo" type="radio" value="m"
					<?php
					 	if(!empty($_POST) ){
							 if($_POST['sexo'] == 'm' ){ echo "checked='checked'"; }
						 }
					 ?>
					/>
					<label for="radio2">Masculino</label>
				</div>

			
				<label for="fecha" class="label-form">Fecha de nacimiento :
					<?php 
					 if(isset($corregir['mensaje_fecha'])){
							echo '<span class=" warning">'.$corregir['mensaje_fecha'].'</span>';
					 }
					?>
				</label>

				<input type="date" class="input-form text" name="fecha" id="fecha"
				<?php
					//fecha
						if(isset($_POST['fecha'])){ echo "value='".$_POST['fecha']."'"; }
					?>
				required placeholder=" fecha de nacimineto">
				

				<label for="email" class="label-form">Correo electronico : 
					<?php 
					 if(isset($corregir['mensaje_correo'])){
							echo '<span class=" warning">'.$corregir['mensaje_correo'].'</span>';
					 }
					?>
				</label>
				<input type="email" class="input-form text" name="email" id="email"
				<?php
					//email o correo electronico
						if(isset($_POST['email'])){ echo "value='".$_POST['email']."'"; }
					?>
				
				required placeholder="Escriba su correo electronico">

				<label for="userName" class="label-form">Nombre de usuario : <span id='usuario'></span>
					<?php 
					 if(isset($corregir['mensaje_user'])){
							echo '<span class=" warning">'.$corregir['mensaje_user'].'</span>';
					 }
					?>
				</label>

				<input type="text" class="input-form text" name="userName" id="userName"
				<?php
					//cusername
						if(isset($_POST['userName'])){ echo "value='".$_POST['userName']."'"; }
				?>
				required onkeyup="buscarUsuario(this)" placeholder="Escriba su nombre de usuario">
				
				
				<label id="password" class="label-form">Escriba su contraseña : 
					<?php 
					 if(isset($corregir['mensaje_password'])){
							echo '<span class=" warning">'.$corregir['mensaje_password'].'</span>';
					 }
					?>
				</label>

				<?php 
				if(empty($_POST) )
				{ 
					echo "<p class='light'> debe tener al menos 8 caracteres, 1 digito, 1 mayuscula, 1 caracter especial  </p>";
				 } 
				else if(isset($corregir['mensaje_password']))
				{	 echo "<p class='warning'>  debe tener al menos 8 caracteres, 1 digito, 1 mayuscula, 1 caracter especial </p>"; }
				?>
				
				<input type="password" class="input-form text" name="password" id="password"
				<?php
					//ccontraseña
						if(isset($_POST['password'])){ echo "value='".$_POST['password']."'"; }
				?>
				required placeholder="Escriba su contraseña">

				<label id="password2" class="label-form"> Repita su contraseña : <span id="mensaje-pw"></label>
				<input type="password" class="input-form text " name="password2" id="password2"
				<?php
					//contraseña 2
						if(isset($_POST['password2'])){ echo "value='".$_POST['password2']."'"; }
				?>
				required  placeholder="escriba su contraseña">

				<input type="submit" class="input-form button" id="registrar" name="registrar" value="Enviar">
			</form>
			</div>
		</div>

	<?php
}


// print exit

function printSucces(){
	?>
	<div class="registro-succes">
		<h2>Su Registro ha sido exitoso</h2>
		<h4>En breve lo redirigiremos a su sesion</h4>
		<h4>lo presiones el boton para continuar</h4>
		<button></button>
	</div>


	<?php
}
?>
</body>
</html>