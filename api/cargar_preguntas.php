<?php
require_once '../models/Pregunta.php';
$data = array();
$todo = array();

if (isset($_POST['id'])) {

    $NewPregunta = new Pregunta();

    $respuestas = $NewPregunta->respuestas();

    foreach ($respuestas as $key3 => $respuesta) {
        $todo[$respuesta['id']] = [
            "pregunta" => $respuesta['pregunta_id'],
            "respuesta" => utf8_encode($respuesta['opcion']),
            "correcta" => ($respuesta['correcta']) ? true : false,
        ];
    }
    $data['data'] = $todo;
    $data['status'] = true;
    echo json_encode($data);
} else {
    $data["status"] = false;
    echo json_encode($todo);
}


?>