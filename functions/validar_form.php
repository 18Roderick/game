<?php
$emailRegex = '/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i';
$cedulaRegex = '/^P$|^(?:PE|E|N|[23456789]|[23456789](?:A|P)?|1[0123]?|1[0123]?(?:A|P)?)$|^(?:PE|E|N|[23456789]|[23456789](?:AV|PI)?|1[0123]?|1[0123]?(?:AV|PI)?)-?$|^(?:PE|E|N|[23456789](?:AV|PI)?|1[0123]?(?:AV|PI)?)-(?:\d{1,4})-?$|^(PE|E|N|[23456789](?:AV|PI)?|1[0123]?(?:AV|PI)?)-(\d{1,4})-(\d{1,5})$/i';
$celularRegex = '/^\d{4}-\d{4}$/'; //'/^\d{3}-\d{4}-\d{4}$/'
$blankRegex = '/\s/';
$passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#.$($)$-$_])[A-Za-z\d$@$!%*?&#.$($)$-$_]{8,15}$/';
function validar($data)
{
    require_once 'models/Usuario.php';
    $validacion = 0;

    if (!empty($data)) {
        $corregir = array();
        //nombre y apellido
        if (strlen($data['nombre']) < 2 || blank($data['nombre']) == false) {
            $corregir['mensaje_nombre'] = 'Introduzca su nombre';
            $validacion++;
        }

        if (strlen($data['apellido']) < 2 || blank($data['apellido']) == false) {
            $corregir['mensaje_apellido'] = 'Introduzca su apellido';
            $validacion++;
        }

        //cedula
        if (!preg_match_all($GLOBALS['cedulaRegex'], $data['cedula'])) {
            $corregir['mensaje_cedula'] = 'Numeracion incorrecta';
            $validacion++;
        }else {
            $Usuario = new Usuario();
            $exito = $Usuario->existe_cedula($data['cedula']);

            if ($exito != 0) {
                $corregir['mensaje_cedula'] = 'Este ya esta en uso';
                $validacion++;
            }
        }

        //email
        if (!preg_match_all($GLOBALS['emailRegex'], $data['email'])) {
            $corregir['mensaje_correo'] = 'Correo no valido';
            $validacion++;
        } else {
            $Usuario = new Usuario();
            $exito = $Usuario->existe_correo($data['email']);

            if ($exito != 0) {
                $corregir['mensaje_correo'] = 'Este correo ya existe';
                $validacion++;
            }
        }

        //celular
        if (!preg_match_all($GLOBALS['celularRegex'], $data['celular'])) {
            $corregir['mensaje_celular'] = 'No valido';
            $validacion++;
        }

        //username

        if (strlen($data['userName']) < 2 || blank($data['userName']) == false) {
            $corregir['mensaje_user'] = 'Introduzca un nombre de usuario';
            $validacion++;
        } else {
            $Usuario = new Usuario();
            $exito = $Usuario->existe_usuario($data['userName']);

            if ($exito != 0) {
                $corregir['mensaje_user'] = 'Este usuario ya existe';
                $validacion++;
            }
        }

        if ($data['password'] == $data['password2']) {
            if (!preg_match_all($GLOBALS['passwordRegex'], $data['password'])) {
                $corregir['mensaje_password'] = 'no cumple las condciones';
                $validacion++;
            }

        } else {

            $corregir['mensaje_password'] = 'las contraseñas no coinciden';
            $validacion++;

        }

        //fecha de nacimiento
        $year = (getdate()['year']) - date_parse($data['fecha'])['year'];
        if ($year < 14) {
            $corregir['mensaje_fecha'] = 'debes ser mayor de 13 años';
            $validacion++;
        }

    } else {
        $corregir['validar'] = false;
        return $corregir;
    }

    if ($validacion <= 0) {
        $corregir['validar'] = true;
        return $corregir;
    } else {
        $corregir['validar'] = false;
        return $corregir;
    }
}

function blank($cadena)
{
    $array = str_split($cadena);
    $cont = 0;

    foreach ($array as $data) {
        if ($data == ' ') {$cont++;}
    }

    if ($cont == strlen($cadena)) {
        return false;

    } else {
        return true;

    }
}

?>