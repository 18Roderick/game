<?php session_start();
$_SESSION['usuario_validado'] = 'roderick';

 ?>
<script type="text/javascript" src="public/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="public/js/main.js"></script>
<script type="text/javascript" src='public/js/box.js'></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" type="text/css" href="public/css/index.css">
<link rel="stylesheet" type="text/css" href="public/css/form.css">
<link rel="stylesheet" type="text/css" href='html/css/title.css'>
<div class="container-banner">
	<div class="banner ">
		<img src="public/images/fisc.png" class="left">
		<img src="public/images/logo_utp_1_300.jpg" class="right">
		<div class="game-tittle">
    <div class="word">
        <span>D</span>
        <span>A</span>
        <span>S</span>
        <span>L</span>
        <span>E</span>
        <span>A</span>
        <span>R</span>
        <span>N</span>
      </div>
</div>

		
	</div>
</div>
<?php
	if (isset($_SESSION['usuario_validado'])) {
 ?>
	<div class="topnav back-skie" id="myTopnav">
	  <a href="/game">Inicio</a>
	  <a href="#">Documentacion</a>
	  <a href="/game/jugar.php">Jugar</a>
	  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
	    <i class="fa fa-bars"></i>
	  </a>
	</div>

<?php

}else{
 ?>
	<div class="topnav back-skie" id="myTopnav">
	  <a href="#">Inicio</a>
	  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
	    <i class="fa fa-bars"></i>
	  </a>
	</div>


<?php
}
?>