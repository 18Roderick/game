<?php
include_once './header.php';

print('<link rel="stylesheet" type="text/css" href="public/css/modulos.css">');
print('<script src="./public/js/vue.js"></script>');
print('<script src="./public/js/game.js"></script>');

if (isset($_SESSION['usuario_validado'])) {
    # code...
    print('
        <div class="container-modulos row">
        <div class="modulos col-sm-5 col-md-5">
          <h1>Modulo 1
            <span class="porcentaje"></span>
          </h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex aliquid maiores nulla distinctio error! Eos, voluptatum
            deleniti. Soluta quibusdam, ad explicabo nesciunt cum distinctio nostrum pariatur laboriosam sed, amet provident.</p>
          <div class="bottom-bar">
            <div class="progress-bar"></div>
          </div>
        </div>
      </div>
    ');
} else {
    header('Location: http://localhost/game/login.php?notLogged=true');
}

?>