<?php
include_once './config.php';
require_once ROOT . '/models/Pregunta.php';
print('<title>Jugar</title>');

function siguiente_pregunta($id)
{

}

function verificar_pregunta($pregunta_id, $respuesta)
{

}

if ($_SESSION['usuario_validado']) {
    print('<script src="' . HOST . '/public/js/game/game.js"></script>');
    print('<link rel="stylesheet" type="text/css" href="' . HOST . '/public/css/modulos.css">');

    if (isset($_REQUEST['start'])) {
        $id = $_REQUEST['start'];
        print('
        <span id="modulo" style="display: none">' . $id . '</span>
    ');

        $NewPregunta = new Pregunta();

        $preguntas = $NewPregunta->cargar_preguntas($id);
        //echo var_dump($preguntas);
        $cont = 0;

        foreach ($preguntas as $key2 => $pregunta) {
            if ($cont < 1) {
                print('
        <div class="row">
          <div class="z-depth-1 col s12 m6 l6 offset-l3">
          <br>
          <span id="avance"></span>   <span id="puntaje"></span>
          <br>
          <br>
          </div>
        </div>
      ');
            }

            print('<div class="row game" style="display:none;">');
            print('<div class="z-depth-4 col s12 m6 l6 offset-l3">');

            print('
          <div class="row">
            <div class="col m11 s10">
            <p value="' . $pregunta['id'] . '">' . utf8_encode($pregunta['preguntas']) . '</p>
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

                  <label for="' . utf8_encode($respuesta['id']) . '">
                    <input type="radio"  id="' . utf8_encode($respuesta['id']) . '" name="opcion"
                      value = "' . utf8_encode($respuesta['correcta']) . '"/>
                    <span class=" black-text">' . utf8_encode($respuesta['opcion']) . '</span>
                  </label>
                </p>
              ');
            }

            print('</form>');

            print('
            <br>
            <div class="row">
            <div class="center-align">

                <a class="waves-effect waves-light btn " onclick="verificar(' . $cont . ')">verificar
                    <i class="material-icons  right" style="font-size:35px;">check_circle</i>
                </a>

            </div>

          </div>
          ');
            print('</div>');
            print('</div>');
            $cont++;
        }
    } else {

        $NewPregunta = new Pregunta();

        $modulos = $NewPregunta->cargar_modulos();
        print('<div class="container" id="app">');
        print('<div class="container-modulos row ">');

        if (count($modulos) > 0) {

        foreach ($modulos as $key => $modulo) {
          print('

          <div class="modulos col s12" onclick="jugar(this, ' . $modulo['id'] . ')">
            <h2>' . utf8_encode($modulo['titulo']) . '
              <span class="porcentaje">' . (round((2 * 100) / 15)) . '% de 100%</span>
            </h2>
            <p>' . utf8_encode($modulo['descripcion']) . '</p>
            <div class="progress grey lighten-1">
              <div class="determinate cyan" style="width: ' . ((2 * 100) / 15) . '%"></div>
            </div>

          </div>
          ');
          }
        } else {
            print('<h4>No hay modulos disponibles </h4>');
        }

        print('</div>');

    }

} else {
    header('Location: ' . VIEWS . '/login.php?notLogged=true');
}


?>