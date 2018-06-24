<?php
require_once '../models/Usuario.php';
$correo = "rjrr507@gmail.com";
$password = "@18Roderick";
$passwordEncrypt = crypt($password, substr($correo, 0, 2));

$NewUser = new Usuario();
$exito = $NewUser->existe_usuario('rjrr507');

echo $exito;
if ($exito < 1) {
    echo "No existe este usuario  " . $exito;
} else {
    echo "El usuario ya existe  " . $exito;
}

echo "<br>";

