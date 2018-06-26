<?php 
include_once './config.php';

if($_SESSION['usuario_validado']){
  
  include './box.php';
}else{
  header('Location: '.VIEWS.'/login.php?notLogged=true');
}

?>