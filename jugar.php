<?php 
if($_SESSION['usuario']){
  include 'header.php'; 
  include 'vistas/box.php';
}else{
  header('Location: http://localhost/game');
}

?>