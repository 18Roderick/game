<?php
require_once '../models/Pregunta.php';
$data = array();
$todo = array();

if (isset($_POST['id'])) {

    $NewPregunta = new Pregunta();

    $modulos = $NewPregunta->cargar_modulos();

    foreach ($modulos as $key => $modulo) {
        $todo[$key] = [
            "id" => $modulo['id'],
            "titulo" => $modulo['titulo'],
            "descripcion" => utf8_encode($modulo['descripcion']),
            "preguntas" => [],
        ];

        $NewPregunta = new Pregunta();

        $preguntas = $NewPregunta->cargar_preguntas($modulo['id']);

        foreach ($preguntas as $key2 => $pregunta) {
            $todo[$key]['preguntas'][$key2] = [
                "id" => $pregunta['id'],
                "pregunta" => utf8_encode($pregunta['preguntas']),
                "respuestas" => [],
            ];

            $NewPregunta = new Pregunta();

            $respuestas = $NewPregunta->cargar_respuestas($pregunta['id']);

            foreach ($respuestas as $key3 => $respuesta) {
                $todo[$key]['preguntas'][$key2]['respuestas'][$key3] = [
                    "id" => $respuesta['id'],
                    "respuesta" => utf8_encode($respuesta['opcion']),
                    "correcta" => ($respuesta['correcta']) ? true : false,
                ];
            }
        }

    }
    $data['data'] = $todo;
    $data['status'] = 1;
    echo json_encode($data);
} else {
    $data["status"] = 0;
    echo json_encode($todo);
}


?>