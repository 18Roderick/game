<?php 
include_once './config.php';
require_once ROOT.'/models/Pregunta.php';


function siguiente_pregunta($id){

}

function verificar_pregunta($pregunta_id, $respuesta){
  
}

if($_SESSION['usuario_validado']){
  
  if (isset($_REQUEST['start'])) {
    $id = $_REQUEST['start'];
    print('
        <p align="center" class="succes info-message">Iniciando juego</p>
    ');


    $NewPregunta = new Pregunta();

    $preguntas = $NewPregunta->cargar_preguntas($id);
    echo var_dump($preguntas);
    foreach ($preguntas as $key2 => $pregunta) {
        print('');
        $NewPregunta = new Pregunta();

        $respuestas = $NewPregunta->cargar_respuestas($pregunta['id']);
        echo var_dump($preguntas);
        foreach ($respuestas as $key3 => $respuesta) {

        }
    }
  }
  
}else{
  header('Location: '.VIEWS.'/login.php?notLogged=true');
}

?>