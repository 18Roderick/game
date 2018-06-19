<?php 
include 'header.php'; 
if($_SESSION['usuario_validado']){
  
  include 'vistas/box.php';
}else{
  header('Location: http://localhost/game');
}

?>