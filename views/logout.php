<?php
session_start();
if( isset($_SESSION['usuario_validado']) ){
  session_destroy();
  setcookie("user", "", time() - 3600);
  header('Location: http://'.$_SERVER['HTTP_HOST'].'/game');
}
?>