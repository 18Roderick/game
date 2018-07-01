<?php

include_once './config.php';

require_once ROOT.'/models/Pregunta.php';

print('<link rel="stylesheet" type="text/css" href="' . HOST . '/public/css/modulos.css">');
print('<script src="' . HOST . '/public/js/vue.js"></script>');
//print('<script src="' . HOST . '/public/js/game/game.js"></script>');

//container bootstrap
print('<div class="container" id="app">');

if (isset($_SESSION['usuario_validado'])) {
  $NewPregunta = new Pregunta();

  $modulos = $NewPregunta->cargar_modulos();
  print('<div class="container-modulos row ">');

  if(count($modulos) > 0){

    foreach ($modulos as $key => $modulo) {
      print('
        
      <div class="modulos col s12" onclick="jugar(this, '.$modulo['id'].')">
        <h2>'.utf8_encode($modulo['titulo']).'
          <span class="porcentaje">0% de 100%</span>
        </h2>
        <p>'.utf8_encode($modulo['descripcion']).'</p>
        <div class="progress grey lighten-1">
          <div class="determinate cyan" style="width: 0%"></div>
        </div>
          
      </div>
    ');
    }
  }else{
    print('<h4>No hay modulos disponibles </h4>');
  }

  print('</div>');# code...




} else {
    header('Location: ' . VIEWS . '/login.php?notLogged=true');
}

//fin del container de bootstrap

print('</div>');

?>