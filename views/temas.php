<?php

include_once './config.php';

require_once ROOT.'/models/Pregunta.php';

print('<link rel="stylesheet" type="text/css" href="' . HOST . '/public/css/modulos.css">');
print('<title>Temas</title>');
//print('<script src="' . HOST . '/public/js/game/game.js"></script>');

//container bootstrap


if (isset($_SESSION['usuario_validado'])) {


  print('</div>');# code...




} else {
    header('Location: ' . VIEWS . '/login.php?notLogged=true');
}

//fin del container de bootstrap



?>