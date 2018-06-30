<?php
session_start();
if( isset($_SESSION['usuario_validado']) ){
  session_destroy();
  header('Location: http://'.$_SERVER['HTTP_HOST'].'/game');
}
?>