<?php
require_once '../models/Usuario.php';
$correo = "rjrr507@gmail.com";
$password = "@18Roderick";
$passwordEncrypt = crypt($password, substr($correo, 0, 2));
$NewUser = new Usuario();

$exito = $NewUser->nuevo_usuario(
    "Roderick", "Romero", "M", "8-910-498",
    "6593-2892", $correo, "1996/09/21",
    "rjrr507", $passwordEncrypt
);

if ($exito == true) {
    echo "Registrado con exito   " . $exito;
} else {
    echo "Error al registrar   " . $exito;
}

echo "<br>";
$NewUser = new Usuario();
$NewUser->existe_usuario('rjrr507');
