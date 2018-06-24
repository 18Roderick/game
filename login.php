<?php

include_once 'header.php';

if (!isset($_SESSION['usuario_validado']) && !isset($_SESSION['usuario_admin'])) {

    require_once 'models/Usuario.php';
    $hashed_password = "goq5QxfSX04e.";
    $user = "";
    $password = "";
    $message_correo = "";
    $message_password = "";
    $message = "";

    if (isset($_REQUEST['notLogged'])) {
        print('
					<p align="center" class="warning info-message">Para acceder necesitas iniciar sesion</p>
				');
    }

    if (array_key_exists('enviar', $_POST)) {
        $Usuario = new Usuario();
        $user = $_POST['user'];
        $password = crypt($_POST['password'], $hashed_password);

        $exito = $Usuario->iniciar_sesion($user, $password);
        if ($exito > 0) {
            $_SESSION['usuario_validado'] = true;
            header('Location: http://localhost/game/jugar.php');
        } else {
            $message = "<p class='warning'> correo o contraseña incorrectos</p>";
        }

    }

    print('
		<link rel="stylesheet" type="text/css" href="public/css/form.css">
		<div class="main-form">
			<div id="form-title">
				<h2 >Iniciar Sesion</h2>
			</div>
			<div class="container-form">

				<form action="./login.php" class="form" method="POST" onsubmit="return validateLogin()">

				<label for="user" class="label-form">Nombre de usuario, cedula o correo : </label>
				<input type="text" class="input-form text" name="user"
				value="' . $user . '" id="user" placeholder="Escriba su usuario, su cedula o correo">

				<label for="password" class="label-form">Apellido :</label>
				<input type="password" class="input-form text" name="password"
				value="' . $password . '" id="password" placeholder="*********">
				<!-- mensaje del server-->
				' . $message . '
				<!-- -->
				<input type="submit" class="input-form button" name="enviar" value="Enviar">
				</form>
				<a href="/game/claveOlvidada.php">olvide mi contraseña</a>
				<a href="./registrar.php">Crear usuario</a>
			</div>
		</div>


');

} else {
    header('Location: http://localhost/game');
}
?>