<?php

include_once './config.php';

require_once ROOT . '/models/Usuario.php';

$message = "";
$hashed_password = "goq5QxfSX04e.";
$exito = 0;
$correo = '';

if (array_key_exists('enviar', $_POST)) {
    $correo = $_POST['correo'];
    $Usuario = new Usuario();
    $exito = $Usuario->existe_correo($correo);

    if ($exito > 0) {
        print('correo valido');
        $Usuario = new Usuario();
        $password1 = $Usuario->datos_usuario($correo)[0]['password'];
        $password = crypt($password1, $hashed_password);

        $mail = "Prueba de mensaje";
          //Titulo
        $titulo = "PRUEBA DE TITULO";
        //cabecera
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        //dirección del remitente
        $headers .= "From: Daslearn < rode_rick@live.com >\r\n";
        //Enviamos el mensaje a tu_dirección_email
        $bool = mail($correo, $titulo, $mail, $headers);
        if ($bool) {
            echo "Mensaje enviado";
        } else {
            echo "Mensaje no enviado";
        }

        print($password);
    } else {
        print('<div class="warning">' . $message . '</div>');
    }

} else {

}
print('
<link rel="stylesheet" type="text/css" href="' . PUBLIC_DIR . '/css/form.css">

<div class="main-form">
  <div id="form-title">
    <h6 >Ingrese su correo para recuperar su contraseña</h6 >
  </div>
  <div class="container-form">

    <form action="./resetPassword.php" class="form" method="POST" onsubmit="return validateLogin()">


    <div class="input-field">
      <input type="email" class="input-form text" name="correo"
      value="' . $correo . '" id="correo" placeholder="Escriba su correo">

      <label for="correo" class="label-form">Escriba su correo </label>
    </div>

    <input type="submit" class="input-form button" name="enviar" value="Enviar">
    </form>

    <a href="' . VIEWS . '/login.php">Iniciar sesion</a>
  </div>
</div>


');

?>