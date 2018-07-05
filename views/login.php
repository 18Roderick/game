<?php

include_once './config.php';

print('<link rel="stylesheet" type="text/css" href="'.PUBLIC_DIR.'/css/form.css">');
print('<script src="'.HOST.'/public/js/form.js"></script>');


if (!isset($_SESSION['usuario_validado']) && !isset($_SESSION['usuario_admin'])) {

    require_once ROOT . '/models/Usuario.php';
    $hashed_password = "goq5QxfSX04e.";
    $user = "";
    $password = "";
    $message_correo = "";
    $message_password = "";
    $message = "";
    $requestRoute = VIEWS."/jugar.php";
    $exito = 0;

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
        if (count($exito) > 0) {

            setcookie('user', utf8_encode($exito[0]['username']), time() + (86400 * 30), "/");
            $_SESSION['usuario_validado'] = true;
            header('Location: ' . $requestRoute);
        } else {
            $message = "<p class='warning'> correo o contraseña incorrectos</p>";
        }

    }


    print('
		<div class="main-form">
			<div id="form-title">
				<h4 >Iniciar Sesion</h4>
			</div>
			<div class="container-form">

				<form action="./login.php" class="form" method="POST" onsubmit="return validateLogin()">

                <div class="input-field">
                    <br>
                    <input type="text" class="input-form text" name="user"
				    value="' . $user . '" id="user" placeholder="Escriba su usuario, su cedula o correo">
                    <label for="user" class="label-form">Nombre de usuario, cedula o correo : </label>
                </div>

				
                <div class="input-field">
                    <br>
                    <input type="password" class="input-form text" name="password"
                    value="' . $password . '" id="password" placeholder="*********">
                    <label for="password" class="label-form">contraseña :</label>
                </div>
				<!-- mensaje del server-->
				' . $message . '
				<!-- -->
				<input type="submit" class="input-form button" name="enviar" value="Enviar">
				</form>
				<a href="./resetPassword.php">olvide mi contraseña</a>
				<a href="' . VIEWS . '/registrar.php">Crear usuario</a>
			</div>
		</div>


');

} else {
    header('Location: ' . HOST);
}

?>