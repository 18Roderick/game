<?php
session_start();
include_once './config.php';
require_once ROOT . '/models/Usuario.php';
if( isset($_SESSION['usuario_validado']) ){
  session_destroy();
  $Usuario = new Usuario();

  if(isset($_COOKIE['user'])){
    $exito = $Usuario->logout($_COOKIE['user']);
  }
  
  setcookie("user", "", time() - 3600);
  header('Location: http://'.$_SERVER['HTTP_HOST'].'/game');
}
?>