<?php
require_once '../models/Game.php';

if (isset($_POST['user'])) {
    $user = $_POST['user'];
    $puntaje = $_POST['puntaje'];
    $idPregunta = $_POST['id'];
    $data = array();
    $Game = new Game();
    $exito = $Game->actualizar_puntaje($user, $puntaje);

    // guardar progreso 

    $Game = new Game();
    $exito = $Game->actualizar_progreso($user, $idPregunta);

    if ($exito) {
        $data['status'] = true;
        $data['result'] = true;
    } else {
        $data['status'] = false;
        $data['result'] = false;
    }

    echo json_encode($data);
}else{
  $data = array();
  $data['status'] = false;
  $data['result'] = "variable user missing";
  echo json_encode($data);
}

?>