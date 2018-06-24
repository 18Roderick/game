<?php

if (isset($_SESSION['usuario_validado'])) {
  # code...
} else {
  header('Location: http://localhost/game/login.php?notLogged=true');
}



?>