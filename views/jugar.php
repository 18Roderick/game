<?php 
include_once './config.php';
require_once ROOT.'/models/Pregunta.php';


function siguiente_pregunta($id){

}

function verificar_pregunta($pregunta_id, $respuesta){
  
}

if($_SESSION['usuario_validado']){
  print('<script src="' . HOST . '/public/js/game/game.js"></script>');

  if (isset($_REQUEST['start'])) {
    $id = $_REQUEST['start'];
    print('
        <p align="center" class="succes info-message">Iniciando juego</p>
    ');


    $NewPregunta = new Pregunta();

    $preguntas = $NewPregunta->cargar_preguntas($id);
    //echo var_dump($preguntas);
    $cont = 0;
    foreach ($preguntas as $key2 => $pregunta) {
        print('<div class="row game">');
        print('<div class="z-depth-4 col s12 m6 l6 offset-l3">');
          print('');
          print('
          <div class="row">
            <div class="col m11 s10">
            <p value="'.$pregunta['id'].'">'.utf8_encode($pregunta['preguntas']).'</p>
            </div>
            
            <div class="col s1 verificando" >
            
            
              <div class="preloader-wrapper small active">
                <div class="spinner-layer spinner-blue-only">
                  <div class="circle-clipper left">
                    <div class="circle"></div>
                      </div><div class="gap-patch">
                      <div class="circle"></div>
                      </div><div class="circle-clipper right">
                      <div class="circle"></div>
                    </div>
                  </div>
              </div>

            </div>
          </div>
          
          ');


          $NewPregunta = new Pregunta();
          
          $respuestas = $NewPregunta->cargar_respuestas($pregunta['id']);
          print('<form action="#">');

          foreach ($respuestas as $key3 => $respuesta) {
            //echo var_dump($respuesta);
            print('
              <p>
                
                <label for="'.utf8_encode($respuesta['id']).'"> 
                  <input type="radio"  id="'.utf8_encode($respuesta['id']).'" name="opcion" 
                    value = "'.utf8_encode($respuesta['correcta']).'"/>               
                  <span class=" black-text">'.utf8_encode($respuesta['opcion']).'</span>
              </label>
              </p>
            ');
          }

          print('</form>');

          print('
            <div class="row">
            <div class="center-align">

                <a class="waves-effect waves-light btn " onclick="verificar('.$cont.')">verificar
                    <i class="material-icons  right" style="font-size:35px;">check_circle</i>
                </a>
                <a class="waves-effect waves-light btn" onclick="siguiente()">siguiente
                    <i class="material-icons right">send</i>
                </a>

            </div>

          </div>
          ');
        print('</div>');
        print('</div>');
        $cont++;
    }
  }
  
}else{
  header('Location: '.VIEWS.'/login.php?notLogged=true');
}

?>