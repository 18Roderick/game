<?php
require_once '../models/Usuario.php';

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $data = array();
    $NewUser = new Usuario();
    $exito = $NewUser->existe_usuario($username);

    if ($exito < 1) {
        $data['status'] = true;
        $data['result'] = true;
    } else {
        $data['status'] = false;
        $data['result'] = false;
    }

    echo json_encode($data);
}

?>