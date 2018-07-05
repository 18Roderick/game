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
		//$user_id_sql= $this->db->query("select id from usuario where username ='".$Usuario."'");
        $password1 = "123456789";
        $password = crypt($password1 , $hashed_password);
		//$db=mysqli_query("update usuario set password ='".$password."' where id ='".$user_id_sql."'");

        $mail = $correo;
          //Titulo
        $titulo = "Reset de Contraseña";
        //cabecera
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		 //dirección del remitente
        $headers .= "From: Daslearn < rode_rick@live.com >\r\n";
		//contenido del mensaje
		$msg="Su Clave a sido restaurada a : ". $password1 . ". \nRecuerde acceder a su perfil para cambiar la contraseña.";
		$msg = wordwrap($msg,70);
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