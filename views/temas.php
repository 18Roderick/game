<?php

include_once './config.php';

print('<link rel="stylesheet" type="text/css" href="' . HOST . '/public/css/modulos.css">');
print('<script src="' . HOST . '/public/js/vue.js"></script>');
print('<script src="' . HOST . '/public/js/game.js"></script>');

//container bootstrap
print('<div class="container">');

if (isset($_SESSION['usuario_validado'])) {
    # code...
    print('<div class="container-modulos row ">');

    for ($i = 0; $i < 4; $i++) {
      print('
        
        <div class="modulos col s12">
          <h1>Modulo 1
            <span class="porcentaje"></span>
          </h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex aliquid maiores nulla distinctio error! Eos, voluptatum
            deleniti. Soluta quibusdam, ad explicabo nesciunt cum distinctio nostrum pariatur laboriosam sed, amet provident.</p>
          <div class="bottom-bar">
            <div class="progress-bar"></div>
          </div>
        </div>
      ');
    }

    print('</div>');

} else {
    header('Location: ' . VIEWS . '/login.php?notLogged=true');
}

//fin del container de bootstrap
print('</div>');

?>