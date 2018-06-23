<?php session_start();
//$_SESSION['usuario_validado'] = 'roderick';
?>
<script type="text/javascript" src="public/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="public/js/main.js"></script>
<script type="text/javascript" src='public/js/box.js'></script>
<script src="public/js/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" type="text/css" href="public/css/bootstrap-grid.css">
<link rel="stylesheet" type="text/css" href="public/css/index.css">
<link rel="stylesheet" type="text/css" href="public/css/form.css">


<div class="container-banner">
	<div class="banner ">
		<img src="public/images/fisc.png" class="left">
		<img src="public/images/logo_utp_1_300.jpg" class="right">
		<div class="game-title" id="kute">
    	<h1 id="titulo"> DASLEARN</h1>
  	</div>


	</div>
</div>
<?php
if (isset($_SESSION['usuario_validado'])) {
    ?>
	<div class="topnav back-skie" id="myTopnav">
	  <a href="/game">Inicio</a>
	  <a href="#">Temas</a>
		<a href="/game/jugar.php">Jugar</a>
		<a href="/game/tutorial.php">Tutorial</a>
		<a href="">Creditos</a>
	  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
	    <i class="fa fa-bars"></i>
	  </a>
	</div>

<?php

} else {
    ?>
	<div class="topnav back-skie" id="myTopnav">
	  <a href="/game">Inicio</a>
	  <a href="javascript:void(0);" >Temas</a>
		<a href="javascript:void(0);" onclick='notLogged()'>Jugar</a>
		<a href="javascript:void(0);" >Tutorial</a>
		<a href="">Creditos</a>
	  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
	    <i class="fa fa-bars"></i>
	  </a>
	</div>


<?php
}
?>
