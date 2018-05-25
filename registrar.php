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
<?php include("header.php"); ?>
	<?php 
		if (array_key_exists('registrar', $_POST)) {

			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$user = $_POST['userName'];
			$correo = $_POST['correo'];
			$clave = $_POST['password'];
			$clave2 = $_POST['password2'];
			$key = crypt($clave, substr($correo, 0, 2));



			//
			if ($correo !='' && $clave !='') {
				require("models/usuarios.php");
				// verificando el nuevo usuario
				$obj_validar = new usuarios();
				$usuario_validado = $obj_validar->existe_usuario($correo);
				$nfilas =0;
				foreach ($usuario_validado as $resultado) {
				foreach ($resultado as  $value) {
					$nfilas = $value;
					}
				}
				//

				if ($nfilas == 0 && strlen($clave)>7 && $clave == $clave2) {
					$obj_usuario = new usuarios();
					$obj_usuario->nuevo_usuario($nombre, $apellido, $correo, $fecha, $sexo, $key);
					echo "Resgitro exitoso";
					echo "<p><a href='login.php'>Iniciar sesion</a></p>";

				}elseif($nfilas != 0){
						header("Location: http://localhost/semestral/resgistrar.php?error='El correo ingresa ya esta en uso, por favor utilize otro'");
				}elseif($clave != $clave2){
						header("Location: http://localhost/semestral/resgistrar.php?error='las contraseñas no coinciden'");
				}else{
					
					header("Location: http://localhost/semestral/resgistrar.php?error='La contraseña ingresada es muy corta. <br> Introduzca al menos 8 caracteres'");

				}


			}
			
		}else{
			if (array_key_exists('error', $_GET)) {
	 			echo "<div id='titulo' class='alert alert-danger' role='alert'>".$_GET['error']."</div>"	;
	 		}

		?>
			 <div class="main-form">
	<div id="form-title">
		<h2 >Registro de usuario</h2>
	</div>
	<div class="container-form">
	
		<form action="/game/registrar.php" class="form" method="POST" name="registrar" onsubmit="return validateForm()">
		
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

		<input type="submit" class="input-form button" name="registrar" value="Enviar">
		</form>
	</div>
</div>

	<?php 	
		}
	 ?>
</body>
</html>